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
                        <th>Name</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($officials as $official)
                        <tr>
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
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $official->id }})"
                                    wire:confirm='Are you sure?'>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No Officials Found</td>
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
</div>
