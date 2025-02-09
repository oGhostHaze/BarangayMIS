<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Add Resident Form</h2>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $resident_id ? 'update' : 'store' }}">
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
                        <input type="text" class="form-control @error('social_pension_id') is-invalid @enderror"
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
                                <input type="text" class="form-control @error('enderror') is-invalid @enderror"
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
                                <label><input class="form-check-input" type="checkbox" wire:model.live="is_pwd"> is
                                    PWD?</label>
                            </div>
                        </div>
                        @if ($is_pwd)
                            <div class="card-body row">
                                <div class="col-6">
                                    <label for="pwd_id">PWD ID</label>
                                    <input type="text" class="form-control @error('pwd_id') is-invalid @enderror"
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
                                <label><input class="form-check-input" type="checkbox" wire:model.live="is_ofw"> is
                                    OFW?</label>
                            </div>
                        </div>
                        @if ($is_ofw)
                            <div class="space-y-2 card-body">
                                <label for="ofw_country">Country</label>
                                <input type="text" class="form-control" wire:model="ofw_country"
                                    placeholder="Country">
                                <label><input class="form-check-input" type="checkbox"
                                        wire:model="ofw_is_domestic_helper"> Domestic Helper</label>
                                <label><input class="form-check-input" type="checkbox" wire:model="ofw_professional">
                                    Professional</label>
                            </div>
                        @endif
                    </div>
                    <div class="flex space-x-2 col-md-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-warning">Cancel/Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
