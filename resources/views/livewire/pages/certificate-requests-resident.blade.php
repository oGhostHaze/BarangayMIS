<div>
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Certificate Requests
                    </h2>
                    <div class="mt-1 text-muted">Manage your certificate requests</div>
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
                        <button class="btn btn-primary" wire:click="showRequestForm">
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
    </div>

    <div class="page-body">
        <div class="container-xl">
            <!-- Status Cards -->
            <div class="mb-3 row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-white bg-primary avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M9 9l1 0"></path>
                                            <path d="M9 13l6 0"></path>
                                            <path d="M9 17l6 0"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $counts['total'] }} Total Requests
                                    </div>
                                    <div class="text-muted">
                                        All certificate requests
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-white bg-warning avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                            <path d="M12 12l.01 0"></path>
                                            <path d="M12 8l0 4"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $counts['pending'] }} Pending
                                    </div>
                                    <div class="text-muted">
                                        Awaiting processing
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-white bg-success avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $counts['approved'] }} Approved
                                    </div>
                                    <div class="text-muted">
                                        Ready for pickup
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="text-white bg-info avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                            </path>
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                            </path>
                                            <path d="M9 14l2 2l4 -4"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $counts['released'] }} Released
                                    </div>
                                    <div class="text-muted">
                                        Completed requests
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Request Form Modal -->
            @if ($showing_form)
                <div class="mb-3 card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $isEditing ? 'Edit Request' : 'New Certificate Request' }}</h3>
                        <div class="card-actions">
                            <a href="#" class="btn-close" wire:click="hideRequestForm"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveRequest">
                            <div class="row">
                                <div class="mb-3 col-md-6">
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
                                <div class="mb-3 col-md-12">
                                    <label class="form-label required">Purpose</label>
                                    <textarea class="form-control @error('purpose') is-invalid @enderror" wire:model="purpose" rows="3"
                                        placeholder="Explain the purpose for requesting this certificate"></textarea>
                                    @error('purpose')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Payment and Pickup Section -->
                            <div class="pt-3 mt-3 border-top">
                                <h4 class="mb-3">Payment & Pickup Details</h4>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label required">Mode of Payment</label>
                                        <select class="form-select @error('payment_method') is-invalid @enderror"
                                            wire:model="payment_method">
                                            <option value="">Select Payment Method</option>
                                            <option value="Cash">Cash (Pay upon pickup)</option>
                                            <option value="GCash">GCash</option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label required">Preferred Pickup Date & Time</label>
                                        <input type="datetime-local"
                                            class="form-control @error('pickup_datetime') is-invalid @enderror"
                                            wire:model="pickup_datetime">
                                        @error('pickup_datetime')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-hint">Office hours: Monday-Friday, 8:00 AM - 5:00 PM</small>
                                    </div>
                                </div>

                                @if ($payment_method == 'GCash')
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label required">GCash Receipt</label>
                                            <div class="input-group">
                                                <input type="file"
                                                    class="form-control @error('receipt') is-invalid @enderror"
                                                    wire:model="receipt" accept="image/*,.pdf">
                                                @error('receipt')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <small class="form-hint">Upload a screenshot or PDF of your GCash payment
                                                receipt</small>

                                            <div class="mt-2">
                                                <div class="alert alert-info" role="alert">
                                                    <div class="d-flex">
                                                        <div>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon alert-icon" width="24" height="24"
                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <circle cx="12" cy="12" r="9"></circle>
                                                                <line x1="12" y1="8" x2="12"
                                                                    y2="12"></line>
                                                                <line x1="12" y1="16" x2="12.01"
                                                                    y2="16"></line>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h4 class="alert-title">GCash Payment Information</h4>
                                                            <div class="text-muted">Send payment to:
                                                                <strong>09123456789</strong> (Juan Dela Cruz, Barangay
                                                                Treasurer)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-footer">
                                <button type="button" class="btn btn-link"
                                    wire:click="hideRequestForm">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ $isEditing ? 'Update Request' : 'Submit Request' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <!-- Filter Options -->
            <div class="mb-3 card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <label class="form-label">Date Range</label>
                            <input type="text" class="form-control" placeholder="Select date range"
                                wire:model.live="dateRange">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requests Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Certificate Requests</h3>
                </div>
                <div class="py-3 card-body border-bottom">
                    <div class="d-flex">
                        <div class="text-muted">
                            Show
                            <div class="mx-2 d-inline-block">
                                <select class="form-select form-select-sm" wire:model.live="perPage">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            entries
                        </div>
                        <div class="ms-auto text-muted">
                            Search:
                            <div class="ms-2 d-inline-block">
                                <input type="text" class="form-control form-control-sm"
                                    wire:model.live.debounce.300ms="search">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Certificate Type</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Pickup Date</th>
                                <th>Requested</th>
                                <th class="w-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->certificate_type }}</td>
                                    <td>
                                        <span class="text-muted">{{ Str::limit($request->purpose, 50) }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge text-white {{ $this->getRequestStatusColor($request->status) }}">{{ $request->status }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $request->payment_method == 'GCash' ? 'bg-green-lt' : 'bg-azure-lt' }}">
                                            {{ $request->payment_method }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($request->pickup_datetime)
                                            {{ Carbon\Carbon::parse($request->pickup_datetime)->format('M d, Y g:i A') }}
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>{{ $request->requested_at->format('M d, Y g:i A') }}</td>
                                    <td class="text-end">
                                        <div class="btn-list flex-nowrap">
                                            @if ($request->status == 'Pending')
                                                <button class="btn btn-sm btn-outline-primary"
                                                    wire:click="editRequest({{ $request->id }})">
                                                    Edit
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning"
                                                    wire:click="cancelRequest({{ $request->id }})"
                                                    onclick="confirm('Are you sure you want to cancel this request?') || event.stopImmediatePropagation()">
                                                    Cancel
                                                </button>
                                            @endif

                                            @if ($request->status == 'Approved')
                                                <button class="btn btn-sm btn-outline-success" disabled>
                                                    Ready for Pickup
                                                </button>
                                            @endif

                                            @if (in_array($request->status, ['Pending', 'Cancelled']))
                                                <button class="btn btn-sm btn-outline-danger"
                                                    wire:click="deleteRequest({{ $request->id }})"
                                                    onclick="confirm('Are you sure you want to delete this request?') || event.stopImmediatePropagation()">
                                                    Delete
                                                </button>
                                            @endif

                                            @if ($request->receipt_path && $request->payment_method == 'GCash')
                                                <a href="#" class="btn btn-sm btn-outline-info"
                                                    wire:click="viewReceipt({{ $request->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#receiptModal">
                                                    View Receipt
                                                </a>
                                            @endif

                                            @if ($request->status == 'Released')
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
                                    <td colspan="8" class="py-4 text-center">
                                        <div class="empty">
                                            <div class="empty-img">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-file-off" width="40"
                                                    height="40" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M3 3l18 18"></path>
                                                    <path d="M17 17h-12a2 2 0 0 1 -2 -2v-10"></path>
                                                    <path d="M7 3h7l5 5v7m0 4a2 2 0 0 1 -2 2"></path>
                                                </svg>
                                            </div>
                                            <p class="empty-title">No certificate requests found</p>
                                            <p class="empty-subtitle text-muted">
                                                No certificate requests matching your criteria were found.
                                            </p>
                                            <div class="empty-action">
                                                <button class="btn btn-primary" wire:click="showRequestForm">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
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
                    {{ $requests->links() }}
                </div>
            </div>

            <!-- Information Card -->
            <div class="mt-3 row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Important Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Document Collection Instructions</h4>
                                    <ul class="space-y-1 list-unstyled">
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Bring a valid ID when collecting your documents</span>
                                        </li>
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Cash payments must be settled during pickup</span>
                                        </li>
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">GCash payments must be made to the official barangay
                                                GCash account</span>
                                        </li>
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Collection hours: Monday to Friday, 8:00 AM to 5:00
                                                PM</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h4>Certificate Fees</h4>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th>Certificate Type</th>
                                                    <th>Fee</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Barangay Clearance</td>
                                                    <td>₱50.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Certificate of Residency</td>
                                                    <td>₱50.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Certificate of Indigency</td>
                                                    <td>Free</td>
                                                </tr>
                                                <tr>
                                                    <td>Business Clearance</td>
                                                    <td>₱100.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Good Moral Character</td>
                                                    <td>₱50.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Receipt Modal -->
    @if ($viewingReceipt)
        <div class="modal modal-blur fade" id="receiptModal" tabindex="-1" role="dialog" aria-hidden="true"
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
</div>
