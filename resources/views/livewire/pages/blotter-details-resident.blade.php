<div class="container mt-4 card">
    <div class="d-flex card-header justify-content-between">
        <h2>Blotter Record Details</h2>
        <div>
            <a href="{{ route('resident.blotters.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('resident.blotters.edit', $blotter->id) }}" class="btn btn-primary">Edit</a>
            <button class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this record?') ? window.location.href='{{ route('resident.blotters.delete', $blotter->id) }}' : false">Delete</button>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-4 row">
            <div class="col-md-6">
                <div class="card border-primary h-100">
                    <div class="text-white card-header bg-primary">
                        <h5 class="mb-0">Case Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Case Number:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->case_number }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Incident Date:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->incident_date->format('F d, Y') }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Location:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->location ?: 'Not specified' }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Status:</label>
                            <div class="col-sm-8">
                                <span
                                    class="badge bg-{{ $blotter->status == 'Pending' ? 'warning' : ($blotter->status == 'Resolved' ? 'success' : 'danger') }}">
                                    {{ $blotter->status }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Filed On:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-primary h-100">
                    <div class="text-white card-header bg-primary">
                        <h5 class="mb-0">Parties Involved</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Complainant</h6>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Name:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->complainant_name }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Address:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->complainant_address ?: 'Not specified' }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Contact:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->complainant_contact ?: 'Not specified' }}
                                </p>
                            </div>
                        </div>

                        <h6 class="mt-4 text-primary">Respondent</h6>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Name:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->respondent_name }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Address:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->respondent_address ?: 'Not specified' }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">Contact:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">{{ $blotter->respondent_contact ?: 'Not specified' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 row">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="text-white card-header bg-primary">
                        <h5 class="mb-0">Incident Details</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $blotter->incident_details }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card border-primary h-100">
                    <div class="text-white card-header bg-primary">
                        <h5 class="mb-0">Witnesses</h5>
                    </div>
                    <div class="card-body">
                        @if ($blotter->witnesses)
                            <ul>
                                @foreach (explode(',', $blotter->witnesses) as $witness)
                                    <li>{{ trim($witness) }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No witnesses recorded</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-primary h-100">
                    <div class="text-white card-header bg-primary">
                        <h5 class="mb-0">Remarks</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $blotter->remarks ?: 'No remarks' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Update Section for Residents -->
        <div class="mt-4 row">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="text-white card-header bg-primary">
                        <h5 class="mb-0">Case Status</h5>
                    </div>
                    <div class="card-body">
                        <p class="fw-bold">Current Status:
                            <span
                                class="badge bg-{{ $blotter->status == 'Pending' ? 'warning' : ($blotter->status == 'Resolved' ? 'success' : 'danger') }}">
                                {{ $blotter->status }}
                            </span>
                        </p>

                        @if ($blotter->status == 'Pending')
                            <div class="alert alert-info">
                                <p>Your blotter case is currently being processed by the barangay officials. Please
                                    check back later for updates or contact the barangay office for more information.
                                </p>
                            </div>
                        @elseif($blotter->status == 'Resolved')
                            <div class="alert alert-success">
                                <p>Your blotter case has been resolved. If you have any questions, please contact the
                                    barangay office.</p>
                            </div>
                        @elseif($blotter->status == 'Dismissed')
                            <div class="alert alert-danger">
                                <p>Your blotter case has been dismissed. For more information about this decision,
                                    please contact the barangay office.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
