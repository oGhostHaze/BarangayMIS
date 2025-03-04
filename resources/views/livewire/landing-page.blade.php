<div class="container py-5">
    {{-- Hero Section --}}
    <div class="mb-5 text-center">
        <h1 class="fw-bold">Welcome to Barangay Namoroc</h1>
        <p class="text-muted">Your trusted source for updates and community services.</p>
        <div class="gap-3 d-flex justify-content-center">
            <a href="{{ route('announcements.feed') }}" class="btn btn-primary">View Announcements</a>
            <a href="{{ route('events.calendar') }}" class="btn btn-outline-primary">Check Events</a>
            @if (Auth::user())
                <a href="{{ route('auth.admin.dashboard') }}" class="btn btn-success">Go to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-success">Login</a>
            @endif
        </div>
    </div>

    {{-- Latest Announcements --}}
    <div class="mb-5">
        <h2 class="mb-3">📢 Latest Announcements</h2>
        <div class="row">
            @forelse ($announcements as $announcement)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $announcement->image ?? 'https://via.placeholder.com/400' }}" class="card-img-top"
                            alt="Announcement">
                        <div class="card-body">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <p class="card-text">{{ Str::limit($announcement->excerpt, 100) }}</p>
                            <a href="{{ route('announcements.feed', $announcement->id) }}"
                                class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No data found.</p>
            @endforelse
        </div>
    </div>`

    {{-- Upcoming Events --}}
    <div class="mb-5">
        <h2 class="mb-3">📅 Upcoming Events</h2>
        <div class="list-group">
            @forelse ($events as $event)
                <a href="{{ route('events.calendar') }}" class="list-group-item list-group-item-action">
                    <strong>{{ $event->title }}</strong> <br>
                    <small>{{ $event->start_date->format('F j, Y') }}</small> -
                    <small>{{ $event->location ?? 'TBA' }}</small>
                </a>
            @empty
                <p class="text-muted">No data found.</p>
            @endforelse
        </div>
    </div>

    {{-- Organizational Chart --}}
    <div class="mb-5">
        <h2 class="mb-3">🏛 Barangay Officials</h2>
        <p class="text-muted">Meet the leaders of our community.</p>
        <a href="{{ route('org-chart') }}" class="btn btn-info">View Organizational Chart</a>
    </div>
</div>
