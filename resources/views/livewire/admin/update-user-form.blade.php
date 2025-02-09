<form wire:submit.prevent="update" class="form">
    <div class="form-row row">
        <div class="mb-3 form-group col-md-6 col-sm-6">
            <label for="emp_name">User Full Name </label>
            <input type="text" class="form-control" wire:model='name' name="name">
        </div>
        <div class="mb-3 form-group col-md-6 col-sm-6">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" wire:model="username"
                placeholder="Enter Username" required>
        </div>
        <div class="mb-3 form-group col-md-6 col-sm-12">
            <label for="email">User Email</label>
            <input type="text" class="form-control" id="email" name="email" wire:model.live="email"
                placeholder="Enter Email">
        </div>

        <div class="mb-3 form-group col-md-6 col-sm-6" wire:ignore>
            <label for="password">Assign Roles</label>
            <select wire:model="userroles" name="userroles[]" id="userroles" class="form-control select2" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row row">
        <div class="mb-3 form-group col-md-6 col-sm-12">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" wire:model="password"
                placeholder="Enter Password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 form-group col-md-6 col-sm-12">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                wire:model="password_confirmation" placeholder="Enter Password">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit" class="pl-4 pr-4 mt-4 btn btn-teal">Save Admin</button>
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
