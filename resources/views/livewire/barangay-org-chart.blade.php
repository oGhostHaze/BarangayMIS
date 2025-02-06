<div class="container mt-4">
    <div class="shadow card">
        <div class="text-center card-header">
            <h4 class="mb-0">Barangay Organizational Chart</h4>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column align-items-center">
                <!-- Barangay Captain -->
                @php
                    $captain = $officials->where('position', 'Punong Barangay (Barangay Captain)')->first();
                @endphp
                @if ($captain)
                    <div class="text-center">
                        <div class="p-3 text-white shadow-sm card bg-primary">
                            <h5>{{ $captain->first_name }} {{ $captain->last_name }}</h5>
                            <small>Punong Barangay (Barangay Captain)</small>
                        </div>
                    </div>
                @endif

                <!-- Councilors -->
                <div class="mt-4 row">
                    @foreach ($officials->where('position', 'Barangay Kagawad (Councilor)') as $councilor)
                        <div class="col-md-4">
                            <div class="p-3 text-center shadow-sm card">
                                <h6>{{ $councilor->first_name }} {{ $councilor->last_name }}</h6>
                                <small>Barangay Kagawad (Councilor)</small>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- SK Chairperson, Secretary, Treasurer -->
                <div class="mt-4 row">
                    @foreach (['Sangguniang Kabataan Chairperson', 'Barangay Secretary', 'Barangay Treasurer'] as $role)
                        @php
                            $official = $officials->where('position', $role)->first();
                        @endphp
                        @if ($official)
                            <div class="col-md-4">
                                <div class="p-3 text-center shadow-sm card">
                                    <h6>{{ $official->first_name }} {{ $official->last_name }}</h6>
                                    <small>{{ $role }}</small>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Barangay Staff -->
                <div class="mt-4 row">
                    @foreach ($officials->whereNotIn('position', ['Punong Barangay (Barangay Captain)', 'Barangay Kagawad (Councilor)', 'Sangguniang Kabataan Chairperson', 'Barangay Secretary', 'Barangay Treasurer']) as $staff)
                        <div class="col-md-3">
                            <div class="p-3 text-center shadow-sm card">
                                <h6>{{ $staff->first_name }} {{ $staff->last_name }}</h6>
                                <small>{{ $staff->position }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
