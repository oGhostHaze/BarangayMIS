<form action="{{ route('auth.admin.users.update', $user->id) }}" method="POST">
    @csrf
    <div class="form-row row">
        <div class="form-group mb-3 col-md-6 col-sm-6">
            <label for="userid">User ID</label>
            <input type="text" class="form-control" id="userid" name="userid" wire:model.lazy="userid"
                placeholder="Enter User ID" required>
        </div>
        <div class="form-group mb-3 col-md-6 col-sm-6">
            <label for="name">User Name (Provided from HRIS)</label>
            <input type="text" class="form-control disabled" wire:model.live='name'" name="name" readonly>
        </div>
        <div class="form-group mb-3 col-md-6 col-sm-6">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" wire:model="username"
                placeholder="Enter Username" required>
        </div>
        <div class="form-group mb-3 col-md-6 col-sm-12">
            <label for="email">User Email</label>
            <input type="text" class="form-control" id="email" name="email" wire:model="email"
                placeholder="Enter Email">
        </div>
    </div>

    <div class="form-row row">
        <div class="form-group mb-3 col-md-6 col-sm-12">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" wire:model="password"
                placeholder="Enter Password">
        </div>
        <div class="form-group mb-3 col-md-6 col-sm-12">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                wire:model="password_confirmation" placeholder="Enter Password">
        </div>
    </div>

    <div class="form-row row">
        <div class="form-group mb-3 col-md-6 col-sm-6" wire:ignore>
            <label for="password">Assign Roles</label>
            <select wire:model="userroles" name="roles[]" id="userroles" class="form-control select2" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-teal mt-4 pr-4 pl-4">Save Admin</button>
</form>

@script
    <script>
        $(document).ready(function() {
            // $('.select2').select2({
            //     width: 'resolve',
            // });

            // Initialize Select2
            $('#userroles').select2();

            // Listen for changes and update Livewire
            $('#userroles').on('change', function(e) {
                let userroles = $(this).val();
                @this.set('userroles', userroles); // Bind to Livewire
            });

            // Reinitialize Select2 after every Livewire update
            Livewire.hook('message.processed', (message, component) => {
                $('#userroles').select2();
            });
        });
    </script>
@endscript
