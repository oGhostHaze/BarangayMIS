<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\BarangayOfficial;
use Livewire\WithPagination;

class BarangayOfficialsManage extends Component
{
    use WithPagination;

    public $official_id, $first_name, $last_name, $middle_name, $position, $status = 'A';
    public $modalTitle = "Add Barangay Official";
    public $isEditMode = false;

    // List of barangay positions
    public $positions = [
        'Punong Barangay (Barangay Captain)',
        'Barangay Kagawad (Councilor)',
        'Sangguniang Kabataan Chairperson',
        'Barangay Secretary',
        'Barangay Treasurer',
        'Barangay Tanod (Peace and Order)',
        'Barangay Health Worker',
        'Barangay Nutrition Scholar',
        'Lupong Tagapamayapa Member',
        'Day Care Worker'
    ];

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'position' => 'required|string|max:255',
        'status' => 'required|in:A,I',
    ];

    public function render()
    {
        $officials = BarangayOfficial::orderBy('status', 'desc')->orderBy('position')->paginate(10);
        return view('livewire.pages.barangay-officials-manage', compact('officials'));
    }


    public function create()
    {
        $this->resetFields();
        $this->modalTitle = "Add Barangay Official";
        $this->isEditMode = false;
    }

    public function edit($id)
    {
        $official = BarangayOfficial::findOrFail($id);
        $this->official_id = $official->id;
        $this->first_name = $official->first_name;
        $this->last_name = $official->last_name;
        $this->middle_name = $official->middle_name;
        $this->position = $official->position;
        $this->status = $official->status;

        $this->modalTitle = "Edit Barangay Official";
        $this->isEditMode = true;
    }

    public function save()
    {
        $this->validate();

        BarangayOfficial::updateOrCreate(
            ['id' => $this->official_id],
            [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'position' => $this->position,
                'status' => $this->status,
            ]
        );

        session()->flash('message', $this->isEditMode ? 'Official updated successfully!' : 'Official added successfully!');

        $this->resetFields();
        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        BarangayOfficial::findOrFail($id)->delete();
        session()->flash('message', 'Official deleted successfully!');
    }

    private function resetFields()
    {
        $this->reset(['official_id', 'first_name', 'last_name', 'middle_name', 'position', 'status']);
    }
}
