<div class="mt-4 container-fluid">
    <div class="shadow card">
        <div class="py-3 text-center text-white card-header bg-primary">
            <h3 class="mb-0">Barangay Organizational Chart</h3>
        </div>
        <div class="p-4 card-body">
            <div class="d-flex flex-column align-items-center">
                <!-- Barangay Captain -->
                @php
                    $captain = $officials->where('position', 'Punong Barangay (Barangay Captain)')->first();
                @endphp
                @if ($captain)
                    <div class="mb-4 text-center">
                        <div class="p-3 text-white shadow card bg-primary" style="min-width: 300px; border-radius: 10px;">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-2">
                                    <img src="{{ $captain->photo ? Storage::url($captain->photo) : asset('images/default-avatar.png') }}"
                                        alt="{{ $captain->first_name }}"
                                        class="border rounded-circle border-3 border-light" width="100"
                                        height="100">
                                </div>
                                <h5 class="mb-1 text-nowrap">HON.
                                    {{ strtoupper($captain->first_name . ' ' . $captain->last_name) }}</h5>
                                <small class="text-white-50">Punong Barangay (Barangay Captain)</small>
                            </div>
                        </div>
                        <!-- Connecting Line -->
                        <div class="bg-primary" style="width: 2px; height: 40px; margin: 0 auto;"></div>
                    </div>
                @endif

                <!-- Councilors -->
                <div class="mb-4 w-100">
                    <h4 class="mb-3 text-center text-primary">Barangay Kagawad (Councilors)</h4>
                    <div class="row justify-content-center g-3">
                        @foreach ($officials->where('position', 'Barangay Kagawad (Councilor)') as $councilor)
                            <div class="col-md-3">
                                <div class="p-3 text-center shadow-sm card h-100 border-primary"
                                    style="min-width: 220px; border-radius: 8px;">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="mb-2">
                                            <img src="{{ $councilor->photo ? Storage::url($councilor->photo) : asset('images/default-avatar.png') }}"
                                                alt="{{ $councilor->first_name }}"
                                                class="border border-2 rounded-circle border-primary" width="80"
                                                height="80">
                                        </div>
                                        <h6 class="mb-1 text-nowrap fw-bold">HON.
                                            {{ strtoupper($councilor->first_name . ' ' . $councilor->last_name) }}</h6>
                                        <small class="text-muted">Barangay Kagawad (Councilor)</small>
                                        <div class="mt-2 badge bg-light text-primary">Committee Chair</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Connecting Line -->
                <div class="bg-primary" style="width: 2px; height: 30px; margin: 0 auto;"></div>

                <!-- SK Chairperson, Secretary, Treasurer - Key Officials -->
                <div class="mb-4 w-100">
                    <h4 class="mb-3 text-center text-primary">Key Officials</h4>
                    <div class="row justify-content-center g-3">
                        @foreach (['Sangguniang Kabataan Chairperson', 'Barangay Secretary', 'Barangay Treasurer'] as $role)
                            @php
                                $official = $officials->where('position', $role)->first();
                            @endphp
                            @if ($official)
                                <div class="col-md-4">
                                    <div class="p-3 text-center shadow-sm card h-100"
                                        style="min-width: 220px; border-left: 4px solid #0d6efd; border-radius: 8px;">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="mb-2">
                                                <img src="{{ $official->photo ? Storage::url($official->photo) : asset('images/default-avatar.png') }}"
                                                    alt="{{ $official->first_name }}"
                                                    class="border border-2 rounded-circle border-primary" width="70"
                                                    height="70">
                                            </div>
                                            <h6 class="mb-1 text-nowrap fw-bold">
                                                @if ($role == 'Sangguniang Kabataan Chairperson')
                                                    HON.
                                                    {{ strtoupper($official->first_name . ' ' . $official->last_name) }}
                                                @else
                                                    {{ strtoupper($official->prefix ?? ($role == 'Barangay Secretary' ? 'MS.' : 'MR.')) }}
                                                    {{ strtoupper($official->first_name . ' ' . $official->last_name) }}
                                                @endif
                                            </h6>
                                            <small class="text-muted">{{ $role }}</small>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-4">
                                    <div class="p-3 text-center shadow-sm card h-100 bg-light"
                                        style="min-width: 220px; border-left: 4px solid #0d6efd; border-radius: 8px;">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="mb-2">
                                                <img src="{{ asset('images/default-avatar.png') }}" alt="Vacant"
                                                    class="border border-2 opacity-50 rounded-circle border-light"
                                                    width="70" height="70">
                                            </div>
                                            <h6 class="mb-1 text-nowrap text-muted">(Vacant)</h6>
                                            <small class="text-muted">{{ $role }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Connecting Line -->
                <div class="bg-primary" style="width: 2px; height: 30px; margin: 0 auto;"></div>

                <!-- Barangay Staff -->
                @php
                    $otherStaff = $officials->whereNotIn('position', [
                        'Punong Barangay (Barangay Captain)',
                        'Barangay Kagawad (Councilor)',
                        'Sangguniang Kabataan Chairperson',
                        'Barangay Secretary',
                        'Barangay Treasurer',
                    ]);
                @endphp

                @if (count($otherStaff) > 0)
                    <div class="w-100">
                        <h4 class="mb-3 text-center text-primary">Barangay Staff</h4>
                        <div class="row justify-content-center g-3">
                            @foreach ($otherStaff as $staff)
                                <div class="col-md-3">
                                    <div class="p-3 text-center shadow-sm card h-100"
                                        style="min-width: 200px; border-radius: 8px;">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="mb-2">
                                                <img src="{{ $staff->photo ? Storage::url($staff->photo) : asset('images/default-avatar.png') }}"
                                                    alt="{{ $staff->first_name }}"
                                                    class="border rounded-circle border-1 border-primary" width="60"
                                                    height="60">
                                            </div>
                                            <h6 class="mb-1 text-nowrap">
                                                {{ strtoupper($staff->first_name . ' ' . $staff->last_name) }}</h6>
                                            <small class="text-muted">{{ $staff->position }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="py-3 text-center card-footer bg-light">
            <small class="text-muted">Last updated: {{ now()->format('F d, Y') }}</small>
        </div>
    </div>
</div>
