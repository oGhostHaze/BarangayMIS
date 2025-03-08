<div class="container mt-4 card">
    <div class="d-flex card-header justify-content-between">
        <h2>Manage Users</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" wire:click="create">New
            User</button>
    </div>
    <div class="card-body">
        @if (session()->has('success'))
            <div class="mt-2 alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table mt-3 table-bordered">
            <thead>
                <tr>
                    <th>ID #</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" wire:click="edit({{ $user->id }})"
                                data-bs-toggle="modal" data-bs-target="#userModal">Edit</button>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $user->id }})"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}

    </div>
    <!-- user Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $updateMode ? 'Edit user Record' : 'New user Record' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                        <input type="hidden" wire:model="user_id">

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Email Address</label>
                                <input type="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Username</label>
                                <input type="text" class="form-control" wire:model="username">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">{{ $updateMode ? 'Update' : 'Save' }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        window.addEventListener('close-modal', event => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
            modal.hide();
        });
    </script>
@endscript
