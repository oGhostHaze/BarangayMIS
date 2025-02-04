<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SystemSetting;

class CertificateIndigency extends Component
{

    public $name, $age, $civil_status, $date_issued;
    public $setting = [];

    public function mount()
    {
        $this->setting = SystemSetting::first();
        $this->date_issued = now()->format('F d, Y');
    }

    public function render()
    {
        return view('livewire.certificate-indigency');
    }
}