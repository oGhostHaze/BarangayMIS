<div class="container mt-4">
    <div class="shadow-sm card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Resident Profile</h3>
            <div class="btn-group">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4 text-center">
                <img src="{{ url('/back/dist/img/authors/male-placeholder.png') }}" alt="Profile Picture"
                    class="border shadow-sm rounded-circle" width="120">
                <h4 class="mt-2">{{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}
                    {{ $resident->suffix }}</h4>
                <p class="text-muted">{{ $resident->civil_status }} | {{ $resident->gender }}</p>

                @if ($resident->user_id)
                    <span class="badge bg-success">Approved</span>
                @else
                    <span class="badge bg-warning">Pending Approval</span>
                @endif
            </div>

            <hr>

            <!-- Personal Information -->
            <div class="mb-3 card">
                <div class="card-header">
                    <h5 class="mb-0 card-title"><i class="ti ti-user text-primary"></i> Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6"><strong>Full Name:</strong> {{ $resident->prefix }}
                            {{ $resident->first_name }}
                            {{ $resident->middle_name }} {{ $resident->last_name }} {{ $resident->suffix }}</div>
                        <div class="col-sm-6"><strong>Date of Birth:</strong> {{ $resident->date_of_birth }}</div>
                        <div class="col-sm-6"><strong>Age:</strong> {{ $resident->age() }} years</div>
                        <div class="col-sm-6"><strong>Gender:</strong> {{ $resident->gender }}</div>
                        <div class="col-sm-6"><strong>Civil Status:</strong> {{ $resident->civil_status }}</div>
                        <div class="col-sm-6"><strong>RFID Number:</strong> {{ $resident->rfid_number ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- ID Verification -->
            <div class="mb-3 card">
                <div class="card-header">
                    <h5 class="mb-0 card-title"><i class="ti ti-id text-primary"></i> ID Verification</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6"><strong>ID Type:</strong> {{ $resident->valid_id_type ?? 'N/A' }}</div>
                        <div class="col-sm-12">
                            <strong>Valid ID:</strong>
                            @if ($resident->valid_id_path)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($resident->valid_id_path) }}" alt="Valid ID"
                                        class="border rounded shadow-sm img-fluid" style="max-height: 300px;">
                                </div>
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-3 card">
                <div class="card-header">
                    <h5 class="mb-0 card-title"><i class="ti ti-phone text-primary"></i> Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6"><strong>Contact No.:</strong> {{ $resident->contact_no ?? 'N/A' }}</div>
                        <div class="col-sm-6"><strong>Email Address:</strong> {{ $resident->email ?? 'N/A' }}</div>
                        <div class="col-sm-6"><strong>Address (Sitio):</strong> {{ $resident->sitio ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Health & Identification -->
            <div class="mb-3 card">
                <div class="card-header">
                    <h5 class="mb-0 card-title"><i class="ti ti-medical-cross text-primary"></i> Identification & Health
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6"><strong>PhilHealth ID:</strong> {{ $resident->philhealth_id ?? 'N/A' }}
                        </div>
                        <div class="col-sm-6"><strong>SSS ID:</strong> {{ $resident->sss_id ?? 'N/A' }}</div>
                        <div class="col-sm-6"><strong>GSIS ID:</strong> {{ $resident->gsis_id ?? 'N/A' }}</div>
                        <div class="col-sm-6"><strong>Social Pension ID:</strong>
                            {{ $resident->social_pension_id ?? 'N/A' }}
                        </div>
                        <div class="col-sm-6">
                            <strong>Senior Citizen:</strong>
                            @if ($resident->is_senior_citizen)
                                <span class="badge bg-orange">Yes</span>
                            @else
                                <span class="text-muted">No</span>
                            @endif
                        </div>
                        @if ($resident->is_senior_citizen)
                            <div class="col-sm-6"><strong>Senior Citizen ID:</strong>
                                {{ $resident->senior_citizen_id ?? 'N/A' }}</div>
                        @endif
                        <div class="col-sm-6">
                            <strong>Person with Disability (PWD):</strong>
                            @if ($resident->is_pwd)
                                <span class="badge bg-purple">Yes</span>
                            @else
                                <span class="text-muted">No</span>
                            @endif
                        </div>
                        @if ($resident->is_pwd)
                            <div class="col-sm-6"><strong>PWD ID:</strong> {{ $resident->pwd_id ?? 'N/A' }}</div>
                            <div class="col-sm-6"><strong>Type of Disability:</strong>
                                {{ $resident->type_of_disability ?? 'N/A' }}</div>
                        @endif
                        <div class="col-sm-6"><strong>Illness:</strong> {{ $resident->illness ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Solo Parent Information -->
            <div class="mb-3 card">
                <div class="card-header">
                    <h5 class="mb-0 card-title"><i class="ti ti-users text-primary"></i> Family Status</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <strong>Solo Parent:</strong>
                            @if ($resident->is_solo_parent)
                                <span class="badge bg-pink">Yes</span>
                            @else
                                <span class="text-muted">No</span>
                            @endif
                        </div>
                        @if ($resident->is_solo_parent)
                            <div class="col-sm-6"><strong>Solo Parent ID:</strong>
                                {{ $resident->solo_parent_id ?? 'N/A' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Employment & Income -->
            <div class="mb-3 card">
                <div class="card-header">
                    <h5 class="mb-0 card-title"><i class="ti ti-briefcase text-primary"></i> Employment & Income</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6"><strong>Educational Attainment:</strong>
                            {{ $resident->educational_attainment ?? 'N/A' }}</div>
                        <div class="col-sm-6"><strong>Source of Income:</strong>
                            {{ $resident->source_of_income ?? 'N/A' }}
                        </div>
                        <div class="col-sm-6"><strong>Monthly Income:</strong>
                            ₱{{ number_format($resident->monthly_income ?? 0, 2) }}</div>
                        <div class="col-sm-6">
                            <strong>Income Type:</strong>
                            @if ($resident->income_type)
                                <span
                                    class="badge bg-{{ $resident->income_type == 'Regular' ? 'green' : 'yellow' }}-lt">
                                    {{ $resident->income_type }}
                                </span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <strong>OFW:</strong>
                            @if ($resident->is_ofw)
                                <span class="badge bg-blue-lt">Yes</span>
                            @else
                                <span class="text-muted">No</span>
                            @endif
                        </div>
                        @if ($resident->is_ofw)
                            <div class="col-sm-6"><strong>OFW Country:</strong> {{ $resident->ofw_country ?? 'N/A' }}
                            </div>
                            <div class="col-sm-6">
                                <strong>Domestic Helper:</strong>
                                @if ($resident->ofw_is_domestic_helper)
                                    <span class="badge bg-azure-lt">Yes</span>
                                @else
                                    <span class="text-muted">No</span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <strong>Professional:</strong>
                                @if ($resident->ofw_professional)
                                    <span class="badge bg-indigo-lt">Yes</span>
                                @else
                                    <span class="text-muted">No</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="mb-3 card">
                <div class="card-header">
                    <h5 class="mb-0 card-title"><i class="ti ti-user-shield text-primary"></i> Account Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <strong>User Account:</strong>
                            @if ($resident->user)
                                <span class="badge bg-success">Linked to {{ $resident->user->email }}</span>
                            @else
                                <span class="badge bg-warning">No User Account</span>
                                <p class="mt-2 text-muted small">This resident record is pending approval. Click the
                                    "Approve Resident" button to create a user account for this resident.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if (!$resident->user_id)
                <button class="btn btn-success" wire:click="confirmApproval">
                    <i class="ti ti-check"></i> Approve Resident
                </button>
            @endif
        </div>
    </div>

    {{-- Approve Resident Modal --}}
    <div wire:ignore.self class="modal fade" id="approveResidentModal" tabindex="-1"
        aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="text-white modal-header bg-success">
                    <h5 class="modal-title" id="approveModalLabel">Confirm Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center modal-body">
                    <i class="ti ti-check-circle text-success" style="font-size: 3rem;"></i>
                    <p class="mt-3">Are you sure you want to approve this resident record?</p>
                    <p class="text-muted small">This will create a user account for the resident if they have provided
                        an email address.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" wire:click="approveResident">
                        <i class="ti ti-check me-1"></i> Approve
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Approve Resident Modal --}}
</div>

@script
    <script>
        // Initialize modals and set up event listeners
        document.addEventListener('livewire:initialized', () => {
            // Show approve confirmation modal
            Livewire.on('show-approve-modal', () => {
                const approveModal = new bootstrap.Modal(document.getElementById('approveResidentModal'));
                approveModal.show();
            });

            // Close approve confirmation modal
            Livewire.on('close-approve-modal', () => {
                const approveModal = bootstrap.Modal.getInstance(document.getElementById(
                    'approveResidentModal'));
                if (approveModal) {
                    approveModal.hide();
                }
            });
        });
    </script>
@endscript
