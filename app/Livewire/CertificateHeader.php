<?php

namespace App\Livewire;

use App\Models\CertificateRequest;
use Livewire\Component;
use App\Models\SystemSetting;

class CertificateHeader extends Component
{
    public $setting = [];
    public $request = null;

    public function mount(CertificateRequest $request)
    {
        $this->request = $request;
        $this->setting = SystemSetting::first();
    }

    public function render()
    {
        return view('livewire.certificate-header');
    }
}