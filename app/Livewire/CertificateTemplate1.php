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
    public $officials = [];
    public $secretary = [];
    public $treasurer = [];
    public $sk_chairman = [];

    // Add service hours property for community service certificates
    public $service_hours = 8; // Default to 8 hours

    public function mount($request_id)
    {
        $request = CertificateRequest::find($request_id);
        $this->request = $request;
        $this->capt = $request->capt;
        $this->resident = $request->resident;
        $this->setting = SystemSetting::first();
        $this->date_issued = now()->format('F d, Y');

        // Get all barangay officials for listing in Barangay Clearance
        $this->officials = BarangayOfficial::where('position', 'Barangay Kagawad (Councilor)')
            ->orderBy('last_name')
            ->get();

        // Get specific officials
        $this->secretary = BarangayOfficial::where('position', 'Barangay Secretary')->first();
        $this->treasurer = BarangayOfficial::where('position', 'Barangay Treasurer')->first();
        $this->sk_chairman = BarangayOfficial::where('position', 'Sangguniang Kabataan Chairperson')->first();

        // You can set specific hours from the request if needed
        if ($request->certificate_type == 'Certificate of Community Service' && !empty($request->purpose)) {
            // Extract hours from purpose if it contains hours information
            if (preg_match('/(\d+)\s*hours?/i', $request->purpose, $matches)) {
                $this->service_hours = $matches[1];
            }
        }
    }

    public function render()
    {
        return view('livewire.certificate-template1')->layout('back.layouts.print-layout');
    }
}
