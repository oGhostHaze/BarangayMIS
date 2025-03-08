<div class="text-center">
    <div class="mb-3 row align-items-center">
        <div class="col-3 d-flex">
            <img src="asd" alt="Logo 1" style="width: 80px; height: 80px;">
        </div>
        <div class="col-6">
            <div>
                <h5 class="mb-0">Republic of the Philippines</h5>
                <h5 class="mb-0">Province of {{ ucfirst($setting->province_name) }}</h5>
                <h5 class="mb-0">{{ ucfirst($setting->municipal_name) }}</h5>
                <h5 class="mb-0">{{ ucfirst($setting->barangay_name) }}</h5>
                <h6 class="mt-4 fs-3">OFFICE OF THE PUNONG BARANGAY</h6>
                <h3 class="mt-4 fs-1"><strong class="text-uppercase">{{ $request->certificate_type }}</strong></h3>
            </div>
        </div>
        <div class="col-3 d-flex">
            <img class="ms-auto" src="{{ asset($setting->provincial_logo) }}" alt="Logo 2"
                style="width: 80px; height: 80px; margin: 0 20px;">
            <img class="ms-2" src="{{ asset($setting->barangay_logo) }}" alt="Logo 3"
                style="width: 80px; height: 80px;">
        </div>
    </div>
</div>
