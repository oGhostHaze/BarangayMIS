<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Create New Blotter Report</h2>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form wire:submit.prevent="store">
                <div class="mb-4 row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-status-start bg-primary"></div>
                            <div class="card-header">
                                <h3 class="card-title">Case Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Case Number</label>
                                        <input type="text" class="form-control" wire:model="case_number" readonly>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Incident Date</label>
                                        <input type="date" class="form-control" wire:model="incident_date">
                                        @error('incident_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-start bg-blue"></div>
                            <div class="card-header">
                                <h3 class="card-title">Complainant Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" wire:model="complainant_name" disabled>
                                    @error('complainant_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contact</label>
                                    <input type="text" class="form-control" wire:model="complainant_contact"
                                        disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" wire:model="complainant_address"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-start bg-red"></div>
                            <div class="card-header">
                                <h3 class="card-title">Respondent Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" wire:model="respondent_name">
                                    @error('respondent_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contact</label>
                                    <input type="text" class="form-control" wire:model="respondent_contact">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" wire:model="respondent_address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-status-start bg-green"></div>
                            <div class="card-header">
                                <h3 class="card-title">Incident Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" wire:model="location">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="5" wire:model="incident_details"></textarea>
                                    @error('incident_details')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-start bg-orange"></div>
                            <div class="card-header">
                                <h3 class="card-title">Witnesses</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Witness Names (comma-separated)</label>
                                    <input type="text" class="form-control" wire:model="witnesses"
                                        placeholder="e.g., John Doe, Jane Smith">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-status-start bg-purple"></div>
                            <div class="card-header">
                                <h3 class="card-title">Status & Remarks</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" wire:model="status">
                                        <option value="Pending">Pending</option>
                                        <option value="Resolved">Resolved</option>
                                        <option value="Dismissed">Dismissed</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Remarks</label>
                                    <input type="text" class="form-control" wire:model="remarks">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 row">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="{{ route('auth.blotters.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Back to List
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Submit Blotter Report
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
