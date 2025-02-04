<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h2>Certificate of Indigency</h2>
        <button class="btn btn-primary" onclick="printDiv()">Print</button>
    </div>

    <div id="printable" class="p-5 border bg-white mt-3">
        <!-- Watermark -->
        <div class="position-absolute top-50 start-50 translate-middle opacity-25" style="z-index: -1;">
            <img src="{{ asset('images/watermark-logo.png') }}" alt="Watermark" style="width: 60%;">
        </div>

        <div class="text-center">
            <div class="row align-items-center mb-3">
                <div class="col-3 d-flex">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo 1" style="width: 80px; height: 80px;">
                </div>
                <div class="col-6">
                    <div>
                        <h5 class="mb-0">Republic of the Philippines</h5>
                        <h5 class="mb-0">Province of {{ ucfirst($setting->province_name) }}</h5>
                        <h5 class="mb-0">{{ ucfirst($setting->municipal_name) }}</h5>
                        <h5 class="mb-0">{{ ucfirst($setting->barangay_name) }}</h5>
                        <h6 class="mt-4 fs-3">OFFICE OF THE PUNONG BARANGAY</h6>
                        <h3 class="mt-4 fs-1"><strong>CERTIFICATION</strong></h3>
                    </div>
                </div>
                <div class="col-3 d-flex">
                    <img class="ms-auto" src="{{ asset('images/logo2.png') }}" alt="Logo 2" style="width: 80px; height: 80px; margin: 0 20px;">
                    <img class="ms-2" src="{{ asset('images/logo3.png') }}" alt="Logo 3" style="width: 80px; height: 80px;">
                </div>
            </div>
        </div>

        <p class="mt-4">To Whom It May Concern:</p>

        <p>This is to certify that <strong>______________________</strong>,
            <strong>_____</strong> years of age, <strong>single/married</strong>, is a bonafide resident of {{ ucfirst($setting->barangay_name. ', '.$setting->municipal_name ) }}.</p>

        <p>This further certifies that he/she is known to the undersigned Punong Barangay that he/she belongs to an Indigent Family of this barangay.</p>

        <p>This certification is issued upon the request of the above-mentioned name for whatever legal purpose it may serve.</p>

        <p class="mt-4">Issued this <strong>_____</strong> day of <strong>_________________</strong> at {{ ucfirst($setting->barangay_name. ', '.$setting->municipal_name.', '. $setting->province_name ) }}, Philippines.</p>

        <div class="text-end mt-5 pt-5">

            <h5><strong>JOVITO S. SABLAY</strong></h5>
            <p>Punong Barangay</p>
        </div>
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
