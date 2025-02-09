<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BarangayOfficial;

class BarangayOrgChart extends Component
{
    public $officials = [];

    public function mount()
    {
        $this->officials = BarangayOfficial::where('status', 'A')->orderBy('position')->get();
    }

    public function render()
    {
        return view('livewire.barangay-org-chart')->layout('back.layouts.pages-layout');
    }
}
