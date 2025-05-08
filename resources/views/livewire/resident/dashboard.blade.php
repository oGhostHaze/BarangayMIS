<div>
    <!-- Page Header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Resident Dashboard
                    </h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <button class="btn btn-primary d-none d-sm-inline-block" wire:click="refreshDashboard">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                            </svg>
                            Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">
        <div class="container-xl">
            <!-- Welcome Card -->
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card card-md">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="h1">Welcome, {{ auth()->user()->name }}</h3>
                                    <p class="text-muted">
                                        Thank you for registering as a resident. You can now access various barangay
                                        services online.
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <span class="rounded avatar avatar-lg">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="mt-3 row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pending Certificate Requests</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="mb-0 h1 me-2">{{ $pendingCertificates }}</div>
                                <div class="me-auto">
                                    <span class="text-yellow d-inline-flex align-items-center lh-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 9v2m0 4v.01"></path>
                                            <path
                                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('auth.certs.resident') }}" class="btn btn-sm btn-primary">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Approved Certificates</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="mb-0 h1 me-2">{{ $approvedCertificates }}</div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('auth.certs.resident') }}" class="btn btn-sm btn-primary">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Released Certificates</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="mb-0 h1 me-2">{{ $releasedCertificates }}</div>
                                <div class="me-auto">
                                    <span class="text-blue d-inline-flex align-items-center lh-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M9 15l2 2l4 -4"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('auth.certs.resident') }}" class="btn btn-sm btn-primary">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-3 row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Quick Actions</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('auth.certs.resident') }}"
                                        class="btn btn-primary w-100 btn-icon-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M9 9l1 0"></path>
                                            <path d="M9 13l6 0"></path>
                                            <path d="M9 17l6 0"></path>
                                        </svg>
                                        Request Barangay Certificate
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('resident.blotters.index') }}"
                                        class="btn btn-warning w-100 btn-icon-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                            <path d="M13.5 6.5l4 4"></path>
                                        </svg>
                                        Report Incident
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Announcements and Events -->
            <div class="mt-3 row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Announcements</h3>
                        </div>
                        <div class="card-body">
                            @if (count($announcements) > 0)
                                <div class="divide-y">
                                    @foreach ($announcements as $announcement)
                                        <div class="py-3 row">
                                            <div class="col-auto">
                                                <div
                                                    class="avatar bg-{{ ['blue', 'green', 'red', 'yellow', 'azure'][array_rand(['blue', 'green', 'red', 'yellow', 'azure'])] }}-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                                                        </path>
                                                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h4 class="mb-1">{{ $announcement->title }}</h4>
                                                <div class="text-muted">{{ $announcement->excerpt }}</div>
                                                <small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($announcement->published_at)->diffForHumans() }}</small>
                                            </div>
                                            <div class="col-auto">
                                                <a href="{{ route('auth.announcements.show', ['id' => $announcement->id]) }}"
                                                    class="btn btn-sm btn-outline-primary">View</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty">
                                    <div class="empty-img"><img
                                            src="https://cdn.tabler.io/static/illustrations/undraw_printing_invoices_5r4r.svg"
                                            height="128" alt=""></div>
                                    <p class="empty-title">No announcements yet</p>
                                    <p class="empty-subtitle text-muted">
                                        Stay tuned for important announcements from your barangay.
                                    </p>
                                </div>
                            @endif
                        </div>
                        @if (count($announcements) > 0)
                            <div class="card-footer">
                                <a href="auth.announcements.feed" class="btn btn-sm btn-outline-primary">View All
                                    Announcements</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Upcoming Events</h3>
                        </div>
                        <div class="card-body">
                            @if (count($upcomingEvents) > 0)
                                <div class="divide-y">
                                    @foreach ($upcomingEvents as $event)
                                        <div class="py-3 row">
                                            <div class="col-auto">
                                                <div class="avatar bg-pink-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                                        </path>
                                                        <path d="M16 3l0 4"></path>
                                                        <path d="M8 3l0 4"></path>
                                                        <path d="M4 11l16 0"></path>
                                                        <path d="M8 15h2v2h-2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h4 class="mb-1">{{ $event->title }}</h4>
                                                <div class="text-muted">
                                                    {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}
                                                </div>
                                                <div class="text-muted">{{ $event->location }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty">
                                    <div class="empty-img"><img
                                            src="https://cdn.tabler.io/static/illustrations/undraw_date_picker_gorr.svg"
                                            height="128" alt=""></div>
                                    <p class="empty-title">No upcoming events</p>
                                    <p class="empty-subtitle text-muted">
                                        Check back later for community events and activities.
                                    </p>
                                </div>
                            @endif
                        </div>
                        @if (count($upcomingEvents) > 0)
                            <div class="card-footer">
                                <a href="{{ route('events.calendar') }}" class="btn btn-sm btn-outline-primary">View
                                    All Events</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
