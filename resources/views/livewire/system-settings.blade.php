<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h4>System Settings</h4>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label class="form-label">Barangay Name</label>
                    <input type="text" class="form-control" wire:model="barangay_name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Municipal Name</label>
                    <input type="text" class="form-control" wire:model="municipal_name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Province Name</label>
                    <input type="text" class="form-control" wire:model="province_name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Provincial Logo</label>
                    @if ($existingProvincialLogo)
                        <img src="{{ asset('storage/' . $existingProvincialLogo) }}" class="img-thumbnail mb-2" width="100">
                    @endif
                    <input type="file" class="form-control" wire:model="provincial_logo">
                </div>

                <div class="mb-3">
                    <label class="form-label">Barangay Logo</label>
                    @if ($existingBarangayLogo)
                        <img src="{{ asset('storage/' . $existingBarangayLogo) }}" class="img-thumbnail mb-2" width="100">
                    @endif
                    <input type="file" class="form-control" wire:model="barangay_logo">
                </div>

                <div class="mb-3">
                    <label class="form-label">Additional Logo</label>
                    @if ($existingAdditionalLogo)
                        <img src="{{ asset('storage/' . $existingAdditionalLogo) }}" class="img-thumbnail mb-2" width="100">
                    @endif
                    <input type="file" class="form-control" wire:model="additional_logo">
                </div>

                <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
        </div>
    </div>
</div>
