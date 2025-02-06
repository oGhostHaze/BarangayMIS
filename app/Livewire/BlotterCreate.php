<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Blotter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlotterCreate extends Component
{
    public $case_number, $complainant_name, $complainant_address, $complainant_contact;
    public $respondent_name, $respondent_address, $respondent_contact, $witnesses, $incident_details;
    public $incident_date, $location, $status = 'Pending', $remarks;

    public function mount()
    {
        // Generate unique case number
        $this->case_number = 'CIF-' . now()->format('Ymd') . '-' . Str::random(5);
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
        $this->validate();

        Blotter::create([
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

    public function render()
    {
        return view('livewire.blotter-create');
    }
}
