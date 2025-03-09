<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resident;
use App\Models\Blotter;
use App\Models\CertificateRequest;

class ResidentDetails extends Component
{
    public Resident $resident;
    public $activeTab = 'profile';
    public $certificateRequests = [];
    public $blotterCases = [];

    public function mount(Resident $resident)
    {
        $this->resident = $resident;
        $this->loadCertificateRequests();
        $this->loadBlotterCases();
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    private function loadCertificateRequests()
    {
        $this->certificateRequests = $this->resident->certificateRequests()->latest()->get();
    }

    private function loadBlotterCases()
    {
        $fullName = $this->resident->first_name . ' ' . $this->resident->last_name;

        $this->blotterCases = Blotter::where('complainant_name', 'LIKE', "%{$fullName}%")
            ->orWhere('respondent_name', 'LIKE', "%{$fullName}%")
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.resident-details');
    }
}
