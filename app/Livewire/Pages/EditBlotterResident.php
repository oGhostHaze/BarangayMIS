<?php

namespace App\Livewire\Pages;

use App\Models\Blotter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditBlotterResident extends Component
{
    public $blotter_id, $case_number, $complainant_name, $complainant_address, $complainant_contact;
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
        // Find the blotter record
        $blotter = Blotter::findOrFail($id);

        // Check if the logged-in user is the one who recorded this blotter
        if ($blotter->recorded_by !== Auth::id()) {
            session()->flash('error', 'You are not authorized to edit this blotter record.');
            return redirect()->route('auth.blotter.resident');
        }

        // Fill the properties with the blotter data
        $this->fill($blotter->toArray());

        // Format the date for the input field
        if ($this->incident_date) {
            $this->incident_date = date('Y-m-d', strtotime($this->incident_date));
        }
    }

    public function update()
    {
        $this->validate();

        // Find the blotter and check authorization again
        $blotter = Blotter::findOrFail($this->blotter_id);

        if ($blotter->recorded_by !== Auth::id()) {
            session()->flash('error', 'You are not authorized to edit this blotter record.');
            return redirect()->route('auth.blotter.resident');
        }

        $blotter->update([
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
        ]);

        session()->flash('success', 'Blotter record updated successfully.');

        // Redirect back to the blotter list
        return redirect()->route('auth.blotter.resident');
    }

    public function render()
    {
        return view('livewire.pages.edit-blotter-resident')
            ->layout('back.layouts.pages-layout');
    }
}