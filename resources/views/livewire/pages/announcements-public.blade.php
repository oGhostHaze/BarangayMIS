<div class="container">
    <h2 class="mb-4">Latest Announcements</h2>
    <div class="row">
        @foreach ($announcements as $post)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="{{ route('auth.announcements.show', $post->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                    <div class="card-footer text-muted">
                        Published on {{  \Carbon\Carbon::parse($post->published_at)->format('F d, Y')}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
