<?php

namespace App\Livewire;

use App\Models\BarangayOfficial;
use Livewire\Component;
use App\Models\SystemSetting;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Auth;

class CertificateTemplate1 extends Component
{

    public $date_issued;
    public $resident = [];
    public $request = [];
    public $setting = [];
    public $capt = [];

    public function mount($request_id)
    {
        $request = CertificateRequest::find($request_id);
        $this->request = $request;
        $this->capt = $request->capt;
        $this->resident = $request->resident;
        $this->setting = SystemSetting::first();
        $this->date_issued = now()->format('F d, Y');
    }

    public function render()
    {
        return view('livewire.certificate-template1')->layout('back.layouts.print-layout');
    }
}