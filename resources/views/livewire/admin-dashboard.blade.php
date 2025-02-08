<div class="container mt-4">
    <h3 class="mb-3">Admin Dashboard</h3>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm border-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Residents</h5>
                    <p class="h4">{{ $totalResidents }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h5 class="card-title">Barangay Officials</h5>
                    <p class="h4">{{ $totalOfficials }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <h5 class="card-title">Pending Requests</h5>
                    <p class="h4">{{ $pendingRequests }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-info">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Events</h5>
                    <p class="h4">{{ $upcomingEvents }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Metrics -->
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card shadow-sm border-dark">
                <div class="card-body">
                    <h5 class="card-title">Active Users</h5>
                    <p class="h4">{{ $activeUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Blotter Cases</h5>
                    <p class="h4">{{ $totalBlotters }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <h5 class="card-title">Pending Blotters</h5>
                    <p class="h4">{{ $pendingBlotters }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <h5 class="card-title">Resolved Blotters</h5>
                    <p class="h4">{{ $resolvedBlotters }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Announcements -->
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h5>Recent Announcements</h5>
        </div>
        <div class="card-body">
            @forelse ($recentAnnouncements as $announcement)
                <div class="border-bottom pb-2 mb-2">
                    <h6>{{ $announcement->title }}</h6>
                    <p class="text-muted">{{ \Illuminate\Support\Str::limit($announcement->excerpt, 100) }}</p>
                    <a href="{{ route('auth.announcements.show', $announcement->id) }}" class="btn btn-sm btn-primary">Read More</a>
                </div>
            @empty
                <p>No recent announcements.</p>
            @endforelse
        </div>
    </div>
</div>
