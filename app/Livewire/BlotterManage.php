<?php

namespace App\Livewire;

use App\Models\Blotter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class BlotterManage extends Component
{
    use WithPagination;

    public $blotter_id, $case_number, $complainant_name, $complainant_address, $complainant_contact;
    public $respondent_name, $respondent_address, $respondent_contact, $witnesses, $incident_details;
    public $incident_date, $location, $status = 'Pending', $remarks;
    public $updateMode = false;

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

    public function resetFields()
    {
        $this->blotter_id = null;
        $this->case_number = 'CIF-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
        $this->complainant_name = '';
        $this->complainant_address = '';
        $this->complainant_contact = '';
        $this->respondent_name = '';
        $this->respondent_address = '';
        $this->respondent_contact = '';
        $this->witnesses = '';
        $this->incident_details = '';
        $this->incident_date = '';
        $this->location = '';
        $this->status = 'Pending';
        $this->remarks = '';
        $this->updateMode = false;
    }

    public function create()
    {
        $this->resetFields();
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
        $this->dispatch('close-modal');
        $this->resetFields();
    }

    public function edit($id)
    {
        $blotter = Blotter::findOrFail($id);
        $this->fill($blotter->toArray());
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate();

        Blotter::findOrFail($this->blotter_id)->update([
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

        session()->flash('success', 'Blotter record updated successfully.');
        $this->dispatch('close-modal');
        $this->resetFields();
    }

    public function delete($id)
    {
        Blotter::findOrFail($id)->delete();
        session()->flash('success', 'Blotter record deleted successfully.');
    }

    public function render()
    {
        if(Auth::user()->hasRole('barangay_official')) {
            $blotters  = Blotter::latest()->paginate(10);
        } else {
            $blotters  = Blotter::where('recorded_by', Auth::id())->latest()->paginate(10);
        }
        return view('livewire.blotter-manage', [
            'blotters' => $blotters
        ]);
    }
}
