<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SystemSetting;

class SystemSettings extends Component
{
    use WithFileUploads;

    public $barangay_name, $municipal_name, $province_name;
    public $provincial_logo, $barangay_logo, $additional_logo;
    public $existingProvincialLogo, $existingBarangayLogo, $existingAdditionalLogo;

    public function mount()
    {
        $settings = SystemSetting::first();

        if ($settings) {
            $this->barangay_name = $settings->barangay_name;
            $this->municipal_name = $settings->municipal_name;
            $this->province_name = $settings->province_name;
            $this->existingProvincialLogo = $settings->provincial_logo;
            $this->existingBarangayLogo = $settings->barangay_logo;
            $this->existingAdditionalLogo = $settings->additional_logo;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'barangay_name' => 'nullable|string|max:255',
            'municipal_name' => 'nullable|string|max:255',
            'province_name' => 'nullable|string|max:255',
            'provincial_logo' => 'nullable|image|max:2048', // Max 2MB
            'barangay_logo' => 'nullable|image|max:2048',
            'additional_logo' => 'nullable|image|max:2048',
        ]);

        $settings = SystemSetting::firstOrNew([]);

        if ($this->provincial_logo) {
            $validatedData['provincial_logo'] = $this->provincial_logo->store('logos', 'public');
        } else {
            $validatedData['provincial_logo'] = $settings->provincial_logo;
        }

        if ($this->barangay_logo) {
            $validatedData['barangay_logo'] = $this->barangay_logo->store('logos', 'public');
        } else {
            $validatedData['barangay_logo'] = $settings->barangay_logo;
        }

        if ($this->additional_logo) {
            $validatedData['additional_logo'] = $this->additional_logo->store('logos', 'public');
        } else {
            $validatedData['additional_logo'] = $settings->additional_logo;
        }

        $settings->fill($validatedData);
        $settings->save();

        session()->flash('message', 'Settings updated successfully!');
    }

    public function render()
    {
        return view('livewire.system-settings');
    }
}