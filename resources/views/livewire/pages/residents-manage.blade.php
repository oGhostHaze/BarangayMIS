<div class="mt-5 container-fluid">
    <div class="mt-4 card">
        <div class="card-header d-flex justify-content-between">
            <h2 class="card-title">Residents List</h2>
            @role('barangay_official')
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addResidentModal">Add Resident</button>
            @endrole
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Basic Information</th>
                        <th class="text-center">Contact Details</th>
                        <th class="text-center">Identification Numbers</th>
                        <th class="text-center">Special Categories</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($residents as $resident)
                        <tr>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">{{ $resident->prefix }} {{ $resident->first_name }}
                                        {{ $resident->middle_name }} {{ $resident->last_name }}
                                        {{ $resident->suffix }}</span>
                                    <span><span class="text-muted">Age:</span>
                                        {{ \Carbon\Carbon::parse($resident->date_of_birth)->age }} <span
                                            class="text-muted">({{ $resident->date_of_birth }})</span></span>
                                    <span><span class="text-muted">Gender:</span> {{ $resident->gender }}</span>
                                    <span><span class="text-muted">Civil Status:</span>
                                        {{ $resident->civil_status }}</span>
                                    <span><span class="text-muted">Education:</span>
                                        {{ $resident->educational_attainment ?: 'Not specified' }}</span>
                                    <span><span class="text-muted">Sitio:</span>
                                        {{ $resident->sitio ?: 'Not specified' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span><span class="text-muted">Email:</span>
                                        {{ $resident->email ?: 'Not provided' }}</span>
                                    <span><span class="text-muted">Contact:</span>
                                        {{ $resident->contact_no ?: 'Not provided' }}</span>

                                    @if ($resident->is_ofw)
                                        <div class="mt-2">
                                            <span class="badge bg-blue-lt">OFW</span>
                                            <span class="text-muted">Country:</span> {{ $resident->ofw_country }}
                                            @if ($resident->ofw_is_domestic_helper)
                                                <span class="badge bg-azure-lt">Domestic Helper</span>
                                            @endif
                                            @if ($resident->ofw_professional)
                                                <span class="badge bg-indigo-lt">Professional</span>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($resident->source_of_income || $resident->monthly_income || $resident->income_type)
                                        <div class="mt-2">
                                            <span class="text-muted">Income:</span>
                                            @if ($resident->source_of_income)
                                                {{ $resident->source_of_income }}
                                            @endif
                                            @if ($resident->monthly_income)
                                                ₱{{ number_format($resident->monthly_income, 2) }}
                                            @endif
                                            @if ($resident->income_type)
                                                <span
                                                    class="badge bg-{{ $resident->income_type == 'Regular' ? 'green' : 'yellow' }}-lt">
                                                    {{ $resident->income_type }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if ($resident->rfid_number)
                                        <span><span class="text-muted">RFID:</span> {{ $resident->rfid_number }}</span>
                                    @endif
                                    @if ($resident->philhealth_id)
                                        <span><span class="text-muted">PhilHealth:</span>
                                            {{ $resident->philhealth_id }}</span>
                                    @endif
                                    @if ($resident->sss_id)
                                        <span><span class="text-muted">SSS:</span> {{ $resident->sss_id }}</span>
                                    @endif
                                    @if ($resident->gsis_id)
                                        <span><span class="text-muted">GSIS:</span> {{ $resident->gsis_id }}</span>
                                    @endif
                                    @if ($resident->social_pension_id)
                                        <span><span class="text-muted">Social Pension:</span>
                                            {{ $resident->social_pension_id }}</span>
                                    @endif
                                    @if ($resident->valid_id_type)
                                        <span><span class="text-muted">{{ $resident->valid_id_type }}:</span>
                                            @if ($resident->valid_id_path)
                                                <a href="{{ Storage::url($resident->valid_id_path) }}" target="_blank"
                                                    class="text-blue">View ID</a>
                                            @else
                                                Available
                                            @endif
                                        </span>
                                    @endif
                                    @if (
                                        !$resident->rfid_number &&
                                            !$resident->philhealth_id &&
                                            !$resident->sss_id &&
                                            !$resident->gsis_id &&
                                            !$resident->social_pension_id &&
                                            !$resident->valid_id_type)
                                        <span class="text-muted">No IDs provided</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if ($resident->is_pwd)
                                        <div class="mb-1">
                                            <span class="badge bg-purple">PWD</span>
                                            @if ($resident->pwd_id)
                                                <span class="text-muted">ID:</span> {{ $resident->pwd_id }}
                                            @endif
                                            @if ($resident->type_of_disability)
                                                <br><span class="text-muted">Type:</span>
                                                {{ $resident->type_of_disability }}
                                            @endif
                                        </div>
                                    @endif

                                    @if ($resident->is_solo_parent)
                                        <div class="mb-1">
                                            <span class="badge bg-pink">Solo Parent</span>
                                            @if ($resident->solo_parent_id)
                                                <span class="text-muted">ID:</span> {{ $resident->solo_parent_id }}
                                            @endif
                                        </div>
                                    @endif

                                    @if ($resident->is_senior_citizen)
                                        <div class="mb-1">
                                            <span class="badge bg-orange">Senior Citizen</span>
                                            @if ($resident->senior_citizen_id)
                                                <span class="text-muted">ID:</span> {{ $resident->senior_citizen_id }}
                                            @endif
                                        </div>
                                    @endif

                                    @if ($resident->illness)
                                        <div>
                                            <span class="badge bg-red-lt">Medical</span>
                                            <span class="text-muted">Illness:</span> {{ $resident->illness }}
                                        </div>
                                    @endif

                                    @if (!$resident->is_pwd && !$resident->is_solo_parent && !$resident->is_senior_citizen && !$resident->illness)
                                        <span class="text-muted">No special categories</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="gap-1 d-flex flex-column">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('auth.residents.show', $resident->id) }}">
                                        <i class="ti ti-eye"></i> View
                                    </a>
                                    <a class="btn btn-secondary btn-sm"
                                        href="{{ route('admin.residents.assign-rfid', $resident->id) }}">
                                        <i class="ti ti-id"></i> Assign RFID
                                    </a>
                                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $resident->id }})"
                                        data-bs-toggle="modal" data-bs-target="#addResidentModal">
                                        <i class="ti ti-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click="confirmDelete({{ $resident->id }})">
                                        <i class="ti ti-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center">
                                <div class="empty">
                                    <div class="empty-img"><img
                                            src="{{ asset('static/illustrations/undraw_printing_invoices_5r4r.svg') }}"
                                            height="128" alt=""></div>
                                    <p class="empty-title">No residents found</p>
                                    <p class="empty-subtitle text-muted">
                                        There are no approved resident records in the system.
                                    </p>
                                    <div class="empty-action">
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addResidentModal">
                                            <i class="ti ti-plus"></i> Add Resident
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Resident Modal --}}
    <div class="modal" id="addResidentModal" tabindex="-1" wire:ignore.self>
        <form class="modal-dialog modal-xl" role="document"
            wire:submit.prevent="{{ $resident_id ? 'update' : 'store' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add New Resident</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" wire:model="resident_id" hidden>
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                wire:model="first_name" placeholder="First Name">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                                wire:model="middle_name" placeholder="Middle Name">
                            @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                wire:model="last_name" placeholder="Last Name">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-1">
                            <label for="suffix">Suffix</label>
                            <input type="text" class="form-control @error('suffix') is-invalid @enderror"
                                wire:model="suffix" placeholder="Suffix">
                            @error('suffix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-1">
                            <label for="prefix">Prefix</label>
                            <input type="text" class="form-control @error('prefix') is-invalid @enderror"
                                wire:model="prefix" placeholder="Prefix">
                            @error('prefix')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                wire:model="date_of_birth">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="gender">Gender <span class="text-danger">*</span></label>
                            <select class="form-select @error('gender') is-invalid @enderror" wire:model="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="civil_status">Civil Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('civil_status') is-invalid @enderror"
                                wire:model="civil_status">
                                <option value="">Select Civil Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                            </select>
                            @error('civil_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="educational_attainment">Educational Attainment</label>
                            <select class="form-select @error('educational_attainment') is-invalid @enderror"
                                wire:model="educational_attainment">
                                <option value="">Select Educational Attainment</option>
                                <option value="Elementary Graduate">Elementary Graduate</option>
                                <option value="Elementary Undergraduate">Elementary Undergraduate</option>
                                <option value="High School Graduate">High School Graduate</option>
                                <option value="High School Undergraduate">High School Undergraduate</option>
                                <option value="College Graduate">College Graduate</option>
                                <option value="College Undergraduate">College Undergraduate</option>
                                <option value="Vocational">Vocational</option>
                            </select>
                            @error('educational_attainment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="contact_no">Contact No</label>
                            <input type="text" class="form-control @error('contact_no') is-invalid @enderror"
                                wire:model="contact_no" placeholder="Contact Number">
                            @error('contact_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                wire:model="email" placeholder="Contact Number">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="sitio">Sitio</label>
                            <input type="text" class="form-control @error('sitio') is-invalid @enderror"
                                wire:model="sitio" placeholder="Sitio">
                            @error('sitio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="philhealth_id">Philhealth ID</label>
                            <input type="text" class="form-control @error('philhealth_id') is-invalid @enderror"
                                wire:model="philhealth_id" placeholder="Philhealth ID">
                            @error('philhealth_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="sss_id">SSS ID</label>
                            <input type="text" class="form-control @error('sss_id') is-invalid @enderror"
                                wire:model="sss_id" placeholder="SSS ID">
                            @error('sss_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="gsis_id">GSIS ID</label>
                            <input type="text" class="form-control @error('gsis_id') is-invalid @enderror"
                                wire:model="gsis_id" placeholder="GSIS ID">
                            @error('gsis_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="social_pension_id">Social Pension ID</label>
                            <input type="text"
                                class="form-control @error('social_pension_id') is-invalid @enderror"
                                wire:model="social_pension_id" placeholder="Social Pension ID">
                            @error('social_pension_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="illness">Illness</label>
                            <input type="text" class="form-control @error('illness') is-invalid @enderror"
                                wire:model="illness" placeholder="Illness">
                            @error('illness')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card">
                            <div class="card-header">Occupation</div>
                            <div class="card-body row">
                                <div class="mb-3 col-md-6">
                                    <label for="source_of_income">Souce of Income</label>
                                    <input type="text"
                                        class="form-control @error('enderror') is-invalid @enderror"
                                        wire:model="source_of_income" placeholder="Source of Income">
                                    @error('enderror')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="monthly_income">Monthly Income</label>
                                    <input type="text"
                                        class="form-control @error('monthly_income') is-invalid @enderror"
                                        wire:model="monthly_income" placeholder="Monthly Income">
                                    @error('monthly_income')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="income_type">Income Type</label>
                                    <select class="form-select @error('income_type') is-invalid @enderror"
                                        wire:model="income_type">
                                        <option value="">Select Income Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Irregular">Irregular</option>
                                    </select>
                                    @error('income_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="p-0 col-md-12 card">
                            <div class="card-header">
                                <div class="form-check">
                                    <label><input class="form-check-input" type="checkbox" wire:model.live="is_pwd">
                                        is PWD?</label>
                                </div>
                            </div>
                            @if ($is_pwd)
                                <div class="card-body row">
                                    <div class="col-6">
                                        <label for="pwd_id">PWD ID</label>
                                        <input type="text"
                                            class="form-control @error('pwd_id') is-invalid @enderror"
                                            wire:model="pwd_id" placeholder="PWD ID">
                                        @error('pwd_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="type_of_disability">Type of Disability</label>
                                        <input type="text"
                                            class="form-control @error('type_of_disability') is-invalid @enderror"
                                            wire:model="type_of_disability" placeholder="Type of Disability">
                                        @error('type_of_disability')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="p-0 col-md-12 card">
                            <div class="card-header">
                                <div class="form-check">
                                    <label><input type="checkbox" class="form-check-input"
                                            wire:model.live="is_solo_parent"> is Solo Parent?</label>
                                </div>
                            </div>
                            @if ($is_solo_parent)
                                <div class="space-y-2 card-body">
                                    <label for="solo_parent_id">Solo Parent ID</label>
                                    <input type="text"
                                        class="form-control @error('solo_parent_id') is-invalid @enderror"
                                        wire:model="solo_parent_id" placeholder="Solo Parent ID">
                                    @error('solo_parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        <div class="p-0 col-md-12 card">
                            <div class="card-header">
                                <div class="form-check">
                                    <label><input class="form-check-input" type="checkbox"
                                            wire:model.live="is_senior_citizen"> is Senior Citizen?</label>
                                </div>
                            </div>
                            @if ($is_senior_citizen)
                                <div class="space-y-2 card-body">
                                    <label for="senior_citizen_id">Senior Citizen ID</label>
                                    <input type="text"
                                        class="form-control @error('senior_citizen_id') is-invalid @enderror"
                                        wire:model="senior_citizen_id" placeholder="Senior Citizen ID">
                                    @error('senior_citizen_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        <div class="p-0 col-md-12 card">
                            <div class="card-header">
                                <div class="form-check">
                                    <label><input class="form-check-input" type="checkbox" wire:model.live="is_ofw">
                                        is OFW?</label>
                                </div>
                            </div>
                            @if ($is_ofw)
                                <div class="space-y-2 card-body">
                                    <label for="ofw_country">Country</label>
                                    <input type="text" class="form-control" wire:model="ofw_country"
                                        placeholder="Country">
                                    <label><input class="form-check-input" type="checkbox"
                                            wire:model="ofw_is_domestic_helper"> Domestic Helper</label>
                                    <label><input class="form-check-input" type="checkbox"
                                            wire:model="ofw_professional"> Professional</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button class="btn btn-primary ms-auto" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    {{-- Add Resident Modal --}}

    {{-- Delete Confirmation Modal --}}
    <div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="text-white modal-header bg-danger">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center modal-body">
                    <i class="ti ti-alert-triangle text-danger" style="font-size: 3rem;"></i>
                    <p class="mt-3">Are you sure you want to delete this resident record?</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteConfirmed">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Confirmation Modal --}}

</div>

@script
    <script>
        // Initialize modals and set up event listeners
        document.addEventListener('livewire:initialized', () => {
            // Show delete confirmation modal
            Livewire.on('show-delete-modal', () => {
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                deleteModal.show();
            });

            // Close delete confirmation modal
            Livewire.on('close-delete-modal', () => {
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById(
                    'deleteConfirmationModal'));
                if (deleteModal) {
                    deleteModal.hide();
                }
            });
        });
    </script>
@endscript
