<?php

namespace App\Livewire\Pages;

use App\Models\Blotter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BlotterEditResident extends Component
{
    public $id; // Using $id instead of $blotter_id for route model binding
    public $case_number, $complainant_name, $complainant_address, $complainant_contact;
    public $respondent_name, $respondent_address, $respondent_contact, $witnesses, $incident_details;
    public $incident_date, $location, $status, $remarks;

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

    public function mount($id)
    {
        $this->id = $id;
        $blotter = Blotter::findOrFail($id);

        // Security check - ensure the resident can only edit their own blotters
        if ($blotter->recorded_by != Auth::id()) {
            abort(403, 'You do not have permission to edit this blotter record.');
        }

        $this->fill($blotter->toArray());
    }

    public function save()
    {
        $this->validate();

        // Note: We maintain the existing status as residents shouldn't be able to change it
        $existingBlotter = Blotter::findOrFail($this->id);
        $existingStatus = $existingBlotter->status;

        Blotter::findOrFail($this->id)->update([
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
            'status' => $existingStatus, // Keep the existing status
            'remarks' => $this->remarks,
            'recorded_by' => Auth::id(),
        ]);

        session()->flash('success', 'Blotter record updated successfully.');
        return redirect()->route('resident.blotters.show', $this->id);
    }

    public function render()
    {
        return view('livewire.pages.blotter-edit-resident')
            ->layout('back.layouts.pages-layout', [
                'title' => 'Edit Blotter - Case #' . $this->case_number
            ]);
    }
}
