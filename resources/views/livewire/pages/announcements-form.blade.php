<div class="container">
    <h2>{{ $announcement_id ? 'Edit Announcement' : 'Create Announcement' }}</h2>

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" wire:model="title" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Excerpt</label>
            <textarea wire:model="excerpt" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea wire:model="content" class="form-control" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" wire:model="category" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" wire:model="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select wire:model="status" class="form-control">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
