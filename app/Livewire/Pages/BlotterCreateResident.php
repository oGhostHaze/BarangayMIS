<?php

namespace App\Livewire\Pages;

use App\Models\Blotter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class BlotterCreateResident extends Component
{
    public $case_number, $complainant_name, $complainant_address, $complainant_contact;
    public $respondent_name, $respondent_address, $respondent_contact, $witnesses, $incident_details;
    public $incident_date, $location, $status = 'Pending', $remarks;

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

    public function mount()
    {
        // Generate unique case number
        $this->case_number = 'CIF-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));

        // Pre-fill complainant info from resident data
        $resident = Auth::user()->resident;
        $this->complainant_name = $resident->last_name . ', ' . $resident->first_name . ' ' . $resident->middle_name;
        $this->complainant_address = $resident->sitio;
        $this->complainant_contact = $resident->contact_no;
    }

    public function store()
    {
        $this->validate();

        $blotter = Blotter::create([
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
        return redirect()->route('resident.blotters.show', $blotter->id);
    }

    public function render()
    {
        return view('livewire.pages.blotter-create-resident')
            ->layout('back.layouts.pages-layout', [
                'title' => 'Create New Blotter Record'
            ]);
    }
}
