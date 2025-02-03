<div class="container mt-5">
    <div class="card shadow">
        @if ($announcement->image)
            <img src="{{ asset('storage/' . $announcement->image) }}" class="card-img-top" alt="{{ $announcement->title }}">
        @endif
        <div class="card-body">
            <h2 class="card-title">{{ $announcement->title }}</h2>
            <p class="text-muted">
                <strong>Category:</strong> {{ $announcement->category ?? 'Uncategorized' }} |
                <strong>Published:</strong> {{ $announcement->published_at ?  \Carbon\Carbon::parse($announcement->published_at)->format('F d, Y') : 'Draft' }}
            </p>
            <hr>
            <div class="content">
                {!! $announcement->content !!}
            </div>
        </div>
    </div>

    <button onclick="history.back()" class="btn btn-primary mt-3">Back to Announcements</button>
</div>
