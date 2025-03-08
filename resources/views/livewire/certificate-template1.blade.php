<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary" onclick="printDiv()">Print</button>
    </div>

    <div id="printable" class="p-5 mt-3 bg-white border">
        @if ($setting and $capt and $resident)
            <!-- Watermark -->
            <div class="opacity-25 position-absolute top-50 start-50 translate-middle" style="z-index: -1;">
                <img src="{{ asset('images/watermark-logo.png') }}" alt="Watermark" style="width: 60%;">
            </div>

            <div class="text-center">
                <div class="mb-3 row align-items-center">
                    <div class="col-3 d-flex">
                        <img src="{{ asset('storage/' . $setting->provincial_logo) }}" alt="Logo 1"
                            style="width: 50px; height: 50px;">
                    </div>
                    <div class="col-6">
                        <div>
                            <h5 class="mb-0">Republic of the Philippines</h5>
                            <h5 class="mb-0">Province of {{ ucfirst($setting->province_name) }}</h5>
                            <h5 class="mb-0">{{ ucfirst($setting->municipal_name) }}</h5>
                            <h5 class="mb-0">{{ ucfirst($setting->barangay_name) }}</h5>
                            <h6 class="mt-4 fs-3">OFFICE OF THE PUNONG BARANGAY</h6>
                            <h3 class="mt-4 fs-1"><strong
                                    class="text-uppercase">{{ $request->certificate_type }}</strong></h3>
                        </div>
                    </div>
                    <div class="col-3 d-flex">
                        <img class="ms-auto" src="{{ asset('storage/' . $setting->barangay_logo) }}" alt="Logo 2"
                            style="width: 50px; height: 50px; margin: 0 20px;">
                        @if ($setting->additional_logo)
                            <img class="ms-2" src="{{ asset('storage/' . $setting->additional_logo) }}" alt="Logo 3"
                                style="width: 50px; height: 50px;">
                        @endif
                    </div>
                </div>


                <div>
                    <p class="mt-4">To Whom It May Concern:</p>

                    <p>This is to certify that
                        <strong>{{ $resident->first_name . ' ' . $resident->middle_name . ' ' . $resident->last_name }}</strong>,
                        <strong>{{ $resident->age() }}</strong> years of age,
                        <strong>{{ $resident->civil_status }}</strong>, is a bonafide resident of
                        {{ ucfirst($setting->barangay_name . ', ' . $setting->municipal_name) }}.
                    </p>
                    @if (!$request->certificate_type == 'Certificate of Indigency')
                        <p>This further certifies that he/she is known to the undersigned Punong Barangay that he/she
                            belongs to an Indigent Family of this barangay.</p>
                    @elseif($request->certificate_type == 'Certificate of Low Income')
                        <p>This further certifies that he/she is known to the undersigned Punong Barangay that he/she is
                            a/an {{ $resident->source_of_income }} with monthly income of Php
                            {{ number_format($resident->monthly_income, 2) ?? 0.0 }} and belongs to Low Income Family
                            of
                            this barangay.</p>
                    @endif
                    <p>This certification is issued upon the request of the above-mentioned name for whatever legal
                        purpose
                        it may serve.</p>

                    <p class="mt-4">Issued this
                        <strong>{{ \Carbon\Carbon::parse($request->updated_at)->format('jS \d\a\y \of F') }}</strong>
                        at
                        {{ ucfirst($setting->barangay_name . ', ' . $setting->municipal_name . ', ' . $setting->province_name) }},
                        Philippines.
                    </p>

                </div>

                <div class="pt-5 mt-5 text-end">

                    <h3 class="mb-0">
                        <strong>{{ $capt->first_name . ' ' . $capt->middle_name . ' ' . $capt->last_name }}</strong>
                    </h3>
                    <span class="mt-0">Punong Barangay</span>
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
