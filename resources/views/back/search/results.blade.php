@extends('back.layouts.admin-layout')

@section('pageTitle', 'Search Results')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Search Results
                    </h2>
                    <div class="mt-1 text-muted">
                        Results for: <span class="text-primary fw-bold">"{{ $query }}"</span>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <form action="{{ route('admin.search') }}" method="get" class="d-flex">
                        <div class="me-2">
                            <input type="text" name="q" class="form-control" placeholder="Search again..."
                                value="{{ $query }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                <path d="M21 21l-6 -6"></path>
                            </svg>
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @if ($residents->count() + $blotters->count() + $certificateRequests->count() == 0)
                <div class="empty">
                    <div class="empty-img">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search-off"
                            width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5.039 5.062a7 7 0 0 0 9.91 9.89m1.984 -1.984a7 7 0 0 0 -9.925 -9.925"></path>
                            <path d="M3 3l18 18"></path>
                        </svg>
                    </div>
                    <p class="empty-title">No results found</p>
                    <p class="empty-subtitle text-muted">
                        Try adjusting your search or filter to find what you're looking for.
                    </p>
                </div>
            @else
                <!-- Residents Results -->
                @if ($residents->count() > 0)
                    <div class="mb-3 card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                                Residents ({{ $residents->count() }})
                            </h3>
                        </div>
                        <div class="p-0 card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>RFID</th>
                                            <th class="w-1">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($residents as $resident)
                                            <tr>
                                                <td>
                                                    <div class="py-1 d-flex align-items-center">
                                                        <span
                                                            class="avatar me-2">{{ substr($resident->first_name, 0, 1) . substr($resident->last_name, 0, 1) }}</span>
                                                        <div class="flex-fill">
                                                            <div class="font-weight-medium">{{ $resident->full_name }}</div>
                                                            <div class="text-muted">{{ $resident->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $resident->contact_no }}</td>
                                                <td>{{ $resident->sitio }}</td>
                                                <td>
                                                    @if ($resident->rfid_number)
                                                        <span class="badge bg-green">{{ $resident->rfid_number }}</span>
                                                    @else
                                                        <span class="badge bg-muted">Not Assigned</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-list flex-nowrap">
                                                        <a href="{{ route('admin.residents.rfid-details', $resident->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            View
                                                        </a>
                                                        <a href="{{ route('admin.residents.assign-rfid', $resident->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            RFID
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Blotter Results -->
                @if ($blotters->count() > 0)
                    <div class="mb-3 card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M13 5h8"></path>
                                    <path d="M13 9h5"></path>
                                    <path d="M13 15h8"></path>
                                    <path d="M13 19h5"></path>
                                    <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                    </path>
                                    <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                    </path>
                                </svg>
                                Blotter Records ({{ $blotters->count() }})
                            </h3>
                        </div>
                        <div class="p-0 card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Case #</th>
                                            <th>Complainant</th>
                                            <th>Respondent</th>
                                            <th>Incident Date</th>
                                            <th>Status</th>
                                            <th class="w-1">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blotters as $blotter)
                                            <tr>
                                                <td>{{ $blotter->case_number }}</td>
                                                <td>{{ $blotter->complainant_name }}</td>
                                                <td>{{ $blotter->respondent_name }}</td>
                                                <td>{{ $blotter->incident_date->format('M d, Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $blotter->status == 'pending'
                                                            ? 'yellow'
                                                            : ($blotter->status == 'resolved'
                                                                ? 'green'
                                                                : ($blotter->status == 'ongoing'
                                                                    ? 'blue'
                                                                    : 'red')) }}">
                                                        {{ ucfirst($blotter->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.blotter.show', $blotter->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Certificate Requests Results -->
                @if ($certificateRequests->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                                Certificate Requests ({{ $certificateRequests->count() }})
                            </h3>
                        </div>
                        <div class="p-0 card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Resident</th>
                                            <th>Certificate Type</th>
                                            <th>Purpose</th>
                                            <th>Status</th>
                                            <th>Payment</th>
                                            <th class="w-1">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($certificateRequests as $cert)
                                            <tr>
                                                <td>{{ $cert->resident->full_name }}</td>
                                                <td>{{ $cert->certificate_type }}</td>
                                                <td>{{ $cert->purpose }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $cert->status == 'pending'
                                                            ? 'yellow'
                                                            : ($cert->status == 'approved'
                                                                ? 'green'
                                                                : ($cert->status == 'rejected'
                                                                    ? 'red'
                                                                    : 'blue')) }}">
                                                        {{ ucfirst($cert->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $cert->payment_status == 'unpaid'
                                                            ? 'red'
                                                            : ($cert->payment_status == 'pending_verification'
                                                                ? 'yellow'
                                                                : ($cert->payment_status == 'paid'
                                                                    ? 'green'
                                                                    : 'blue')) }}">
                                                        {{ str_replace('_', ' ', ucfirst($cert->payment_status)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('auth.certs.temp1', ['request_id' => $cert->id]) }}"
                                                        class="btn btn-sm btn-primary">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
