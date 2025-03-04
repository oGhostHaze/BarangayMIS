<div class="container mt-4">
    <div class="shadow card">
        <div class="card-header d-flex justify-content-between">
            <h4>Certificates</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestModal">New Request</button>
        </div>

        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Resident</th>
                        <th>Certificate Type</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Requested At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->resident->first_name }} {{ $request->resident->last_name }}</td>
                            <td>{{ $request->certificate_type }}</td>
                            <td>{{ $request->purpose }}</td>
                            <td>
                                <span
                                    class="badge text-white bg-{{ $request->status == 'Released' ? 'success' : ($request->status == 'Approved' ? 'warning' : 'secondary') }}">
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td>{{ $request->requested_at->format('M d, Y') }}</td>
                            <td>
                                @if ($request->status == 'Pending')
                                    <button class="btn btn-sm btn-primary" wire:click="editRequest({{ $request->id }})"
                                        data-bs-toggle="modal" data-bs-target="#requestModal">Edit</button>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="deleteRequest({{ $request->id }})"
                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">Delete</button>
                                @elseif ($request->status == 'Approved')
                                    <button class="btn btn-sm btn-success"
                                        wire:click="processRequest({{ $request->id }}, 'Released')">Release</button>
                                @else
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('auth.certs.temp1', ['request_id' => $request->id]) }}"
                                        target="_blank"
                                        onclick="window.open(this.href,'newwindow','width=1000,height=800'); return false;">Preview</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Request Modal -->
    <div wire:ignore.self class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $request_id ? 'Edit' : 'New' }} Certificate Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveRequest">
                        <div class="mb-3">
                            <label class="form-label">Certificate Type</label>
                            <select class="form-control" wire:model="certificate_type">
                                <option value="">Select Type</option>
                                <option value="Barangay Clearance">Barangay Clearance</option>
                                <option value="Certificate of Indigency">Certificate of Indigency</option>
                                <option value="Certificate of Low Income">Certificate of Low Income</option>
                                <option value="Certificate of Residency">Certificate of Residency</option>
                            </select>
                            @error('certificate_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Purpose</label>
                            <textarea class="form-control" wire:model="purpose"></textarea>
                            @error('purpose')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="submit"
                                class="btn btn-primary">{{ $request_id ? 'Update' : 'Submit' }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
