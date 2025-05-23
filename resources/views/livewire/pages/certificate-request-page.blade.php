<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Certificate Requests Management
                </h2>
                <div class="mt-1 text-muted">Process and manage resident certificate requests</div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <div class="me-3 d-none d-md-block">
                        <div class="input-icon">
                            <input type="text" class="form-control" placeholder="Search..."
                                wire:model.live.debounce.300ms="search">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                    <path d="M21 21l-6 -6"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        New Request
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-fluid">
            <!-- Statistics Cards -->
            <div class="mb-3 row row-deck row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Requests</div>
                                <div class="ms-auto lh-1">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">Today</a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item active" href="#">Today</a>
                                            <a class="dropdown-item" href="#">This Week</a>
                                            <a class="dropdown-item" href="#">This Month</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 h1">{{ $stats['total'] }}</div>
                            <div class="mb-2 d-flex">
                                <div>Completion Rate</div>
                                <div class="ms-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        {{ $stats['completion_rate'] }}%
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: {{ $stats['completion_rate'] }}%"
                                    role="progressbar" aria-valuenow="{{ $stats['completion_rate'] }}" aria-valuemin="0"
                                    aria-valuemax="100" aria-label="Completion Rate">
                                    <span class="visually-hidden">Completion Rate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pending Requests</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="mb-0 h1 me-2">{{ $stats['pending'] }}</div>
                                <div class="me-auto">
                                    <span class="text-yellow d-inline-flex align-items-center lh-1">
                                        {{ $stats['pending_percentage'] }}%
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path d="M12 12l.01 0" />
                                            <path d="M12 9l0 3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Ready for Pickup</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="mb-0 h1 me-2">{{ $stats['approved'] }}</div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Released Certificates</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="mb-0 h1 me-2">{{ $stats['released'] }}</div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                                            <path d="M12 3v3m0 12v3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Options -->
            <div class="mb-3 card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Payment Status</label>
                            <select class="form-select" wire:model.live="paymentStatusFilter">
                                <option value="">All Statuses</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="pending_verification">Pending Verification</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Filter by Status</label>
                            <select class="form-select" wire:model.live="statusFilter">
                                <option value="">All Statuses</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Released">Released</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Filter by Payment Method</label>
                            <select class="form-select" wire:model.live="paymentFilter">
                                <option value="">All Payment Methods</option>
                                <option value="Cash">Cash</option>
                                <option value="GCash">GCash</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Filter by Discount</label>
                            <select class="form-select" wire:model.live="discountFilter">
                                <option value="">All Discounts</option>
                                <option value="None">No Discount</option>
                                <option value="Student">Student</option>
                                <option value="Senior Citizen">Senior Citizen</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Pickup Date</label>
                            <input type="text" class="form-control" placeholder="Select pickup date"
                                wire:model.live="pickupDateFilter">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Requests Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Certificate Requests</h3>
                </div>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Control #</th>
                                <th>Resident</th>
                                <th>Certificate Type</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Discount</th>
                                <th>Cedula</th>
                                <th>Pickup Date</th>
                                <th>Requested At</th>
                                <th>Processed By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->control_number }}</td>
                                    <td>
                                        <div class="py-1 d-flex align-items-center">
                                            <span
                                                class="avatar me-2">{{ substr($request->resident->first_name, 0, 1) }}{{ substr($request->resident->last_name, 0, 1) }}</span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $request->resident->first_name }}
                                                    {{ $request->resident->last_name }}</div>
                                                <div class="text-muted">{{ $request->resident->contact_no }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $request->certificate_type }}</td>
                                    <td><span data-bs-toggle="tooltip"
                                            title="{{ $request->purpose }}">{{ Str::limit($request->purpose, 30) }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge text-white {{ $this->getRequestStatusColor($request->status) }}">{{ $request->status }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $request->payment_method == 'GCash' ? 'bg-green-lt' : 'bg-azure-lt' }}">
                                            {{ $request->payment_method }}
                                            @if ($request->payment_method == 'GCash' && $request->receipt_path)
                                                <a href="#" wire:click="viewReceipt({{ $request->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#receiptModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-eye" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                        <path
                                                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </span>
                                        <div class="mt-1 text-white">
                                            @if ($request->is_paid || $request->certificate_type === 'Certificate of Indigency')
                                                <span class="text-white badge bg-green">Paid</span>
                                            @elseif($request->payment_method === 'GCash' && $request->receipt_path)
                                                <span class="text-white badge bg-yellow">Verify Payment</span>
                                            @else
                                                <span class="text-white badge bg-red">Unpaid</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($request->discount_type && $request->discount_type !== 'None')
                                            <span class="badge bg-purple-lt">{{ $request->discount_type }}</span>
                                            <div class="mt-1 text-muted">
                                                <small>₱{{ number_format($request->discount_amount, 2) }} off</small>
                                            </div>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->cedula_image_path)
                                            <a href="#" wire:click="viewCedula({{ $request->id }})"
                                                data-bs-toggle="modal" data-bs-target="#cedulaModal"
                                                class="badge bg-blue-lt d-flex align-items-center justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-id" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                                    </path>
                                                    <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path d="M15 8l2 0"></path>
                                                    <path d="M15 12l2 0"></path>
                                                    <path d="M7 16l10 0"></path>
                                                </svg>
                                                View Cedula
                                            </a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->pickup_datetime)
                                            <span
                                                class="{{ $this->isPickupToday($request->pickup_datetime) ? 'text-warning font-weight-bold' : '' }}">
                                                {{ Carbon\Carbon::parse($request->pickup_datetime)->format('M d, Y g:i A') }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>{{ $request->requested_at->format('M d, Y g:i A') }}</td>
                                    <td>{{ $request->processedBy ? $request->processedBy->name : 'N/A' }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            @if ($request->status == 'Pending')
                                                @if ($request->payment_method == 'GCash' && $request->receipt_path or $request->payment_method == 'Cash')
                                                    <button class="btn btn-sm btn-success"
                                                        wire:click="$dispatch('openConfirmModal', { requestId: {{ $request->id }}, action: 'approve', status: 'Approved' })">
                                                        Approve
                                                    </button>
                                                @endif
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="$dispatch('openConfirmModal', { requestId: {{ $request->id }}, action: 'reject', status: 'Rejected' })">
                                                    Reject
                                                </button>
                                            @elseif ($request->status == 'Approved' && $request->payment_status == 'pending_verification')
                                                <button class="btn btn-sm btn-warning"
                                                    wire:click="$dispatch('openConfirmModal', { requestId: {{ $request->id }}, action: 'verify-payment', status: 'Payment Verified' })">
                                                    Verify Payment
                                                </button>
                                            @elseif ($request->status == 'Ready for Pickup')
                                                <button class="btn btn-sm btn-info"
                                                    wire:click="$dispatch('openConfirmModal', { requestId: {{ $request->id }}, action: 'release', status: 'Released' })">
                                                    Mark Released
                                                </button>
                                            @endif
                                            @if ($request->status === 'Released' or $request->status === 'Ready for Pickup')
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('auth.certs.temp1', ['request_id' => $request->id]) }}"
                                                    target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-printer" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                                        </path>
                                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                        <path
                                                            d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                                        </path>
                                                    </svg>
                                                    Print
                                                </a>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="py-4 text-center">
                                        <div class="empty">
                                            <div class="empty-img">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-certificate" width="40"
                                                    height="40" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                    <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5"></path>
                                                    <path
                                                        d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73">
                                                    </path>
                                                    <path d="M6 9l12 0"></path>
                                                    <path d="M6 12l3 0"></path>
                                                    <path d="M6 15l2 0"></path>
                                                </svg>
                                            </div>
                                            <p class="empty-title">No certificate requests found</p>
                                            <p class="empty-subtitle text-muted">
                                                No certificate requests matching your criteria were found.
                                            </p>
                                            <div class="empty-action">
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#requestModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 5l0 14"></path>
                                                        <path d="M5 12l14 0"></path>
                                                    </svg>
                                                    Create a new request
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center">
                    @if ($requests->count() > 0)
                        <p class="m-0 text-muted">Showing <span>{{ $requests->firstItem() }}</span> to
                            <span>{{ $requests->lastItem() }}</span> of <span>{{ $requests->total() }}</span> entries
                        </p>
                    @else
                        <p class="m-0 text-muted">Showing 0 to 0 of 0 entries</p>
                    @endif
                    <div class="ms-auto">
                        {{ $requests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Request Modal -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $request_id ? 'Edit' : 'New' }} Certificate Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveRequest">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label required">Resident</label>
                                <select class="form-select @error('resident_id') is-invalid @enderror"
                                    wire:model.live="resident_id">
                                    <option value="">Select Resident</option>
                                    @foreach ($residents as $resident)
                                        <option value="{{ $resident->id }}">{{ $resident->first_name }}
                                            {{ $resident->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('resident_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Certificate Type</label>
                                <select class="form-select @error('certificate_type') is-invalid @enderror"
                                    wire:model="certificate_type">
                                    <option value="">Select Certificate Type</option>
                                    @foreach ($certificateTypes as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('certificate_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Purpose</label>
                            <textarea class="form-control @error('purpose') is-invalid @enderror" wire:model="purpose" rows="3"
                                placeholder="Explain the purpose for requesting this certificate"></textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Discount Fields (New) -->
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label">Discount Type</label>
                                <select class="form-select @error('discount_type') is-invalid @enderror"
                                    wire:model="discount_type">
                                    <option value="None">No Discount</option>
                                    <option value="Student">Student (20% Off)</option>
                                    <option value="Senior Citizen">Senior Citizen (30% Off)</option>
                                </select>
                                @error('discount_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6" x-data="{ showIdField: @entangle('discount_type').defer !== 'None' }">
                                <label class="form-label" x-bind:class="{ 'required': showIdField }">ID Number</label>
                                <input type="text"
                                    class="form-control @error('discount_id_number') is-invalid @enderror"
                                    wire:model.live="discount_id_number" placeholder="Enter student/senior citizen ID"
                                    x-bind:disabled="!showIdField">
                                @error('discount_id_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint">Required for discount validation</small>
                            </div>
                        </div>

                        @if (isset($original_fee) && $original_fee > 0 && isset($discounted_fee))
                            <div class="mb-3">
                                <div class="alert alert-info">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-receipt" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                                <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                                <path d="M12 7v9" />
                                            </svg>
                                        </div>
                                        <div class="ms-2">
                                            <h4 class="alert-title">Fee Information</h4>
                                            <div class="text-muted">
                                                Original Fee: ₱{{ number_format($original_fee, 2) }}
                                                @if ($discount_type !== 'None')
                                                    <br>
                                                    Discount ({{ $discount_type }}):
                                                    -₱{{ number_format($discount_amount, 2) }}
                                                    <br>
                                                    <strong>Final Fee:
                                                        ₱{{ number_format($discounted_fee, 2) }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label required">Mode of Payment</label>
                                <select class="form-select @error('payment_method') is-invalid @enderror"
                                    wire:model.live="payment_method">
                                    <option value="">Select Payment Method</option>
                                    <option value="Cash">Cash (Pay upon pickup)</option>
                                    <option value="GCash">GCash</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required">Pickup Date & Time</label>
                                <input type="datetime-local"
                                    class="form-control @error('pickup_datetime') is-invalid @enderror"
                                    wire:model="pickup_datetime">
                                @error('pickup_datetime')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if ($payment_method == 'GCash')
                            <div class="mb-3">
                                <label class="form-label">GCash Receipt (Optional for admin)</label>
                                <input type="file" class="form-control @error('receipt') is-invalid @enderror"
                                    wire:model="receipt" accept="image/*,.pdf">
                                @error('receipt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint">Upload a screenshot or PDF of the GCash payment
                                    receipt</small>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" wire:model="status">
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Released">Released</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                            {{ $request_id ? 'Update Request' : 'Create Request' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Confirmation Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash text-primary"
                            width="64" height="64" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z">
                            </path>
                            <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0">
                            </path>
                            <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2">
                            </path>
                        </svg>
                    </div>

                    <p class="text-center">Please confirm that payment has been
                        received for this certificate request.</p>

                    <div class="alert alert-info" role="alert">
                        <div class="d-flex">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 9h.01"></path>
                                    <path d="M11 12h1v4h1"></path>
                                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="alert-title">Certificate Fee
                                    Information</h4>
                                <div class="text-muted">
                                    @if ($currentCertificateType)
                                        {{ $currentCertificateType }}:
                                        ₱{{ number_format($currentCertificateFee, 2) }}

                                        @if ($currentDiscountType && $currentDiscountType !== 'None')
                                            <hr class="my-2">
                                            <div class="d-flex justify-content-between">
                                                <span>Original Fee:</span>
                                                <span>₱{{ number_format($currentCertificateFee, 2) }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>{{ $currentDiscountType }} Discount:</span>
                                                <span
                                                    class="text-danger">-₱{{ number_format($currentDiscountAmount, 2) }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between fw-bold">
                                                <span>Total to Collect:</span>
                                                <span>₱{{ number_format($currentCertificateFee - $currentDiscountAmount, 2) }}</span>
                                            </div>
                                        @endif
                                    @else
                                        Loading fee information...
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="confirmPaymentAndRelease">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                        Confirm Payment & Release
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('showPaymentModal', event => {
                // Show modal
                var modal = new bootstrap.Modal(document.getElementById('paymentModal'));
                modal.show();
            });

            window.addEventListener('closePaymentModal', event => {
                var modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
                if (modal) {
                    modal.hide();
                }
            });
        });
    </script>

    <!-- Receipt Modal -->
    @if ($viewingReceipt)
        <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-hidden="true"
            wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment Receipt</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="text-center modal-body">
                        @if (Str::endsWith($currentReceipt, '.pdf'))
                            <div class="mb-3">
                                <a href="{{ $currentReceipt }}" class="btn btn-primary" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-file-type-pdf" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"></path>
                                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6"></path>
                                        <path d="M17 18h2"></path>
                                        <path d="M20 15h-3v6"></path>
                                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z"></path>
                                    </svg>
                                    View PDF Receipt
                                </a>
                            </div>
                        @else
                            <img src="{{ $currentReceipt }}" class="rounded img-fluid" alt="Payment Receipt">
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Now let's add the Cedula Modal -->
    <div wire:ignore.self class="modal fade" id="cedulaModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id me-1"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                            </path>
                            <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M15 8l2 0"></path>
                            <path d="M15 12l2 0"></path>
                            <path d="M7 16l10 0"></path>
                        </svg>
                        Cedula (Community Tax Certificate)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center modal-body">
                    @if ($viewingCedula)
                        @if (Str::endsWith($currentCedula, '.pdf'))
                            <div class="mb-3">
                                <a href="{{ $currentCedula }}" class="btn btn-primary" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-file-type-pdf" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"></path>
                                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6"></path>
                                        <path d="M17 18h2"></path>
                                        <path d="M20 15h-3v6"></path>
                                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z"></path>
                                    </svg>
                                    View PDF Cedula
                                </a>
                            </div>
                        @else
                            <img src="{{ $currentCedula }}" class="rounded img-fluid" alt="Cedula Image">
                        @endif
                    @else
                        <div class="empty">
                            <div class="empty-img">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-file-search" width="40" height="40"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M12 21h-5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v4.5"></path>
                                    <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                                    <path d="M18.5 19.5l2.5 2.5"></path>
                                </svg>
                            </div>
                            <p class="empty-title">No cedula found</p>
                            <p class="empty-subtitle text-muted">
                                The cedula image could not be loaded or is not available.
                            </p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status" id="modalStatus"></div>
                <div class="py-4 text-center modal-body">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-2 icon text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3 id="confirmTitle">Are you sure?</h3>
                    <div class="text-muted" id="confirmMessage">Do you really want to perform this action?</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                            <div class="col">
                                <button type="button" id="confirmActionBtn" class="btn btn-danger w-100"
                                    wire:click="processRequest(document.getElementById('requestIdField').value, document.getElementById('statusField').value)"
                                    data-bs-dismiss="modal">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="requestIdField" value="">
                <input type="hidden" id="statusField" value="">
            </div>
        </div>
    </div>
</div>

@script
    <!-- Add script to handle Cedula Modal -->
    <script>
        // Listen for the openConfirmModal event
        window.addEventListener('requestModal', event => {
            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('requestModal'));
            modal.show();
        });
        window.addEventListener('openConfirmModal', event => {
            const data = event.detail;
            const requestId = data.requestId;
            const action = data.action;
            const status = data.status;

            // Set hidden field values
            document.getElementById('requestIdField').value = requestId;
            document.getElementById('statusField').value = status;

            // Update modal appearance
            const modalTitle = document.getElementById('confirmTitle');
            const modalMessage = document.getElementById('confirmMessage');
            const modalStatus = document.getElementById('modalStatus');
            const confirmButton = document.getElementById('confirmActionBtn');

            // Configure modal based on action type
            switch (action) {
                case 'approve':
                    modalStatus.className = 'modal-status bg-success';
                    modalTitle.textContent = 'Approve Request';
                    modalMessage.textContent =
                        'Are you sure you want to approve this certificate request?';
                    confirmButton.className = 'btn btn-success w-100';
                    confirmButton.textContent = 'Yes, Approve';
                    break;
                case 'reject':
                    modalStatus.className = 'modal-status bg-danger';
                    modalTitle.textContent = 'Reject Request';
                    modalMessage.textContent =
                        'Are you sure you want to reject this certificate request?';
                    confirmButton.className = 'btn btn-danger w-100';
                    confirmButton.textContent = 'Yes, Reject';
                    break;
                case 'verify-payment':
                    modalStatus.className = 'modal-status bg-warning';
                    modalTitle.textContent = 'Verify Payment';
                    modalMessage.textContent =
                        'Have you verified the payment for this certificate request?';
                    confirmButton.className = 'btn btn-warning w-100';
                    confirmButton.textContent = 'Yes, Verified';
                    break;
                case 'release':
                    modalStatus.className = 'modal-status bg-info';
                    modalTitle.textContent = 'Mark as Released';
                    modalMessage.textContent =
                        'Confirm that this certificate has been released to the resident?';
                    confirmButton.className = 'btn btn-info w-100';
                    confirmButton.textContent = 'Yes, Mark Released';
                    break;
                default:
                    modalStatus.className = 'modal-status bg-primary';
                    modalTitle.textContent = 'Confirm Action';
                    modalMessage.textContent = 'Are you sure you want to perform this action?';
                    confirmButton.className = 'btn btn-primary w-100';
                    confirmButton.textContent = 'Confirm';
            }

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
        });
        window.addEventListener('showCedulaModal', event => {
            // Show modal
            var modal = new bootstrap.Modal(document.getElementById('cedulaModal'));
            modal.show();
        });

        window.addEventListener('closeCedulaModal', event => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('cedulaModal'));
            if (modal) {
                modal.hide();
            }
        });
    </script>
@endscript
