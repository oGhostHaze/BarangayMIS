<div>
    <p class="mt-4">To Whom It May Concern:</p>

    <p>This is to certify that <strong>{{ $resident->first_name . ' ' . $resident->middle_name . ' ' . $resident->last_name }}</strong>,
        <strong>{{ $resident->age() }}</strong> years of age, <strong>{{ $resident->civil_status }}</strong>, is a bonafide resident of {{ ucfirst($setting->barangay_name. ', '.$setting->municipal_name ) }}.</p>

    <p>This further certifies that he/she is known to the undersigned Punong Barangay that he/she belongs to an Indigent Family of this barangay.</p>

    <p>This certification is issued upon the request of the above-mentioned name for whatever legal purpose it may serve.</p>

    <p class="mt-4">Issued this <strong>_____</strong> day of <strong>_________________</strong> at {{ ucfirst($setting->barangay_name. ', '.$setting->municipal_name.', '. $setting->province_name ) }}, Philippines.</p>

</div>
