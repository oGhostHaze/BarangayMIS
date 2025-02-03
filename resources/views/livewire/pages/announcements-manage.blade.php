<div class="container">
    <h2 class="mb-4">Manage Announcements</h2>
    <a href="{{ route('auth.announcements.create') }}" class="btn btn-success mb-3">Add New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Published At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ ucfirst($post->status) }}</td>
                    <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('F d, Y') : '—' }}</td>
                    <td>
                        <a href="{{ route('auth.announcements.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $post->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $announcements->links() }}
</div>
