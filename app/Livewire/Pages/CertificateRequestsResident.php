<?php

namespace App\Livewire\Pages;

use App\Models\BarangayOfficial;
use App\Models\CertificateRequest;
use App\Models\Resident;
use App\Traits\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CertificateRequestsResident extends Component
{
    use WithPagination, WithFileUploads, Toastr;

    protected $paginationTheme = 'bootstrap';

    // Form properties
    public $resident_id;
    public $certificate_type;
    public $paymentFilter;
    public $pickupDateFilter;
    public $purpose;
    public $status = 'Pending';
    public $request_id;
    public $showing_form = false;
    public $payment_method;
    public $pickup_datetime;
    public $receipt;

    // View properties
    public $viewingReceipt = false;
    public $currentReceipt;
    public $perPage = 10;

    // Certificate types for dropdown
    public $certificateTypes = [
        'Barangay Clearance' => 'Barangay Clearance',
        'Certificate of Residency' => 'Certificate of Residency',
        'Certificate of Indigency' => 'Certificate of Indigency',
        'Business Clearance' => 'Business Clearance',
        'Good Moral Character' => 'Good Moral Character',
    ];

    // Tracking form state
    public $isEditing = false;

    // Filtering and search
    public $search = '';
    public $statusFilter = '';
    public $dateRange = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected function rules()
    {
        return [
            'resident_id' => 'required|exists:residents,id',
            'certificate_type' => 'required|string',
            'purpose' => 'required|string|min:5',
            'payment_method' => 'required|in:Cash,GCash',
            'pickup_datetime' => 'required|date',
            'receipt' => $this->payment_method == 'GCash' ? 'required|file|mimes:jpg,jpeg,png,pdf|max:2048' : 'nullable',
        ];
    }

    protected $messages = [
        'certificate_type.required' => 'Please select a certificate type',
        'purpose.required' => 'Please provide a purpose for requesting this certificate',
        'purpose.min' => 'The purpose should be at least 5 characters',
        'payment_method.required' => 'Please select a payment method',
        'pickup_datetime.required' => 'Please select a pickup date and time',
        'pickup_datetime.after' => 'Pickup date must be in the future',
        'receipt.required' => 'Please upload a GCash payment receipt',
        'receipt.file' => 'The receipt must be a file',
        'receipt.mimes' => 'The receipt must be a JPG, PNG, or PDF file',
        'receipt.max' => 'The receipt must not exceed 2MB',
    ];

    public $residents = [];


    public function isPickupToday($date)
    {
        return Carbon::parse($date)->isToday();
    }
    public function mount()
    {
        // Ensure the user has a resident profile
        if (Auth::check() && Auth::user()->resident) {
            $this->resident_id = Auth::user()->resident->id;

            // For regular residents, they can only see themselves
            if (Auth::user()->hasRole('resident')) {
                $this->residents = collect([Auth::user()->resident]);
            }
            // For admins/staff, they can see all residents
            else if (Auth::user()->hasAnyRole(['admin', 'super-admin', 'staff'])) {
                $this->residents = Resident::orderBy('last_name')->orderBy('first_name')->get();
            }
        }
    }

    public function showRequestForm()
    {
        $this->resetValidation();
        $this->resetFields();
        $this->isEditing = false;
        $this->showing_form = true;
    }

    public function hideRequestForm()
    {
        $this->showing_form = false;
    }

    public function saveRequest()
    {
        $this->validate();

        try {
            if ($this->isEditing) {
                // Check if the request belongs to the current user
                $request = CertificateRequest::findOrFail($this->request_id);
                if ($request->resident_id != Auth::user()->resident->id) {
                    $this->alert('error', 'You are not authorized to edit this request.');
                    return;
                }

                // Only allow editing if status is still pending
                if ($request->status != 'Pending') {
                    $this->alert('error', 'You cannot edit a request that has already been processed.');
                    return;
                }
            }

            // Process receipt if uploaded
            $receipt_path = null;
            if ($this->receipt && $this->payment_method == 'GCash') {
                $receipt_path = $this->receipt->store('receipts', 'public');
            }

            CertificateRequest::updateOrCreate(
                ['id' => $this->request_id],
                [
                    'resident_id' => $this->resident_id,
                    'certificate_type' => $this->certificate_type,
                    'purpose' => $this->purpose,
                    'status' => $this->status,
                    'payment_method' => $this->payment_method,
                    'pickup_datetime' => $this->pickup_datetime,
                    'receipt_path' => $receipt_path ?: ($this->isEditing ? $request->receipt_path : null),
                    'requested_at' => now(),
                    'processed_by' => $this->isEditing ? $request->processed_by : null,
                ]
            );

            $this->alert('success', $this->isEditing ? 'Request updated successfully!' : 'Request submitted successfully!');
            $this->hideRequestForm();
            $this->resetFields();
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function editRequest($id)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            // Check if request belongs to current user
            if ($request->resident_id != Auth::user()->resident->id) {
                $this->alert('error', 'You are not authorized to edit this request.');
                return;
            }

            // Check if request is still pending
            if ($request->status != 'Pending') {
                $this->alert('error', 'You cannot edit a request that has already been processed.');
                return;
            }

            $this->request_id = $request->id;
            $this->resident_id = $request->resident_id;
            $this->certificate_type = $request->certificate_type;
            $this->purpose = $request->purpose;
            $this->status = $request->status;
            $this->payment_method = $request->payment_method;
            $this->pickup_datetime = $request->pickup_datetime;
            // Don't set the receipt as it's a file upload

            $this->isEditing = true;
            $this->showing_form = true;
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function cancelRequest($id)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            // Check if request belongs to current user
            if ($request->resident_id != Auth::user()->resident->id) {
                $this->alert('error', 'You are not authorized to cancel this request.');
                return;
            }

            // Check if request is still pending
            if ($request->status != 'Pending') {
                $this->alert('error', 'You cannot cancel a request that has already been processed.');
                return;
            }

            $request->status = 'Cancelled';
            $request->save();

            $this->alert('info', 'Request cancelled successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function deleteRequest($id)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            // Check if request belongs to current user
            if ($request->resident_id != Auth::user()->resident->id) {
                $this->alert('error', 'You are not authorized to delete this request.');
                return;
            }

            // Check if request is still pending
            if ($request->status != 'Pending' && $request->status != 'Cancelled') {
                $this->alert('error', 'You cannot delete a request that has already been processed.');
                return;
            }

            $request->delete();
            $this->alert('info', 'Request deleted successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function viewReceipt($id)
    {
        try {
            $request = CertificateRequest::findOrFail($id);

            // Check if request belongs to current user
            if ($request->resident_id != Auth::user()->resident->id) {
                $this->alert('error', 'You are not authorized to view this receipt.');
                return;
            }

            if ($request->receipt_path) {
                $this->currentReceipt = Storage::url($request->receipt_path);
                $this->viewingReceipt = true;
            } else {
                $this->alert('error', 'No receipt found for this request.');
            }
        } catch (\Exception $e) {
            $this->alert('error', 'Error: ' . $e->getMessage());
        }
    }

    public function resetFields()
    {
        $this->certificate_type = '';
        $this->purpose = '';
        $this->request_id = null;
        $this->payment_method = '';
        $this->pickup_datetime = '';
        $this->receipt = null;
        $this->isEditing = false;
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

    // Calculate request age in days
    public function getRequestAge($requestedAt)
    {
        return Carbon::parse($requestedAt)->diffInDays(now());
    }

    // In CertificateRequestsResident.php, add this method to calculate stats:

    public function getStats()
    {
        $total = CertificateRequest::where('resident_id', Auth::user()->resident->id)->count();
        $pending = CertificateRequest::where('resident_id', Auth::user()->resident->id)->where('status', 'Pending')->count();
        $approved = CertificateRequest::where('resident_id', Auth::user()->resident->id)->where('status', 'Approved')->count();
        $released = CertificateRequest::where('resident_id', Auth::user()->resident->id)->where('status', 'Released')->count();

        // Calculate completion rate
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
        // Make sure user has a resident profile
        if (!Auth::check() || !Auth::user()->resident) {
            return view('livewire.pages.resident-profile-incomplete')->layout('back.layouts.pages-layout');
        }

        $query = CertificateRequest::where('resident_id', Auth::user()->resident->id);

        // Apply filters
        if ($this->search) {
            $query->where(function($q) {
                $q->where('certificate_type', 'like', "%{$this->search}%")
                ->orWhere('purpose', 'like', "%{$this->search}%");
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
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

        // Sort by most recent first
        $requests = $query->orderBy('requested_at', 'desc')->paginate($this->perPage);

        // Get counts for statistics
        $counts = [
            'total' => CertificateRequest::where('resident_id', Auth::user()->resident->id)->count(),
            'pending' => CertificateRequest::where('resident_id', Auth::user()->resident->id)->where('status', 'Pending')->count(),
            'approved' => CertificateRequest::where('resident_id', Auth::user()->resident->id)->where('status', 'Approved')->count(),
            'released' => CertificateRequest::where('resident_id', Auth::user()->resident->id)->where('status', 'Released')->count(),
        ];

        // Get additional stats for dashboard if needed
        $stats = $this->getStats();

        return view('livewire.pages.certificate-requests-resident', [
            'requests' => $requests,
            'counts' => $counts,
            'stats' => $stats,
        ])->layout('back.layouts.pages-layout');
    }
}