<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Resident;

class ResidentShow extends Component
{
    public $resident;

    public function mount($residentId)
    {
        $this->resident = Resident::findOrFail($residentId);
    }

    public function render()
    {
        return view('livewire.pages.resident-show');
    }
}
