<?php

namespace App\Livewire\Pages;

use Carbon\Carbon;
use App\Traits\Toastr;
use Livewire\Component;
use App\Models\Resident;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\BarangayOfficial;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;

class CertificateRequestPage extends Component
{
    use WithPagination, WithFileUploads, Toastr;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'processRequest' => 'processRequest',
    ];
    // Form properties
    public $residents;

    #[Url()]
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
    public $cedula_image; // New property for cedula image upload

    // Discount properties
    public $discount_type = 'None';
    public $discount_id_number;
    public $discount_amount = 0;
    public $original_fee = 0;
    public $discounted_fee = 0;

    // Filter properties
    public $search = '';
    public $statusFilter = '';
    public $dateRange = '';
    public $paymentFilter = '';
    public $pickupDateFilter = '';
    public $perPage = 10;
    public $discountFilter = '';
    public $paymentStatusFilter = '';

    // Receipt viewer properties
    public $viewingReceipt = false;
    public $currentReceipt;

    // Cedula viewer properties
    public $viewingCedula = false;
    public $currentCedula;

    // Payment confirmation properties
    public $paymentRequestId;
    public $currentCertificateType;
    public $currentCertificateFee;
    public $currentDiscountType;
    public $currentDiscountAmount;

    public $certificateTypes = [
        'Barangay Clearance' => 'Barangay Clearance',
        'Certificate of Residency' => 'Certificate of Residency',
        'Certificate of Indigency' => 'Certificate of Indigency',
        'Certificate of Low Income' => 'Certificate of Low Income',
        'Business Clearance' => 'Business Clearance',
        'Good Moral Character' => 'Good Moral Character',
        'Barangay Business Permit' => 'Barangay Business Permit',
        'First Time Jobseeker Certificate' => 'First Time Jobseeker Certificate',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'paymentFilter' => ['except' => ''],
        'discountFilter' => ['except' => ''],
        'paymentStatusFilter' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'resident_id' => 'required|exists:residents,id',
        'certificate_type' => 'required|string',
        'purpose' => 'required|string',
        'payment_method' => 'required|in:Cash,GCash',
        'pickup_datetime' => 'required|date',
        'status' => 'required|in:Pending,Approved,Released,Rejected,Cancelled',
        'discount_type' => 'required|in:None,Student,Senior Citizen',
        'discount_id_number' => 'nullable|required_if:discount_type,Student,Senior Citizen|string|max:50',
        'cedula_image' => 'nullable|file|max:3072|mimes:jpg,jpeg,png,pdf', // 3MB max, common image formats and PDF
    ];

    protected $messages = [
        'resident_id.required' => 'Please select a resident',
        'certificate_type.required' => 'Please select a certificate type',
        'purpose.required' => 'Please provide a purpose for the certificate',
        'payment_method.required' => 'Please select a payment method',
        'pickup_datetime.required' => 'Please select a pickup date and time',
        'discount_id_number.required_if' => 'ID number is required when applying a discount',
        'cedula_image.max' => 'The cedula image must not be larger than 3MB',
        'cedula_image.mimes' => 'The cedula image must be a JPG, PNG, or PDF file',
    ];

    public function mount()
    {
        if (Auth::user()->hasRole(['barangay_official', 'admin'])) {
            $this->residents = Resident::orderBy('last_name')->get();
        } else {
            $this->residents = Resident::where('id', Auth::user()->resident->id)->get();
            if (Auth::user()->resident) {
                $this->resident_id = Auth::user()->resident->id;
            }
        }

        if ($this->resident_id) {
            $this->certificate_type = 'Barangay Clearance';
            $this->purpose = 'Certificate of Residency';
            $this->payment_method = 'Cash';
            $this->pickup_datetime = now()->addDays(1)->format('Y-m-d H:i');
            $resident = Resident::find($this->resident_id);
            if ($resident and $resident->is_senior_citizen) {
                $this->discount_type = 'Senior Citizen';
                $this->discount_id_number = $resident->senior_citizen_id;
                $this->calculateDiscount();
            }
            $this->dispatch('requestModal');
        }
    }

    /**
     * Calculate discount based on type
     */
    public function calculateDiscount()
    {
        $this->original_fee = $this->getCertificateFee($this->certificate_type);

        switch ($this->discount_type) {
            case 'Student':
                $this->discount_amount = $this->original_fee * 0.2; // 20% discount for students
                break;
            case 'Senior Citizen':
                $this->discount_amount = $this->original_fee * 0.3; // 30% discount for senior citizens
                break;
            default:
                $this->discount_amount = 0; // No discount
                break;
        }

        $this->discounted_fee = max(0, $this->original_fee - $this->discount_amount);
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
        $this->currentDiscountType = $request->discount_type;
        $this->currentDiscountAmount = $request->discount_amount;

        // Pass certificate details to modal
        $this->dispatch('showPaymentModal', [
            'certificateType' => $this->currentCertificateType,
            'certificateFee' => $this->currentCertificateFee,
            'discountType' => $this->currentDiscountType,
            'discountAmount' => $this->currentDiscountAmount,
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
     * View cedula image
     *
     * @param int $id
     */
    public function viewCedula($id)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            if ($request->cedula_image_path) {
                $this->currentCedula = Storage::url($request->cedula_image_path);
                $this->viewingCedula = true;
                $this->dispatch('showCedulaModal');
            } else {
                $this->alert('error', 'No cedula found for this request.');
            }
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
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
            $this->currentDiscountType = null;
            $this->currentDiscountAmount = null;
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function updatedResidentId()
    {
        $resident = Resident::find($this->resident_id);
        if ($resident and $resident->is_senior_citizen) {
            $this->discount_type = 'Senior Citizen';
            $this->discount_id_number = $resident->senior_citizen_id;
            $this->calculateDiscount();
        }
    }

    public function updatedDiscountType()
    {
        $this->calculateDiscount();
    }

    public function updatedCertificateType()
    {
        $this->calculateDiscount();
    }

    public function saveRequest()
    {
        $this->validate();

        try {
            // Calculate discount
            $this->calculateDiscount();

            // Process receipt if uploaded
            $receipt_path = null;
            if ($this->receipt && $this->payment_method == 'GCash') {
                $receipt_path = $this->receipt->store('receipts', 'public');
            }

            // Process cedula image if uploaded
            $cedula_path = null;
            if ($this->cedula_image) {
                $cedula_path = $this->cedula_image->store('cedulas', 'public');
            }

            $existingRequest = null;
            if ($this->request_id) {
                $existingRequest = CertificateRequest::find($this->request_id);
                $control_number = $existingRequest->control_number;
            } else {
                $control_number = Str::random(10);
            }

            $data = [
                'control_number' => $control_number,
                'resident_id' => $this->resident_id,
                'certificate_type' => $this->certificate_type,
                'purpose' => $this->purpose,
                'status' => $this->status,
                'payment_method' => $this->payment_method,
                'pickup_datetime' => $this->pickup_datetime,
                'requested_at' => now(),
                'processed_by' => Auth::id(),
                'discount_type' => $this->discount_type,
                'discount_id_number' => $this->discount_type !== 'None' ? $this->discount_id_number : null,
                'discount_amount' => $this->discount_amount,
            ];

            // Only set receipt_path if we have a new one or keep the old one
            if ($receipt_path) {
                $data['receipt_path'] = $receipt_path;
            } elseif ($existingRequest && $existingRequest->receipt_path) {
                $data['receipt_path'] = $existingRequest->receipt_path;
            }

            // Only set cedula_image_path if we have a new one or keep the old one
            if ($cedula_path) {
                $data['cedula_image_path'] = $cedula_path;
            } elseif ($existingRequest && $existingRequest->cedula_image_path) {
                $data['cedula_image_path'] = $existingRequest->cedula_image_path;
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
            $this->discount_type = $request->discount_type ?? 'None';
            $this->discount_id_number = $request->discount_id_number;
            $this->discount_amount = $request->discount_amount ?? 0;

            $this->calculateDiscount();

            // We don't set the receipt or cedula_image here because they're file uploads

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
            if (
                !Auth::user()->hasRole(['barangay_official', 'admin']) &&
                ($request->resident_id != Auth::user()->resident->id)
            ) {
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
        $this->resident_id = Auth::user()->hasRole(['barangay_official', 'admin']) ? null : Auth::user()->resident->id;
        $this->certificate_type = null;
        $this->purpose = null;
        $this->status = 'Pending';
        $this->payment_method = null;
        $this->pickup_datetime = null;
        $this->receipt = null;
        $this->cedula_image = null;
        $this->request_id = null;
        $this->discount_type = 'None';
        $this->discount_id_number = null;
        $this->discount_amount = 0;
        $this->original_fee = 0;
        $this->discounted_fee = 0;
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
    #[On('processRequest')]
    public function processRequest($id, $newStatus)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            // Handle status changes based on new workflow
            if ($newStatus == 'Approved') {
                // Step 2: Admin approves the request
                $capt = BarangayOfficial::where('position', 'LIKE', '%Punong Barangay%')
                    ->where('status', 'A')
                    ->first();

                $request->update([
                    'barangay_official_id' => $capt ? $capt->id : null,
                    'status' => $newStatus,
                    'approved_at' => now(),
                    'payment_status' => 'unpaid', // Still unpaid after approval
                    'processed_by' => Auth::id(),
                ]);

                $this->alert('success', 'Request approved. Resident will be notified to make payment.');
            } elseif ($newStatus == 'Payment Verified') {
                // Step 4: Admin verifies payment
                $request->update([
                    'status' => 'Ready for Pickup',
                    'payment_status' => 'paid',
                    'payment_verified_at' => now(),
                    'processed_by' => Auth::id(),
                    'is_paid' => true,
                ]);

                $this->alert('success', 'Payment verified. Certificate is ready for pickup.');
            } elseif ($newStatus == 'Released') {
                // Step 5: Admin releases certificate to resident
                if ($request->payment_status != 'paid' && $request->certificate_type !== 'Certificate of Indigency') {
                    $this->alert('error', 'Cannot release certificate. Payment hasn\'t been verified.');
                    return;
                }

                $request->update([
                    'status' => $newStatus,
                    'released_at' => now(),
                    'processed_by' => Auth::id(),
                ]);

                $this->alert('success', 'Certificate successfully released to resident.');
            } elseif ($newStatus == 'Rejected') {
                $request->update([
                    'status' => $newStatus,
                    'processed_by' => Auth::id(),
                ]);

                $this->alert('info', 'Request has been rejected.');
            }
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

    public function updatingDiscountFilter()
    {
        $this->resetPage();
    }

    public function updatingPaymentStatusFilter()
    {
        $this->resetPage();
    }

    public function getRequestStatusColor($status)
    {
        return match ($status) {
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
        $query = Auth::user()->hasRole(['barangay_official', 'admin'])
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
        $query = Auth::user()->hasAnyRole('barangay_official|admin')
            ? CertificateRequest::query()
            : CertificateRequest::where('resident_id', Auth::user()->resident->id);

        // Apply filters
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('certificate_type', 'like', "%{$this->search}%")
                    ->orWhere('purpose', 'like', "%{$this->search}%");

                // If admin, also search by resident name
                if (Auth::user()->hasAnyRole('barangay_official|admin')) {
                    $q->orWhereHas('resident', function ($q2) {
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

        if ($this->discountFilter) {
            $query->where('discount_type', $this->discountFilter);
        }

        if ($this->paymentStatusFilter) {
            $query->where('payment_status', $this->paymentStatusFilter);
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
