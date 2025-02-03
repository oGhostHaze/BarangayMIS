<div class="container mt-4">
    <div class="shadow-sm card">
        <div class="card-body">
            <div class="mb-4 text-center">
                <img src="{{ url('/back/dist/img/authors/male-placeholder.png') }}" alt="Profile Picture"
                    class="border rounded-circle" width="120">
                <h4 class="mt-2">{{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}
                    {{ $resident->suffix }}</h4>
                <p class="text-muted">{{ $resident->civil_status }} | {{ $resident->gender }}</p>
            </div>

            <hr>

            <!-- Personal Information -->
            <h5 class="text-primary"><i class="fas fa-user"></i> Personal Information</h5>
            <div class="row">
                <div class="col-sm-6"><strong>Full Name:</strong> {{ $resident->prefix }} {{ $resident->first_name }}
                    {{ $resident->middle_name }} {{ $resident->last_name }} {{ $resident->suffix }}</div>
                <div class="col-sm-6"><strong>Date of Birth:</strong> {{ $resident->date_of_birth }}</div>
                <div class="col-sm-6"><strong>Gender:</strong> {{ $resident->gender }}</div>
                <div class="col-sm-6"><strong>Civil Status:</strong> {{ $resident->civil_status }}</div>
            </div>

            <hr>

            <!-- Contact Information -->
            <h5 class="text-primary"><i class="fas fa-phone"></i> Contact Information</h5>
            <div class="row">
                <div class="col-sm-6"><strong>Contact No.:</strong> {{ $resident->contact_no ?? 'N/A' }}</div>
                <div class="col-sm-6"><strong>Address (Sitio):</strong> {{ $resident->sitio ?? 'N/A' }}</div>
            </div>

            <hr>

            <!-- Health & Identification -->
            <h5 class="text-primary"><i class="fas fa-id-card"></i> Identification & Health</h5>
            <div class="row">
                <div class="col-sm-6"><strong>PhilHealth ID:</strong> {{ $resident->philhealth_id ?? 'N/A' }}</div>
                <div class="col-sm-6"><strong>SSS ID:</strong> {{ $resident->sss_id ?? 'N/A' }}</div>
                <div class="col-sm-6"><strong>GSIS ID:</strong> {{ $resident->gsis_id ?? 'N/A' }}</div>
                <div class="col-sm-6"><strong>Senior Citizen:</strong>
                    {{ $resident->is_senior_citizen ? 'Yes' : 'No' }}</div>
                <div class="col-sm-6"><strong>Person with Disability (PWD):</strong>
                    {{ $resident->is_pwd ? 'Yes' : 'No' }}</div>
                <div class="col-sm-6"><strong>Type of Disability:</strong> {{ $resident->type_of_disability ?? 'N/A' }}
                </div>
                <div class="col-sm-6"><strong>Illness:</strong> {{ $resident->illness ?? 'N/A' }}</div>
            </div>

            <hr>

            <!-- Employment & Income -->
            <h5 class="text-primary"><i class="fas fa-briefcase"></i> Employment & Income</h5>
            <div class="row">
                <div class="col-sm-6"><strong>Educational Attainment:</strong>
                    {{ $resident->educational_attainment ?? 'N/A' }}</div>
                <div class="col-sm-6"><strong>Source of Income:</strong> {{ $resident->source_of_income ?? 'N/A' }}
                </div>
                <div class="col-sm-6"><strong>Monthly Income:</strong>
                    ₱{{ number_format($resident->monthly_income, 2) }}</div>
                <div class="col-sm-6"><strong>Income Type:</strong> {{ $resident->income_type ?? 'N/A' }}</div>
                <div class="col-sm-6"><strong>OFW:</strong> {{ $resident->is_ofw ? 'Yes' : 'No' }}</div>
                <div class="col-sm-6"><strong>OFW Country:</strong> {{ $resident->ofw_country ?? 'N/A' }}</div>
                <div class="col-sm-6"><strong>Domestic Helper:</strong>
                    {{ $resident->ofw_is_domestic_helper ? 'Yes' : 'No' }}</div>
                <div class="col-sm-6"><strong>Professional:</strong> {{ $resident->ofw_professional ? 'Yes' : 'No' }}
                </div>
            </div>
        </div>
    </div>
</div>
