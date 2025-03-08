<?php

namespace App\Livewire\Auth;

use App\Traits\Toastr;
use Livewire\Component;
use App\Models\Resident;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResidentSelfRegistration extends Component
{
    use Toastr;

    public $last_name, $first_name, $middle_name, $suffix, $prefix, $contact_no, $sitio, $date_of_birth, $gender, $civil_status,
        $philhealth_id, $sss_id, $gsis_id, $social_pension_id, $is_pwd = false, $pwd_id, $type_of_disability, $illness,
        $is_solo_parent = false, $solo_parent_id, $is_senior_citizen = false, $senior_citizen_id, $educational_attainment,
        $source_of_income, $monthly_income, $income_type, $is_ofw = false, $ofw_country, $ofw_is_domestic_helper = false,
        $ofw_professional = false, $email, $password, $password_confirmation;
    public $currentStep = 1;

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function nextStep()
    {
        // Validate the current step before proceeding
        if ($this->currentStep == 1) {
            $this->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'suffix' => 'nullable|string|max:50',
                'prefix' => 'nullable|string|max:50',
                'contact_no' => 'required|string|max:15|unique:residents,contact_no',
                'date_of_birth' => 'required|date',
                'gender' => 'required|string|in:Male,Female,Other',
                'civil_status' => 'required|string|max:50',
                'sitio' => 'nullable|string|max:255',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'philhealth_id' => 'nullable|string|max:50',
                'sss_id' => 'nullable|string|max:50',
                'gsis_id' => 'nullable|string|max:50',
                'social_pension_id' => 'nullable|string|max:50',
                'is_pwd' => 'boolean',
                'pwd_id' => $this->is_pwd ? 'required|string|max:50' : 'nullable|string|max:50',
                'type_of_disability' => $this->is_pwd ? 'required|string|max:255' : 'nullable|string|max:255',
                'illness' => 'nullable|string|max:255',
                'is_solo_parent' => 'boolean',
                'solo_parent_id' => $this->is_solo_parent ? 'required|string|max:50' : 'nullable|string|max:50',
                'is_senior_citizen' => 'boolean',
                'senior_citizen_id' => $this->is_senior_citizen ? 'required|string|max:50' : 'nullable|string|max:50',
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'educational_attainment' => 'nullable|string|max:255',
                'source_of_income' => 'nullable|string|max:255',
                'monthly_income' => 'nullable|numeric|min:0|max:9999999.99',
                'income_type' => 'nullable|in:Regular,Irregular',
                'is_ofw' => 'boolean',
                'ofw_country' => $this->is_ofw ? 'required|string|max:255' : 'nullable|string|max:255',
                'ofw_is_domestic_helper' => 'boolean',
                'ofw_professional' => 'boolean',
            ]);
        }

        $this->currentStep = min(4, $this->currentStep + 1);
    }

    public function previousStep()
    {
        $this->currentStep = max(1, $this->currentStep - 1);
    }

    public function getProgressPercentageProperty()
    {
        return ($this->currentStep / 4) * 100;
    }
    public function rules()
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'prefix' => 'nullable|string|max:50',
            'contact_no' => 'required|string|max:15|unique:residents,contact_no',
            'sitio' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:Male,Female,Other',
            'civil_status' => 'required|string|max:50',
            'philhealth_id' => 'nullable|string|max:50',
            'sss_id' => 'nullable|string|max:50',
            'gsis_id' => 'nullable|string|max:50',
            'social_pension_id' => 'nullable|string|max:50',
            'is_pwd' => 'boolean',
            'pwd_id' => 'nullable|string|max:50',
            'type_of_disability' => 'nullable|string|max:255',
            'illness' => 'nullable|string|max:255',
            'is_solo_parent' => 'boolean',
            'solo_parent_id' => 'nullable|string|max:50',
            'is_senior_citizen' => 'boolean',
            'senior_citizen_id' => 'nullable|string|max:50',
            'educational_attainment' => 'nullable|string|max:255',
            'source_of_income' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|numeric|min:0|max:9999999.99',
            'income_type' => 'nullable|in:Regular,Irregular',
            'is_ofw' => 'boolean',
            'ofw_country' => 'nullable|string|max:255',
            'ofw_is_domestic_helper' => 'boolean',
            'ofw_professional' => 'boolean',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.auth.resident-self-registration')
            ->layout('back.layouts.auth-layout');
    }

    public function register()
    {
        $validatedData = $this->validate();

        // Create the user account first
        $user = User::create([
            'name' => $validatedData['first_name'] . ' ' .
                     ($validatedData['middle_name'] ? $validatedData['middle_name'] . ' ' : '') .
                     $validatedData['last_name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['contact_no'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Assign the resident role
        $user->assignRole('resident');

        // Remove password fields from the resident data
        unset($validatedData['password']);
        unset($validatedData['password_confirmation']);

        // Create the resident profile and link to user
        $resident = new Resident($validatedData);
        $resident->user_id = $user->id;
        $resident->save();

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard
        return redirect()->route('auth.dashboard');
    }
}