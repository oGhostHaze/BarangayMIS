<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Blotter;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlotterCreate extends Component
{
    public $is_resident = false; // Flag to check if the complainant is a resident
    public $resident_id, $resident_rfid;
    public $case_number, $complainant_name, $complainant_address, $complainant_contact;
    public $respondent_name, $respondent_address, $respondent_contact, $witnesses, $incident_details;
    public $incident_date, $location, $status = 'Pending', $remarks;

    public function mount()
    {
        // Generate unique case number
        $this->case_number = 'CIF-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
    }

    protected function rules()
    {
        return [
            'complainant_name' => 'required|string|max:255',
            'complainant_address' => 'nullable|string|max:255',
            'complainant_contact' => 'nullable|string|max:15',
            'respondent_name' => 'required|string|max:255',
            'respondent_address' => 'nullable|string|max:255',
            'respondent_contact' => 'nullable|string|max:15',
            'witnesses' => 'nullable|string|max:255',
            'incident_details' => 'required|string',
            'incident_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:Pending,Resolved,Dismissed',
            'remarks' => 'nullable|string',
        ];
    }

    public function store()
    {
        if ($this->is_resident) {
            $this->validate([
                'resident_id' => 'required|exists:residents,id',
            ]);
        }

        $this->validate();

        Blotter::create([
            'resident_id' => $this->resident_id ?? null,
            'case_number' => $this->case_number,
            'complainant_name' => $this->complainant_name,
            'complainant_address' => $this->complainant_address,
            'complainant_contact' => $this->complainant_contact,
            'respondent_name' => $this->respondent_name,
            'respondent_address' => $this->respondent_address,
            'respondent_contact' => $this->respondent_contact,
            'witnesses' => $this->witnesses,
            'incident_details' => $this->incident_details,
            'incident_date' => $this->incident_date,
            'location' => $this->location,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'recorded_by' => Auth::id(),
        ]);

        session()->flash('success', 'Blotter record created successfully.');
        return redirect()->route('blotters.index'); // Redirect back to list page
    }

    public function updatedResidentRfid()
    {
        $resident = Resident::where('rfid_number', $this->resident_rfid)->first();
        if ($resident) {
            $this->resident_id = $resident->id;
            $this->respondent_name = $resident->full_name;
            $this->respondent_address = $resident->address;
            $this->respondent_contact = $resident->contact_no;
        } else {
            session()->flash('error', 'Resident not found.');
        }
    }

    public function render()
    {
        return view('livewire.blotter-create');
    }
}
