<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary" onclick="printDiv()">Print</button>
    </div>

    <div id="printable" class="p-5 mt-3 bg-white border">
        @if ($setting and $capt and $resident)
            <!-- Decorative Header Border (Red and Gold Lines) -->
            <div class="text-center">
                <div
                    style="height: 15px; background: linear-gradient(to right, #e20000 50%, #fff 50%); border-bottom: 2px solid #ffd700;">
                </div>
            </div>

            <!-- Watermark -->
            <div class="opacity-25 position-absolute top-50 start-50 translate-middle" style="z-index: -1;">
                <img src="{{ asset('images/watermark-logo.png') }}" alt="Watermark" style="width: 60%;">
            </div>

            <!-- Different layouts based on certificate type -->
            @if ($request->certificate_type == 'Barangay Clearance')
                <!-- Barangay Clearance Layout -->
                <div class="text-center">
                    <div class="mt-4 mb-3 row align-items-center">
                        <div class="col-2 d-flex justify-content-center">
                            <img src="{{ asset('storage/' . $setting->provincial_logo) }}" alt="Logo 1"
                                style="width: 80px; height: 80px;">
                        </div>
                        <div class="col-8">
                            <div>
                                <h5 class="mb-0">Republic of the Philippines</h5>
                                <h5 class="mb-0">Province of {{ ucfirst($setting->province_name) }}</h5>
                                <h5 class="mb-0">{{ ucfirst($setting->municipal_name) }}</h5>
                                <h5 class="mb-0">{{ ucfirst($setting->barangay_name) }}</h5>
                                <h6 class="mt-3 fs-4 text-uppercase fw-bold">OFFICE OF THE PUNONG BARANGAY</h6>
                            </div>
                        </div>
                        <div class="col-2 d-flex justify-content-center">
                            <img src="{{ asset('storage/' . $setting->barangay_logo) }}" alt="Logo 2"
                                style="width: 80px; height: 80px;">
                        </div>
                    </div>

                    <!-- Certificate Title -->
                    <h2 class="mt-4 fs-1 text-uppercase">
                        <strong style="border-bottom: 2px solid #000; padding-bottom: 5px;">BARANGAY CLEARANCE</strong>
                    </h2>

                    <!-- Officers Section -->
                    <div class="mt-4 row">
                        <div class="col-4 text-start">
                            <h6 class="mb-3 text-uppercase fw-bold">BARANGAY OFFICIALS</h6>

                            <!-- Punong Barangay -->
                            <p class="mb-1"><strong>HON.
                                    {{ strtoupper($capt->first_name . ' ' . $capt->last_name) }}</strong></p>
                            <p class="mb-3 text-muted small">Punong Barangay (Barangay Captain)</p>

                            <!-- Kagawad Members -->
                            @if (count($officials) > 0)
                                @foreach ($officials as $official)
                                    <p class="mb-1"><strong>HON.
                                            {{ strtoupper($official->first_name . ' ' . $official->last_name) }}</strong>
                                    </p>
                                    <p class="mb-3 text-muted small">Barangay Kagawad (Councilor)</p>
                                @endforeach
                            @else
                                <!-- Fallback if no officials in database -->
                                <p class="mb-1"><strong>HON. JUAN DELA CRUZ</strong></p>
                                <p class="mb-3 text-muted small">Barangay Kagawad (Councilor)</p>

                                <p class="mb-1"><strong>HON. MARIA SANTOS</strong></p>
                                <p class="mb-3 text-muted small">Barangay Kagawad (Councilor)</p>

                                <p class="mb-1"><strong>HON. PEDRO REYES</strong></p>
                                <p class="mb-3 text-muted small">Barangay Kagawad (Councilor)</p>

                                <p class="mb-1"><strong>HON. ANTONIO GARCIA</strong></p>
                                <p class="mb-3 text-muted small">Barangay Kagawad (Councilor)</p>

                                <p class="mb-1"><strong>HON. ELENA BAUTISTA</strong></p>
                                <p class="mb-3 text-muted small">Barangay Kagawad (Councilor)</p>

                                <p class="mb-1"><strong>HON. RICARDO LOZADA</strong></p>
                                <p class="mb-3 text-muted small">Barangay Kagawad (Councilor)</p>

                                <p class="mb-1"><strong>HON. ROSARIO CRUZ</strong></p>
                                <p class="mb-3 text-muted small">Barangay Kagawad (Councilor)</p>
                            @endif

                            <!-- SK Chairperson -->
                            @if ($sk_chairman)
                                <p class="mb-1"><strong>HON.
                                        {{ strtoupper($sk_chairman->first_name . ' ' . $sk_chairman->last_name) }}</strong>
                                </p>
                                <p class="mb-3 text-muted small">Sangguniang Kabataan Chairperson</p>
                            @else
                                <p class="mb-1"><strong>HON. CARLOS MENDOZA</strong></p>
                                <p class="mb-3 text-muted small">Sangguniang Kabataan Chairperson</p>
                            @endif

                            <!-- Secretary -->
                            @if ($secretary)
                                <p class="mb-1"><strong>{{ strtoupper($secretary->prefix ?? 'MS.') }}
                                        {{ strtoupper($secretary->first_name . ' ' . $secretary->last_name) }}</strong>
                                </p>
                                <p class="mb-3 text-muted small">Barangay Secretary</p>
                            @else
                                <p class="mb-1"><strong>MS. LUCIA FERNANDEZ</strong></p>
                                <p class="mb-3 text-muted small">Barangay Secretary</p>
                            @endif

                            <!-- Treasurer -->
                            @if ($treasurer)
                                <p class="mb-1"><strong>{{ strtoupper($treasurer->prefix ?? 'MR.') }}
                                        {{ strtoupper($treasurer->first_name . ' ' . $treasurer->last_name) }}</strong>
                                </p>
                                <p class="text-muted small">Barangay Treasurer</p>
                            @else
                                <p class="mb-1"><strong>MR. ROBERTO TORRES</strong></p>
                                <p class="text-muted small">Barangay Treasurer</p>
                            @endif
                        </div>

                        <!-- Certificate Content -->
                        <div class="col-8 text-start">
                            <p class="mt-3 fs-5 fw-bold">TO WHOM IT MAY CONCERN:</p>

                            <p class="mt-4 fs-5 lh-base">
                                <span class="fw-bold">THIS IS TO CERTIFY</span> that
                                <span
                                    class="fw-bold text-decoration-underline">{{ $resident->first_name . ' ' . $resident->middle_name . ' ' . $resident->last_name }}</span>,
                                <span class="fw-bold">{{ $resident->age() }}</span> years of age,
                                <span class="fw-bold">{{ $resident->civil_status }}</span>, and a resident of
                                {{ ucfirst($setting->barangay_name . ', ' . $setting->municipal_name . ', ' . $setting->province_name) }}.
                            </p>

                            <p class="mt-4 fs-5 lh-base">
                                <span class="fw-bold">THIS IS TO CERTIFY FURTHER</span> that he/she has no derogatory
                                record filed in this office and is a person of good moral character known to have a good
                                reputation in the community.
                            </p>

                            <p class="mt-4 fs-5 lh-base">
                                <span class="fw-bold">THIS CERTIFICATION</span> is being issued upon the request of the
                                above-named person for whatever legal purpose it may serve him/her best.
                            </p>

                            <p class="mt-4 mb-5 fs-5 lh-base">
                                <span class="fw-bold">ISSUED</span> this
                                <span
                                    class="fw-bold">{{ \Carbon\Carbon::parse($request->updated_at)->format('jS') }}</span>
                                day of
                                <span
                                    class="fw-bold">{{ \Carbon\Carbon::parse($request->updated_at)->format('F, Y') }}</span>
                                at
                                {{ ucfirst($setting->barangay_name . ', ' . $setting->municipal_name . ', ' . $setting->province_name) }},
                                Philippines.
                            </p>

                            <div class="mt-5 text-center">
                                <div class="mb-3">
                                    @if ($resident->valid_id_path)
                                        <img src="{{ asset('storage/' . $resident->valid_id_path) }}" alt="Resident ID"
                                            style="max-height: 100px; max-width: 80px; object-fit: contain; border: 1px solid #ddd;">
                                    @else
                                        <!-- Placeholder for ID photo -->
                                        <div
                                            style="height: 100px; width: 80px; border: 1px solid #ddd; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                                            <span>ID Photo</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="mb-1 text-decoration-underline">
                                    {{ $resident->first_name . ' ' . $resident->middle_name . ' ' . $resident->last_name }}
                                </p>
                                <p class="small text-muted">Signature over printed name</p>
                            </div>

                            <div class="mt-5 text-end">
                                <h4 class="mb-0 text-uppercase">
                                    <strong
                                        class="text-decoration-underline">{{ $capt->first_name . ' ' . $capt->middle_name . ' ' . $capt->last_name }}</strong>
                                </h4>
                                <p class="mt-0 fw-italic">Punong Barangay (Barangay Captain)</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Original layout for other certificate types -->
                <div class="text-center">
                    <div class="mt-4 mb-3 row align-items-center">
                        <div class="col-2 d-flex justify-content-center">
                            <img src="{{ asset('storage/' . $setting->provincial_logo) }}" alt="Logo 1"
                                style="width: 80px; height: 80px;">
                        </div>
                        <div class="col-8">
                            <div>
                                <h5 class="mb-0">Republic of the Philippines</h5>
                                <h5 class="mb-0">Province of {{ ucfirst($setting->province_name) }}</h5>
                                <h5 class="mb-0">{{ ucfirst($setting->municipal_name) }}</h5>
                                <h5 class="mb-0">{{ ucfirst($setting->barangay_name) }}</h5>
                                <h6 class="mt-3 fs-4 text-uppercase fw-bold">OFFICE OF THE PUNONG BARANGAY</h6>
                                <h2 class="mt-4 fs-1 text-uppercase">
                                    <strong
                                        style="border-bottom: 2px solid #000; padding-bottom: 5px;">{{ $request->certificate_type }}</strong>
                                </h2>
                            </div>
                        </div>
                        <div class="col-2 d-flex justify-content-center">
                            <img src="{{ asset('storage/' . $setting->barangay_logo) }}" alt="Logo 2"
                                style="width: 80px; height: 80px;">
                        </div>
                    </div>

                    <div class="mt-5">
                        <p class="fs-5 fw-bold text-start">TO WHOM IT MAY CONCERN:</p>

                        <p class="mt-4 text-start fs-5 lh-base">
                            <span class="fw-bold">THIS IS TO CERTIFY</span> that I know personally,
                            <span
                                class="fw-bold text-decoration-underline">{{ $resident->first_name . ' ' . $resident->middle_name . ' ' . $resident->last_name }}</span>,
                            <span class="fw-bold">{{ $resident->age() }}</span> years of age,
                            <span class="fw-bold">{{ $resident->civil_status }}</span>, and a resident of
                            {{ ucfirst($setting->barangay_name . ', ' . $setting->municipal_name . ', ' . $setting->province_name) }}.
                        </p>

                        <p class="mt-4 text-start fs-5 lh-base">
                            <span class="fw-bold">THIS IS TO CERTIFY FURTHER</span> that
                            @if ($request->certificate_type == 'Certificate of Indigency')
                                he/she belongs to an Indigent Family of this barangay.
                            @elseif($request->certificate_type == 'Certificate of Low Income')
                                he/she is a/an {{ $resident->source_of_income }} with monthly income of Php
                                {{ number_format($resident->monthly_income, 2) ?? 0.0 }} and belongs to Low Income
                                Family of
                                this barangay.
                            @elseif($request->certificate_type == 'Certificate of Community Service')
                                <span
                                    class="fw-bold text-decoration-underline">{{ $resident->first_name . ' ' . $resident->middle_name . ' ' . $resident->last_name }}</span>
                                has successfully rendered
                                <span class="fw-bold text-decoration-underline">{{ $service_hours ?? '8' }}
                                    hours</span> of community service at
                                {{ ucfirst($setting->barangay_name . ', ' . $setting->municipal_name . ', ' . $setting->province_name) }}.
                            @endif
                        </p>

                        <p class="mt-4 text-start fs-5 lh-base">
                            <span class="fw-bold">THAT</span> this certification is issued upon request of the
                            above-named individual for all legal intents and other purposes it may serve.
                        </p>

                        <p class="mt-4 text-start fs-5 lh-base">
                            <span class="fw-bold">ISSUED</span> this
                            <span
                                class="fw-bold">{{ \Carbon\Carbon::parse($request->updated_at)->format('jS') }}</span>
                            day of
                            <span
                                class="fw-bold">{{ \Carbon\Carbon::parse($request->updated_at)->format('F, Y') }}</span>
                            at
                            {{ ucfirst($setting->barangay_name . ', ' . $setting->municipal_name . ', ' . $setting->province_name) }},
                            Philippines.
                        </p>
                    </div>

                    <div class="pt-5 mt-5" style="margin-right: 80px;">
                        <div class="text-end">
                            <h4 class="mb-0 text-uppercase">
                                <strong
                                    class="text-decoration-underline">{{ $capt->first_name . ' ' . $capt->middle_name . ' ' . $capt->last_name }}</strong>
                            </h4>
                            <p class="mt-0 fw-italic">Punong Barangay (Barangay Captain)</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Decorative Footer Border (Red and Gold Lines) -->
            <div class="mt-5 text-center">
                <div
                    style="height: 15px; background: linear-gradient(to right, #e20000 50%, #fff 50%); border-top: 2px solid #ffd700;">
                </div>
            </div>
        @else
            <div class="alert alert-danger">Please check your settings.</div>
        @endif
    </div>

    <script>
        function printDiv() {
            var printContents = document.getElementById("printable").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</div>
