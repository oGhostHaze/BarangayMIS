<div class="py-4 container-xl">
    <div class="card card-md">
        <div class="card-body">
            <h2 class="mb-4 text-center card-title">Resident Registration</h2>

            <div class="mb-4 progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $this->progressPercentage }}%"
                    aria-valuenow="{{ $this->currentStep }}" aria-valuemin="0" aria-valuemax="4">
                    Step {{ $this->currentStep }} of 4
                </div>
            </div>

            <form wire:submit="register">
                <!-- Step 1: Personal Information -->
                <div class="step" x-show="$wire.currentStep === 1">
                    <h3 class="mb-3">Personal Information</h3>

                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label class="form-label">Prefix</label>
                            <input type="text" class="form-control" wire:model="prefix">
                            @error('prefix')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-9">
                            <label class="form-label required">First Name</label>
                            <input type="text" class="form-control" wire:model="first_name" required>
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" wire:model="middle_name">
                            @error('middle_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label required">Last Name</label>
                            <input type="text" class="form-control" wire:model="last_name" required>
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-2">
                            <label class="form-label">Suffix</label>
                            <input type="text" class="form-control" wire:model="suffix">
                            @error('suffix')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label required">Date of Birth</label>
                            <input type="date" class="form-control" wire:model="date_of_birth" required>
                            @error('date_of_birth')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label required">Gender</label>
                            <select class="form-select" wire:model="gender" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label required">Civil Status</label>
                            <select class="form-select" wire:model="civil_status" required>
                                <option value="">Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                            @error('civil_status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label required">Contact Number</label>
                            <input type="text" class="form-control" wire:model="contact_no" required>
                            @error('contact_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Sitio/Street</label>
                            <input type="text" class="form-control" wire:model="sitio">
                            @error('sitio')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 2: ID Numbers & Special Categories -->
                <div class="step" x-show="$wire.currentStep === 2">
                    <h3 class="mb-3">ID Numbers & Special Categories</h3>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">PhilHealth ID</label>
                            <input type="text" class="form-control" wire:model="philhealth_id">
                            @error('philhealth_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">SSS ID</label>
                            <input type="text" class="form-control" wire:model="sss_id">
                            @error('sss_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">GSIS ID</label>
                            <input type="text" class="form-control" wire:model="gsis_id">
                            @error('gsis_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Social Pension ID</label>
                            <input type="text" class="form-control" wire:model="social_pension_id">
                            @error('social_pension_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model="is_pwd">
                            <label class="form-check-label">Person with Disability (PWD)</label>
                        </div>
                    </div>

                    <div class="row" x-show="$wire.is_pwd">
                        <div class="mb-3 col-md-4">
                            <label class="form-label">PWD ID</label>
                            <input type="text" class="form-control" wire:model="pwd_id">
                            @error('pwd_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Type of Disability</label>
                            <input type="text" class="form-control" wire:model="type_of_disability">
                            @error('type_of_disability')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Illness</label>
                            <input type="text" class="form-control" wire:model="illness">
                            @error('illness')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model="is_solo_parent">
                            <label class="form-check-label">Solo Parent</label>
                        </div>
                    </div>

                    <div class="mb-3" x-show="$wire.is_solo_parent">
                        <label class="form-label">Solo Parent ID</label>
                        <input type="text" class="form-control" wire:model="solo_parent_id">
                        @error('solo_parent_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model="is_senior_citizen">
                            <label class="form-check-label">Senior Citizen</label>
                        </div>
                    </div>

                    <div class="mb-3" x-show="$wire.is_senior_citizen">
                        <label class="form-label">Senior Citizen ID</label>
                        <input type="text" class="form-control" wire:model="senior_citizen_id">
                        @error('senior_citizen_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Step 3: Economic Information -->
                <div class="step" x-show="$wire.currentStep === 3">
                    <h3 class="mb-3">Economic Information</h3>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Educational Attainment</label>
                            <select class="form-select" wire:model="educational_attainment">
                                <option value="">Select</option>
                                <option value="Elementary">Elementary</option>
                                <option value="High School">High School</option>
                                <option value="Vocational">Vocational</option>
                                <option value="College">College</option>
                                <option value="Graduate">Graduate</option>
                                <option value="Post-Graduate">Post-Graduate</option>
                            </select>
                            @error('educational_attainment')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Source of Income</label>
                            <input type="text" class="form-control" wire:model="source_of_income">
                            @error('source_of_income')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Monthly Income (PHP)</label>
                            <input type="number" step="0.01" min="0" class="form-control"
                                wire:model="monthly_income">
                            @error('monthly_income')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Income Type</label>
                            <select class="form-select" wire:model="income_type">
                                <option value="">Select</option>
                                <option value="Regular">Regular</option>
                                <option value="Irregular">Irregular</option>
                            </select>
                            @error('income_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model="is_ofw">
                            <label class="form-check-label">Overseas Filipino Worker (OFW)</label>
                        </div>
                    </div>

                    <div x-show="$wire.is_ofw">
                        <div class="mb-3">
                            <label class="form-label">OFW Country</label>
                            <input type="text" class="form-control" wire:model="ofw_country">
                            @error('ofw_country')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" wire:model="ofw_is_domestic_helper">
                                <label class="form-check-label">Domestic Helper</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" wire:model="ofw_professional">
                                <label class="form-check-label">Professional</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Account Information -->
                <div class="step" x-show="$wire.currentStep === 4">
                    <h3 class="mb-3">Account Information</h3>

                    <div class="mb-3">
                        <label class="form-label required">Email Address</label>
                        <input type="email" class="form-control" wire:model="email" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Password</label>
                        <input type="password" class="form-control" wire:model="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Confirm Password</label>
                        <input type="password" class="form-control" wire:model="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-footer">
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                            <label class="form-check-label" for="termsCheck">
                                I agree to the <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#termsModal">terms and conditions</a>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" wire:click="previousStep"
                        {{ $this->currentStep === 1 ? 'disabled' : '' }}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l14 0"></path>
                            <path d="M5 12l6 6"></path>
                            <path d="M5 12l6 -6"></path>
                        </svg>
                        Previous
                    </button>

                    @if ($this->currentStep < 4)
                        <button type="button" class="btn btn-primary" wire:click="nextStep">
                            Next
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l14 0"></path>
                                <path d="M13 18l6 -6"></path>
                                <path d="M13 6l6 6"></path>
                            </svg>
                        </button>
                    @else
                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                            Register
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="mt-3 text-center text-muted">
        Already have an account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
    </div>


    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Terms and conditions content goes here -->
                    <p>By registering for this service, you agree to the following terms and conditions...</p>
                    <!-- Add more terms content as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Agree</button>
                </div>
            </div>
        </div>
    </div>

</div>
