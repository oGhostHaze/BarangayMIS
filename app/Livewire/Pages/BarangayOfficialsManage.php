<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\BarangayOfficial;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class BarangayOfficialsManage extends Component
{
    use WithPagination, WithFileUploads;

    public $official_id, $first_name, $last_name, $middle_name, $position, $status = 'A';
    public $photo, $current_photo;
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
        'photo' => 'nullable|image|max:1024', // Max 1MB
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
        $this->current_photo = $official->photo;

        $this->modalTitle = "Edit Barangay Official";
        $this->isEditMode = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'position' => $this->position,
            'status' => $this->status,
        ];

        // Handle photo upload
        if ($this->photo) {
            // Remove old photo if exists and not default
            if ($this->isEditMode && $this->current_photo && !str_contains($this->current_photo, 'default-avatar.png')) {
                Storage::disk('public')->delete($this->current_photo);
            }

            $photoPath = $this->photo->store('officials_photos', 'public');
            $data['photo'] = $photoPath;
        }

        BarangayOfficial::updateOrCreate(
            ['id' => $this->official_id],
            $data
        );

        session()->flash('message', $this->isEditMode ? 'Official updated successfully!' : 'Official added successfully!');

        $this->resetFields();
        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        $official = BarangayOfficial::findOrFail($id);

        // Delete photo if it exists and is not the default
        if ($official->photo && !str_contains($official->photo, 'default-avatar.png')) {
            Storage::disk('public')->delete($official->photo);
        }

        $official->delete();
        session()->flash('message', 'Official deleted successfully!');
    }

    private function resetFields()
    {
        $this->reset(['official_id', 'first_name', 'last_name', 'middle_name', 'position', 'status', 'photo', 'current_photo']);
    }
}
