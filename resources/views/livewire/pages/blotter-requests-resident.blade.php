<div class="mt-4 container-fluid card">
    <div class="d-flex card-header justify-content-between">
        <h2>Barangay Blotter Records</h2>
        <a class="btn btn-primary" href="{{ route('auth.blotter.create.res') }}">New
            Record</a>
    </div>
    <div class="card-body">
        @if (session()->has('success'))
            <div class="mt-2 alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table mt-3 table-bordered">
            <thead>
                <tr>
                    <th>Case #</th>
                    <th>Complainant</th>
                    <th>Respondent</th>
                    <th>Incident Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blotters as $blotter)
                    <tr>
                        <td>{{ $blotter->case_number }}</td>
                        <td>{{ $blotter->complainant_name }}</td>
                        <td>{{ $blotter->respondent_name }}</td>
                        <td>{{ $blotter->incident_date->format('F d, Y') }}</td>
                        <td><span
                                class="badge bg-{{ $blotter->status == 'Pending' ? 'warning' : ($blotter->status == 'Resolved' ? 'success' : 'danger') }}">{{ $blotter->status }}</span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" wire:click="edit({{ $blotter->id }})"
                                data-bs-toggle="modal" data-bs-target="#blotterModal">Edit</button>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $blotter->id }})"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $blotters->links() }}

    </div>
    <!-- Blotter Modal -->
    <div class="modal fade" id="blotterModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $updateMode ? 'Edit Blotter Record' : 'New Blotter Record' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                        <input type="hidden" wire:model="blotter_id">

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
                                <input type="text" class="form-control" wire:model="complainant_name" disabled>
                                @error('complainant_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Contact</label>
                                <input type="text" class="form-control" wire:model="complainant_contact" disabled>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label>Address</label>
                                <input type="text" class="form-control" wire:model="complainant_address" disabled>
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
                            <textarea class="form-control" wire:model="incident_details"></textarea>
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
            var modal = bootstrap.Modal.getInstance(document.getElementById('blotterModal'));
            modal.hide();
        });
    </script>
@endscript
