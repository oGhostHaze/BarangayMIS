<div class="mt-4 container-fluid">
    <div class="shadow card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Barangay Officials</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#officialModal" wire:click="create">
                Add Official
            </button>
        </div>

        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($officials as $official)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $official->photo ? Storage::url($official->photo) : asset('images/default-avatar.png') }}"
                                    alt="{{ $official->first_name }}" class="rounded-circle" width="50"
                                    height="50">
                            </td>
                            <td>{{ $official->last_name }}, {{ $official->first_name }} {{ $official->middle_name }}
                            </td>
                            <td>{{ $official->position }}</td>
                            <td>
                                <span
                                    class="badge text-white bg-{{ $official->status == 'A' ? 'success' : 'secondary' }}">
                                    {{ $official->status == 'A' ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#officialModal" wire:click="edit({{ $official->id }})">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" wire:click="confirmDelete({{ $official->id }})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Officials Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $officials->links() }}
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div wire:ignore.self class="modal fade" id="officialModal" tabindex="-1" aria-labelledby="officialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="officialModalLabel">{{ $modalTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-control" wire:model="photo" accept="image/*">
                            <div wire:loading wire:target="photo" class="mt-1 text-primary">Uploading...</div>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @if ($photo)
                                <div class="mt-2">
                                    <p>Photo Preview:</p>
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="rounded-circle"
                                        width="100" height="100">
                                </div>
                            @elseif ($current_photo)
                                <div class="mt-2">
                                    <p>Current Photo:</p>
                                    <img src="{{ Storage::url($current_photo) }}" alt="Current" class="rounded-circle"
                                        width="100" height="100">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" wire:model.defer="first_name">
                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" wire:model.defer="last_name">
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" wire:model.defer="middle_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Position</label>
                            <select class="form-select" wire:model.defer="position">
                                <option value="">Select Position</option>
                                @foreach ($positions as $pos)
                                    <option value="{{ $pos }}">{{ $pos }}</option>
                                @endforeach
                            </select>
                            @error('position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" wire:model.defer="status">
                                <option value="A">Active</option>
                                <option value="I">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="text-white modal-header bg-danger">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center modal-body">
                    <i class="fas fa-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                    <p class="mt-3">Are you sure you want to delete this official?</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteConfirmed">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


@script
    <script>
        // Initialize modals and set up event listeners
        document.addEventListener('livewire:initialized', () => {
            // Show delete confirmation modal
            Livewire.on('show-delete-modal', () => {
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                deleteModal.show();
            });

            // Close delete confirmation modal
            Livewire.on('close-delete-modal', () => {
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById(
                    'deleteConfirmationModal'));
                if (deleteModal) {
                    deleteModal.hide();
                }
            });

            // Close the add/edit modal
            Livewire.on('close-modal', () => {
                const officialModal = bootstrap.Modal.getInstance(document.getElementById('officialModal'));
                if (officialModal) {
                    officialModal.hide();
                }
            });
        });
    </script>
@endscript
