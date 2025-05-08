<div class="container mt-4 card">
    <div class="d-flex card-header justify-content-between">
        <h2>Edit Blotter Record</h2>
        <div>
            <a href="{{ route('blotters.show', $blotter_id) }}" class="btn btn-info">View Details</a>
            <a href="{{ route('blotters.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <form wire:submit.prevent="save" class="card-body">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Case Number</label>
                <input type="text" class="form-control" wire:model="case_number" readonly>
            </div>

            <div class="mb-3 col-md-6">
                <label>Incident Date</label>
                <input type="date" class="form-control" wire:model="incident_date">
                @error('incident_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <h5>Complainant Details</h5>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Name</label>
                <input type="text" class="form-control" wire:model="complainant_name">
                @error('complainant_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label>Contact</label>
                <input type="text" class="form-control" wire:model="complainant_contact">
            </div>
            <div class="mb-3 col-md-12">
                <label>Address</label>
                <input type="text" class="form-control" wire:model="complainant_address">
            </div>
        </div>

        <h5>Respondent Details</h5>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Name</label>
                <input type="text" class="form-control" wire:model="respondent_name">
                @error('respondent_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label>Contact</label>
                <input type="text" class="form-control" wire:model="respondent_contact">
            </div>
            <div class="mb-3 col-md-12">
                <label>Address</label>
                <input type="text" class="form-control" wire:model="respondent_address">
            </div>
        </div>

        <h5>Incident Details</h5>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" class="form-control" wire:model="location">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" wire:model="incident_details" rows="4"></textarea>
            @error('incident_details')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <h5>Witnesses</h5>
        <div class="mb-3">
            <label>Witness Names (comma-separated)</label>
            <input type="text" class="form-control" wire:model="witnesses">
        </div>

        <h5>Status & Remarks</h5>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Status</label>
                <select class="form-control" wire:model="status">
                    <option value="Pending">Pending</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Dismissed">Dismissed</option>
                </select>
            </div>
            <div class="mb-3 col-md-6">
                <label>Remarks</label>
                <input type="text" class="form-control" wire:model="remarks">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('blotters.show', $blotter_id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
