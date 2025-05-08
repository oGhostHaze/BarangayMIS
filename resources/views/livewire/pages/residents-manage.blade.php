<div class="mt-5 container-fluid">
    <div class="mt-4 card">
        <div class="card-header d-flex justify-content-between">
            <h2 class="card-title">Residents List</h2>
            @role('barangay_official')
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addResidentModal">Add Resident</button>
            @endrole
        </div>
        <div class="card-body">
            <!-- Search and Filter Section -->
            <div class="mb-4 row">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="10" cy="10" r="7"></circle>
                                <line x1="21" y1="21" x2="15" y2="15"></line>
                            </svg>
                        </span>
                        <input type="text" class="form-control" placeholder="Search resident name, contact, email..."
                            wire:model.live="search">
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-select" wire:model.live="filter_gender">
                        <option value="">All Genders</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" wire:model.live="filter_status">
                        <option value="">All Statuses</option>
                        <option value="pwd">PWD</option>
                        <option value="senior">Senior Citizen</option>
                        <option value="solo_parent">Solo Parent</option>
                        <option value="ofw">OFW</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" wire:model.live="perPage">
                        <option value="10">10 per page</option>
                        <option value="25">25 per page</option>
                        <option value="50">50 per page</option>
                        <option value="100">100 per page</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-secondary w-100" wire:click="resetFilters">
                        Reset Filters
                    </button>
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($residents as $resident)
                        <tr>
                            <td>{{ $resident->first_name }} {{ $resident->last_name }}</td>
                            <td>{{ $resident->date_of_birth }}</td>
                            <td>{{ \Carbon\Carbon::parse($resident->date_of_birth)->age }}</td>
                            <td>{{ $resident->gender }}</td>
                            <td>{{ $resident->contact_no }}</td>
                            <td>
                                @if ($resident->is_pwd)
                                    <span class="badge bg-blue">PWD</span>
                                @endif
                                @if ($resident->is_senior_citizen)
                                    <span class="badge bg-purple">Senior</span>
                                @endif
                                @if ($resident->is_solo_parent)
                                    <span class="badge bg-green">Solo Parent</span>
                                @endif
                                @if ($resident->is_ofw)
                                    <span class="badge bg-orange">OFW</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('auth.residents.show', $resident->id) }}">View</a>
                                <a class="btn btn-secondary btn-sm"
                                    href="{{ route('admin.residents.assign-rfid', $resident->id) }}">
                                    Assign RFID
                                </a>
                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $resident->id }})"
                                    data-bs-toggle="modal" data-bs-target="#addResidentModal">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="confirmDelete({{ $resident->id }})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $residents->links() }}
            </div>
        </div>
    </div>

    {{-- Add Resident Modal --}}
    <div class="modal" id="addResidentModal" tabindex="-1" wire:ignore.self>
        <form class="modal-dialog modal-xl" role="document"
            wire:submit.prevent="{{ $resident_id ? 'update' : 'store' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">{{ $resident_id ? 'Edit Resident' : 'Add New Resident' }}</h2>
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
                                wire:model="email" placeholder="Email Address">
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
                                    <label for="source_of_income">Source of Income</label>
                                    <input type="text"
                                        class="form-control @error('source_of_income') is-invalid @enderror"
                                        wire:model="source_of_income" placeholder="Source of Income">
                                    @error('source_of_income')
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
