<?php

namespace App\Livewire\Pages;

use Carbon\Carbon;
use App\Traits\Toastr;
use Livewire\Component;
use App\Models\Resident;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\BarangayOfficial;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CertificateRequestPage extends Component
{
    use WithPagination, WithFileUploads, Toastr;

    protected $paginationTheme = 'bootstrap';

    // Form properties
    public $residents;
    public $resident_id;
    public $amountReceived;
    public $printReceipt;
    public $certificate_type;
    public $purpose;
    public $status = 'Pending';
    public $request_id;
    public $payment_method;
    public $pickup_datetime;
    public $receipt;

    // Filter properties
    public $search = '';
    public $statusFilter = '';
    public $dateRange = '';
    public $paymentFilter = '';
    public $pickupDateFilter = '';
    public $perPage = 10;

    // Receipt viewer properties
    public $viewingReceipt = false;
    public $currentReceipt;

    // Payment confirmation properties
    public $paymentRequestId;
    public $currentCertificateType;
    public $currentCertificateFee;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'paymentFilter' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'resident_id' => 'required|exists:residents,id',
        'certificate_type' => 'required|string',
        'purpose' => 'required|string',
        'payment_method' => 'required|in:Cash,GCash',
        'pickup_datetime' => 'required|date',
        'status' => 'required|in:Pending,Approved,Released,Rejected,Cancelled',
    ];

    protected $messages = [
        'resident_id.required' => 'Please select a resident',
        'certificate_type.required' => 'Please select a certificate type',
        'purpose.required' => 'Please provide a purpose for the certificate',
        'payment_method.required' => 'Please select a payment method',
        'pickup_datetime.required' => 'Please select a pickup date and time',
    ];

    public function mount()
    {
        if (Auth::user()->hasRole(['admin', 'super-admin'])) {
            $this->residents = Resident::orderBy('last_name')->get();
        } else {
            $this->residents = Resident::where('id', Auth::user()->resident->id)->get();
            if (Auth::user()->resident) {
                $this->resident_id = Auth::user()->resident->id;
            }
        }
    }

    /**
     * Check if a request is paid before releasing
     *
     * @param int $requestId
     * @return bool
     */
    public function checkPaymentStatus($requestId)
    {
        $request = CertificateRequest::findOrFail($requestId);

        // If certificate is free (e.g., Certificate of Indigency), no payment needed
        if ($request->certificate_type === 'Certificate of Indigency') {
            return true;
        }

        // If payment method is GCash, check if receipt is uploaded
        if ($request->payment_method === 'GCash' && $request->receipt_path) {
            return true;
        }

        // If payment method is Cash, admin needs to manually confirm payment
        if ($request->payment_method === 'Cash') {
            return $request->is_paid;
        }

        return false;
    }

    /**
     * Show payment modal with certificate information
     *
     * @param int $requestId
     */
    public function showPaymentModal($requestId)
    {
        $request = CertificateRequest::findOrFail($requestId);

        // Store request details for the modal
        $this->paymentRequestId = $requestId;
        $this->currentCertificateType = $request->certificate_type;
        $this->currentCertificateFee = $this->getCertificateFee($request->certificate_type);

        // Pass certificate details to modal
        $this->dispatch('showPaymentModal', [
            'certificateType' => $this->currentCertificateType,
            'certificateFee' => $this->currentCertificateFee,
        ]);
    }

    /**
     * Get certificate fee based on type
     *
     * @param string $certificateType
     * @return float
     */
    private function getCertificateFee($certificateType)
    {
        $fees = [
            'Barangay Clearance' => 50.00,
            'Certificate of Residency' => 50.00,
            'Certificate of Indigency' => 0.00,
            'Business Clearance' => 100.00,
            'Good Moral Character' => 50.00,
        ];

        return $fees[$certificateType] ?? 50.00;
    }

    /**
     * Confirm payment received and release certificate
     */
    public function confirmPaymentAndRelease()
    {
        try {
            $request = CertificateRequest::findOrFail($this->paymentRequestId);

            $request->update([
                'is_paid' => true,
                'status' => 'Released',
                'released_at' => now(),
                'processed_by' => Auth::id(),
            ]);

            $this->dispatch('closePaymentModal');
            $this->alert('success', 'Payment confirmed and certificate released.');

            // Reset modal data
            $this->paymentRequestId = null;
            $this->currentCertificateType = null;
            $this->currentCertificateFee = null;
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function saveRequest()
    {
        $this->validate();

        try {
            // Process receipt if uploaded
            $receipt_path = null;
            if ($this->receipt && $this->payment_method == 'GCash') {
                $receipt_path = $this->receipt->store('receipts', 'public');
            }

            $existingRequest = null;
            if ($this->request_id) {
                $existingRequest = CertificateRequest::find($this->request_id);
            }

            $data = [
                'resident_id' => $this->resident_id,
                'certificate_type' => $this->certificate_type,
                'purpose' => $this->purpose,
                'status' => $this->status,
                'payment_method' => $this->payment_method,
                'pickup_datetime' => $this->pickup_datetime,
                'requested_at' => now(),
                'processed_by' => Auth::id(),
            ];

            // Only set receipt_path if we have a new one or keep the old one
            if ($receipt_path) {
                $data['receipt_path'] = $receipt_path;
            } elseif ($existingRequest && $existingRequest->receipt_path) {
                $data['receipt_path'] = $existingRequest->receipt_path;
            }

            // Update timestamps based on status
            if ($this->status == 'Approved') {
                $data['approved_at'] = now();

                // Get the captain
                $capt = BarangayOfficial::where('position', 'LIKE', '%Punong Barangay%')
                    ->where('status', 'A')
                    ->first();

                if ($capt) {
                    $data['barangay_official_id'] = $capt->id;
                }
            } elseif ($this->status == 'Released') {
                $data['released_at'] = now();
                $data['is_paid'] = true;
            }

            CertificateRequest::updateOrCreate(
                ['id' => $this->request_id],
                $data
            );

            $this->alert('success', $this->request_id ? 'Request updated successfully!' : 'Request submitted successfully!');
            $this->resetFields();
            $this->dispatch('hideModal');
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function editRequest($id)
    {
        try {
            $request = CertificateRequest::findOrFail($id);
            $this->request_id = $request->id;
            $this->resident_id = $request->resident_id;
            $this->certificate_type = $request->certificate_type;
            $this->purpose = $request->purpose;
            $this->status = $request->status;
            $this->payment_method = $request->payment_method;
            $this->pickup_datetime = $request->pickup_datetime;
            // We don't set the receipt here because it's a file upload

            $this->dispatch('showModal');
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function deleteRequest($id)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            // Optional: Check if the user has permission to delete
            if (!Auth::user()->hasRole(['admin', 'super-admin']) &&
                ($request->resident_id != Auth::user()->resident->id)) {
                $this->alert('error', 'You are not authorized to delete this request.');
                return;
            }

            $request->delete();
            $this->alert('success', 'Request deleted successfully!');
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function resetFields()
    {
        $this->resident_id = Auth::user()->hasRole(['admin', 'super-admin']) ? null : Auth::user()->resident->id;
        $this->certificate_type = null;
        $this->purpose = null;
        $this->status = 'Pending';
        $this->payment_method = null;
        $this->pickup_datetime = null;
        $this->receipt = null;
        $this->request_id = null;
    }

    public function issueRequest($request_id)
    {
        $this->redirect(route('auth.certs.temp1', $request_id));
    }

    public function viewReceipt($id)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            if ($request->receipt_path) {
                $this->currentReceipt = Storage::url($request->receipt_path);
                $this->viewingReceipt = true;
                $this->dispatch('showReceiptModal');
            } else {
                $this->alert('error', 'No receipt found for this request.');
            }
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Process a request status change with payment verification
     */
    public function processRequest($id, $newStatus)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            // If we're trying to mark as Released, check payment status first
            if ($newStatus === 'Released' && !$this->checkPaymentStatus($id)) {
                // Show payment confirmation modal
                $this->showPaymentModal($id);
                return;
            }

            if ($newStatus == 'Approved') {
                $capt = BarangayOfficial::where('position', 'LIKE', '%Punong Barangay%')
                    ->where('status', 'A')
                    ->first();

                $request->update([
                    'barangay_official_id' => $capt ? $capt->id : null,
                    'status' => $newStatus,
                    'approved_at' => now(),
                    'processed_by' => Auth::id(),
                ]);
            } elseif ($newStatus == 'Released') {
                $request->update([
                    'status' => $newStatus,
                    'released_at' => now(),
                    'processed_by' => Auth::id(),
                    'is_paid' => true, // Mark as paid when released
                ]);
            } else {
                $request->update([
                    'status' => $newStatus,
                    'processed_by' => Auth::id(),
                ]);
            }

            $this->alert('success', 'Request updated successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    // Reset pagination when filters change
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPaymentFilter()
    {
        $this->resetPage();
    }

    public function getRequestStatusColor($status)
    {
        return match($status) {
            'Pending' => 'bg-warning',
            'Approved' => 'bg-success',
            'Released' => 'bg-info',
            'Rejected' => 'bg-danger',
            'Cancelled' => 'bg-secondary',
            default => 'bg-secondary',
        };
    }

    public function isPickupToday($date)
    {
        return Carbon::parse($date)->isToday();
    }

    // Get stats for the dashboard cards
    public function getStats()
    {
        $query = Auth::user()->hasRole(['admin', 'super-admin'])
            ? CertificateRequest::query()
            : CertificateRequest::where('resident_id', Auth::user()->resident->id);

        $total = $query->count();
        $pending = $query->where('status', 'Pending')->count();
        $approved = $query->where('status', 'Approved')->count();
        $released = $query->where('status', 'Released')->count();

        // Calculate completion rate (percentage of requests that are not pending)
        $completion_rate = $total > 0 ? round((($total - $pending) / $total) * 100) : 0;

        // Calculate pending percentage
        $pending_percentage = $total > 0 ? round(($pending / $total) * 100) : 0;

        return [
            'total' => $total,
            'pending' => $pending,
            'approved' => $approved,
            'released' => $released,
            'completion_rate' => $completion_rate,
            'pending_percentage' => $pending_percentage
        ];
    }

    public function render()
    {
        $query = Auth::user()->hasAnyRole('admin|super-admin')
            ? CertificateRequest::query()
            : CertificateRequest::where('resident_id', Auth::user()->resident->id);

        // Apply filters
        if ($this->search) {
            $query->where(function($q) {
                $q->where('certificate_type', 'like', "%{$this->search}%")
                  ->orWhere('purpose', 'like', "%{$this->search}%");

                // If admin, also search by resident name
                if (Auth::user()->hasAnyRole('admin|super-admin')) {
                    $q->orWhereHas('resident', function($q2) {
                        $q2->where('first_name', 'like', "%{$this->search}%")
                           ->orWhere('last_name', 'like', "%{$this->search}%");
                    });
                }
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->paymentFilter) {
            $query->where('payment_method', $this->paymentFilter);
        }

        // Apply date range filter if provided
        if ($this->dateRange) {
            $dates = explode(' to ', $this->dateRange);
            if (count($dates) == 2) {
                $startDate = Carbon::parse($dates[0])->startOfDay();
                $endDate = Carbon::parse($dates[1])->endOfDay();
                $query->whereBetween('requested_at', [$startDate, $endDate]);
            }
        }

        // Apply pickup date filter
        if ($this->pickupDateFilter) {
            $pickupDate = Carbon::parse($this->pickupDateFilter);
            $query->whereDate('pickup_datetime', $pickupDate);
        }

        // Sort by most recent first and paginate
        $requests = $query->with('resident')->orderBy('requested_at', 'desc')->paginate($this->perPage);

        // Calculate stats for the dashboard
        $stats = $this->getStats();

        return view('livewire.pages.certificate-request-page', [
            'requests' => $requests,
            'stats' => $stats,
        ]);
    }
}