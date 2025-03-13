<div class="container-fluid">
    <div class="row">
        <!-- Resident Profile Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <span class="mb-3 avatar avatar-xl">
                            {{ substr($resident->first_name, 0, 1) . substr($resident->last_name, 0, 1) }}
                        </span>
                        <h2>{{ $resident->full_name }}</h2>
                        <div class="text-muted">RFID: {{ $resident->rfid_number }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Age</div>
                                <div class="datagrid-content">{{ $resident->age() }} years</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Gender</div>
                                <div class="datagrid-content">{{ $resident->gender }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Address</div>
                                <div class="datagrid-content">{{ $resident->sitio }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Contact</div>
                                <div class="datagrid-content">{{ $resident->contact_no }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Civil Status</div>
                                <div class="datagrid-content">{{ $resident->civil_status }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Email</div>
                                <div class="datagrid-content">{{ $resident->email ?: 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('auth.residents.update', $resident->id) }}" class="btn btn-primary">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- IDs Card -->
            <div class="mt-3 card">
                <div class="card-header">
                    <h3 class="card-title">Identification Numbers</h3>
                </div>
                <div class="card-body">
                    <div class="datagrid">
                        @if ($resident->philhealth_id)
                            <div class="datagrid-item">
                                <div class="datagrid-title">PhilHealth ID</div>
                                <div class="datagrid-content">{{ $resident->philhealth_id }}</div>
                            </div>
                        @endif

                        @if ($resident->sss_id)
                            <div class="datagrid-item">
                                <div class="datagrid-title">SSS ID</div>
                                <div class="datagrid-content">{{ $resident->sss_id }}</div>
                            </div>
                        @endif

                        @if ($resident->gsis_id)
                            <div class="datagrid-item">
                                <div class="datagrid-title">GSIS ID</div>
                                <div class="datagrid-content">{{ $resident->gsis_id }}</div>
                            </div>
                        @endif

                        @if ($resident->pwd_id)
                            <div class="datagrid-item">
                                <div class="datagrid-title">PWD ID</div>
                                <div class="datagrid-content">{{ $resident->pwd_id }}</div>
                            </div>
                        @endif

                        @if ($resident->senior_citizen_id)
                            <div class="datagrid-item">
                                <div class="datagrid-title">Senior Citizen ID</div>
                                <div class="datagrid-content">{{ $resident->senior_citizen_id }}</div>
                            </div>
                        @endif

                        @if ($resident->solo_parent_id)
                            <div class="datagrid-item">
                                <div class="datagrid-title">Solo Parent ID</div>
                                <div class="datagrid-content">{{ $resident->solo_parent_id }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Content -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link {{ $activeTab == 'profile' ? 'active' : '' }}"
                                wire:click.prevent="setActiveTab('profile')" data-bs-toggle="tab">
                                Profile Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#certificates" class="nav-link {{ $activeTab == 'certificates' ? 'active' : '' }}"
                                wire:click.prevent="setActiveTab('certificates')" data-bs-toggle="tab">
                                Certificates
                                <span class="badge bg-primary ms-1">{{ count($certificateRequests) }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#blotter" class="nav-link {{ $activeTab == 'blotter' ? 'active' : '' }}"
                                wire:click.prevent="setActiveTab('blotter')" data-bs-toggle="tab">
                                Blotter Records
                                <span class="badge bg-primary ms-1">{{ count($blotterCases) }}</span>
                            </a>
                        </li>
                        @if ($resident->medications->count() > 0)
                            <li class="nav-item">
                                <a href="#medications"
                                    class="nav-link {{ $activeTab == 'medications' ? 'active' : '' }}"
                                    wire:click.prevent="setActiveTab('medications')" data-bs-toggle="tab">
                                    Medications
                                    <span class="badge bg-primary ms-1">{{ $resident->medications->count() }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Profile Tab -->
                        <div class="tab-pane {{ $activeTab == 'profile' ? 'active show' : '' }}" id="profile">
                            <h3>Additional Information</h3>
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Educational Attainment</div>
                                    <div class="datagrid-content">{{ $resident->educational_attainment ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Source of Income</div>
                                    <div class="datagrid-content">{{ $resident->source_of_income ?? 'N/A' }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Monthly Income</div>
                                    <div class="datagrid-content">
                                        ₱{{ number_format($resident->monthly_income ?? 0, 2) }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Income Type</div>
                                    <div class="datagrid-content">{{ $resident->income_type ?? 'N/A' }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">OFW</div>
                                    <div class="datagrid-content">{{ $resident->is_ofw ? 'Yes' : 'No' }}</div>
                                </div>
                                @if ($resident->is_ofw)
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">OFW Country</div>
                                        <div class="datagrid-content">{{ $resident->ofw_country }}</div>
                                    </div>
                                @endif
                            </div>

                            <h3 class="mt-4">Status</h3>
                            <div class="row">
                                @if ($resident->is_pwd)
                                    <div class="col-md-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar bg-blue-lt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M8 16v-4l-4 -4" />
                                                            <path d="M16 16v-4l4 -4" />
                                                            <circle cx="12" cy="6" r="2" />
                                                            <path d="M19 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                            <path d="M5 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                        </svg>
                                                    </span>
                                                    <div class="ms-3">
                                                        <div class="font-weight-medium">PWD</div>
                                                        <div class="text-muted">
                                                            {{ $resident->type_of_disability ?? 'Not specified' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($resident->is_senior_citizen)
                                    <div class="col-md-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar bg-yellow-lt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M8 9l5 -5v7l4 -4" />
                                                            <path d="M13 21v-7.5" />
                                                            <path d="M9 4l-4 4l4 4" />
                                                            <path d="M17 4v6" />
                                                            <path d="M12 17v.01" />
                                                        </svg>
                                                    </span>
                                                    <div class="ms-3">
                                                        <div class="font-weight-medium">Senior Citizen</div>
                                                        <div class="text-muted">{{ $resident->age() }} years old</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($resident->is_solo_parent)
                                    <div class="col-md-3">
                                        <div class="card card-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar bg-pink-lt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M7 5a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2z" />
                                                            <path
                                                                d="M15.5 15a3.5 3.5 0 0 1 -3.5 -3.5a3.5 3.5 0 0 1 3.5 -3.5h2.5v7h-2.5z" />
                                                        </svg>
                                                    </span>
                                                    <div class="ms-3">
                                                        <div class="font-weight-medium">Solo Parent</div>
                                                        <div class="text-muted">ID: {{ $resident->solo_parent_id }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Certificates Tab -->
                        <div class="tab-pane {{ $activeTab == 'certificates' ? 'active show' : '' }}"
                            id="certificates">
                            <h3>Certificate Requests</h3>
                            @if (count($certificateRequests) > 0)
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th>Requested At</th>
                                                <th>Payment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($certificateRequests as $cert)
                                                <tr>
                                                    <td>{{ $cert->certificate_type }}</td>
                                                    <td>{{ $cert->purpose }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $cert->status == 'pending'
                                                                ? 'yellow'
                                                                : ($cert->status == 'approved'
                                                                    ? 'green'
                                                                    : ($cert->status == 'rejected'
                                                                        ? 'red'
                                                                        : 'blue')) }}">
                                                            {{ ucfirst($cert->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $cert->requested_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $cert->payment_status == 'unpaid'
                                                                ? 'red'
                                                                : ($cert->payment_status == 'pending_verification'
                                                                    ? 'yellow'
                                                                    : ($cert->payment_status == 'paid'
                                                                        ? 'green'
                                                                        : 'blue')) }}">
                                                            {{ str_replace('_', ' ', ucfirst($cert->payment_status)) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('auth.certs.temp1', $cert->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="empty">
                                    <div class="empty-img">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-certificate" width="40"
                                            height="40" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                            <path d="M9 11l-4 4"></path>
                                            <path d="M9 7l-4 0"></path>
                                            <path d="M9 15l-4 0"></path>
                                            <path d="M9 19l-4 0"></path>
                                        </svg>
                                    </div>
                                    <p class="empty-title">No certificate requests found</p>
                                    <p class="empty-subtitle text-muted">
                                        This resident has not requested any certificates yet.
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Blotter Tab -->
                        <div class="tab-pane {{ $activeTab == 'blotter' ? 'active show' : '' }}" id="blotter">
                            <h3>Blotter Records</h3>
                            @if (count($blotterCases) > 0)
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Case #</th>
                                                <th>Complainant</th>
                                                <th>Respondent</th>
                                                <th>Incident Date</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blotterCases as $case)
                                                <tr>
                                                    <td>{{ $case->case_number }}</td>
                                                    <td>{{ $case->complainant_name }}</td>
                                                    <td>{{ $case->respondent_name }}</td>
                                                    <td>{{ $case->incident_date->format('M d, Y') }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $case->status == 'pending'
                                                                ? 'yellow'
                                                                : ($case->status == 'resolved'
                                                                    ? 'green'
                                                                    : ($case->status == 'ongoing'
                                                                        ? 'blue'
                                                                        : 'red')) }}">
                                                            {{ ucfirst($case->status) }}
                                                        </span>
                                                    </td>
                                                    {{-- <td>
                                                        <a href="{{ route('admin.blotter.show', $case->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            View
                                                        </a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="empty">
                                    <div class="empty-img">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-report" width="40"
                                            height="40" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M17 17m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                            <path d="M17 13v4h4"></path>
                                            <path d="M12 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="empty-title">No blotter records found</p>
                                    <p class="empty-subtitle text-muted">
                                        This resident has no blotter records.
                                    </p>
                                    <div class="empty-action">
                                        <a href="{{ route('auth.blotters.create') }}" class="btn btn-primary">
                                            Create New Blotter
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Medications Tab (if applicable) -->
                        @if ($resident->medications->count() > 0)
                            <div class="tab-pane {{ $activeTab == 'medications' ? 'active show' : '' }}"
                                id="medications">
                                <h3>Medications</h3>
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Medication</th>
                                                <th>Dosage</th>
                                                <th>Frequency</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($resident->medications as $medication)
                                                <tr>
                                                    <td>{{ $medication->name }}</td>
                                                    <td>{{ $medication->dosage }}</td>
                                                    <td>{{ $medication->frequency }}</td>
                                                    <td>{{ $medication->start_date ? $medication->start_date->format('M d, Y') : 'N/A' }}
                                                    </td>
                                                    <td>{{ $medication->end_date ? $medication->end_date->format('M d, Y') : 'Ongoing' }}
                                                    </td>
                                                    <td>{{ $medication->notes ?? 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
