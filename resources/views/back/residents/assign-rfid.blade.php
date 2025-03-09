@extends('back.layouts.admin-layout')

@section('pageTitle', 'Assign RFID to Resident')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Assign RFID Card
                    </h2>
                    <div class="mt-1 text-muted">
                        Assigning RFID to <span class="text-primary fw-bold">{{ $resident->full_name }}</span>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('auth.residents.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l14 0"></path>
                                <path d="M5 12l6 6"></path>
                                <path d="M5 12l6 -6"></path>
                            </svg>
                            Back to Residents
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="mx-auto col-md-6">
                    <form action="{{ route('admin.residents.assign-rfid', $resident->id) }}" method="POST" class="card">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">RFID Assignment Form</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-label required">Resident Information</div>
                                <div class="form-control-plaintext">
                                    <div><strong>Name:</strong> {{ $resident->full_name }}</div>
                                    <div><strong>ID:</strong> {{ $resident->id }}</div>
                                    <div><strong>Address:</strong> {{ $resident->sitio }}</div>
                                    <div><strong>Contact:</strong> {{ $resident->contact_no }}</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">Current RFID Number</label>
                                <div class="form-control-plaintext">
                                    {{ $resident->rfid_number ?? 'Not yet assigned' }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required">New RFID Number</label>
                                <input type="text" name="rfid_number"
                                    class="form-control @error('rfid_number') is-invalid @enderror"
                                    value="{{ old('rfid_number', $resident->rfid_number) }}" required autofocus
                                    placeholder="Scan or enter RFID number">
                                @error('rfid_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-hint">
                                    Place the RFID card on the scanner or manually input the RFID number.
                                </small>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Assign RFID</button>
                        </div>
                    </form>

                    <div class="mt-3 card">
                        <div class="card-header">
                            <h3 class="card-title">Instructions</h3>
                        </div>
                        <div class="card-body">
                            <ol class="ps-3">
                                <li>Place the new RFID card on the scanner.</li>
                                <li>The RFID number should automatically appear in the input field.</li>
                                <li>If the number doesn't appear, make sure the scanner is properly connected.</li>
                                <li>You can also manually type in the RFID number if needed.</li>
                                <li>Click "Assign RFID" to save the assignment.</li>
                            </ol>
                            <div class="mt-3 alert alert-info">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 9h.01"></path>
                                            <path d="M11 12h1v4h1"></path>
                                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4>RFID Card Security</h4>
                                        <p>Each RFID card must be unique to a single resident. If the system detects a
                                            duplicate RFID number, you will be notified and required to use a different
                                            card.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-focus the input field for RFID scanning
            document.addEventListener('DOMContentLoaded', function() {
                const rfidInput = document.querySelector('input[name="rfid_number"]');
                if (rfidInput) {
                    rfidInput.focus();
                }
            });
        </script>
    @endpush
@endsection
