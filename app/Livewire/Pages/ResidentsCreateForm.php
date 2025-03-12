<?php

namespace App\Livewire\Pages;

use App\Traits\Toastr;
use Livewire\Component;
use App\Models\Resident;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads; // Add this for file uploads

class ResidentsCreateForm extends Component
{
    use Toastr;
    use WithFileUploads; // Use Livewire's file upload trait

    public $last_name, $first_name, $middle_name, $suffix, $prefix, $contact_no, $sitio, $date_of_birth, $gender, $civil_status,
        $philhealth_id, $sss_id, $gsis_id, $social_pension_id, $is_pwd = false, $pwd_id, $type_of_disability, $illness,
        $is_solo_parent = false, $solo_parent_id, $is_senior_citizen = false, $senior_citizen_id, $educational_attainment,
        $source_of_income, $monthly_income, $income_type, $is_ofw = false, $ofw_country, $ofw_is_domestic_helper = false,
        $ofw_professional = false, $email, $rfid_number;
    public $resident_id;

    // Add new properties for valid ID
    public $valid_id, $valid_id_type, $existing_valid_id_path;

    public function rules()
    {
        $rules = [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'prefix' => 'nullable|string|max:50',
            'contact_no' => 'nullable|string|max:15',
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
            'email' => 'nullable|email',
            'rfid_number' => 'nullable|string|max:50',
            'valid_id_type' => 'nullable|string|max:50',
        ];

        // Make valid_id required for new records, but optional for updates
        if (!$this->resident_id) {
            $rules['valid_id'] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048';
        } else {
            $rules['valid_id'] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048';
        }

        return $rules;
    }

    public function render()
    {
        return view('livewire.pages.residents-create-form');
    }

    public function mount($resident_id = null)
    {
        if ($resident_id) {
            $this->edit($resident_id);
        }
    }

    public function create()
    {
        $this->resetFields();
    }

    public function store()
    {
        $validatedData = $this->validateFields();

        // Handle the ID upload
        if ($this->valid_id) {
            $validatedData['valid_id_path'] = $this->valid_id->store('valid-ids', 'public');
        }

        // Remove the file upload object from the data array
        unset($validatedData['valid_id']);

        $resident = Resident::create($validatedData);

        if ($resident->email) {
            $user = User::create([
                'name' => $resident->first_name . ' ' . $resident->middle_name . ' ' . $resident->last_name,
                'email' => $resident->email,
                'username' => $resident->contact_no,
                'password' => Hash::make(Carbon::parse($resident->date_of_birth)->format('mdY')),
            ]);
            $user->assignRole('resident');
            $resident->user_id = $user->id;
            $resident->save();
        }

        $this->resetFields();
        $this->alert('success', 'New resident has been added.');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        $this->fill($resident->toArray());
        $this->resident_id = $resident->id;
        $this->is_pwd = $resident->is_pwd ? true : false;
        $this->is_ofw = $resident->is_ofw ? true : false;
        $this->is_senior_citizen = $resident->is_senior_citizen ? true : false;
        $this->is_solo_parent = $resident->is_solo_parent ? true : false;
        $this->ofw_is_domestic_helper = $resident->ofw_is_domestic_helper ? true : false;
        $this->ofw_professional = $resident->ofw_professional ? true : false;

        // Store the existing valid ID path
        $this->existing_valid_id_path = $resident->valid_id_path;
        $this->valid_id_type = $resident->valid_id_type;
    }

    public function update()
    {
        $validatedData = $this->validateFields();

        // Handle the ID upload for updates
        if ($this->valid_id) {
            $validatedData['valid_id_path'] = $this->valid_id->store('valid-ids', 'public');
        } else {
            // Keep the existing path if no new file is uploaded
            $validatedData['valid_id_path'] = $this->existing_valid_id_path;
        }

        // Remove the file upload object from the data array
        unset($validatedData['valid_id']);

        Resident::findOrFail($this->resident_id)->update($validatedData);
        $this->alert('success', 'Resident information has been updated.');
        $this->resetFields();
    }

    public function delete($id)
    {
        Resident::findOrFail($id)->delete();
        $this->alert('info', 'Selected resident has been deleted.');
    }

    private function resetFields()
    {
        $this->resident_id = null;
        $this->existing_valid_id_path = null;
        $this->valid_id = null;
        $this->fill(array_fill_keys(array_keys($this->validateFields()), null));
    }

    private function validateFields()
    {
        return $this->validate($this->rules());
    }
}
