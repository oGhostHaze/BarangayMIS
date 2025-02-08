<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Resident;
use App\Models\BarangayOfficial;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Auth;

class CertificateRequestPage extends Component
{
    public $residents;
    public $resident_id;
    public $certificate_type;
    public $purpose;
    public $status = 'Pending';
    public $request_id;

    protected $rules = [
        'resident_id' => 'required|exists:residents,id',
        'certificate_type' => 'required|string',
        'purpose' => 'nullable|string',
    ];

    public function mount()
    {
        $this->residents = Resident::orderBy('last_name')->get();
    }

    public function saveRequest()
    {
        $this->validate();

        CertificateRequest::updateOrCreate(
            ['id' => $this->request_id],
            [
                'resident_id' => $this->resident_id,
                'certificate_type' => $this->certificate_type,
                'purpose' => $this->purpose,
                'status' => $this->status,
                'requested_at' => now(),
                'processed_by' => Auth::id(),
            ]
        );

        session()->flash('message', $this->request_id ? 'Request updated successfully!' : 'Request submitted successfully!');

        $this->resetFields();
    }

    public function editRequest($id)
    {
        $request = CertificateRequest::findOrFail($id);
        $this->request_id = $request->id;
        $this->resident_id = $request->resident_id;
        $this->certificate_type = $request->certificate_type;
        $this->purpose = $request->purpose;
        $this->status = $request->status;
    }

    public function deleteRequest($id)
    {
        CertificateRequest::findOrFail($id)->delete();
        session()->flash('message', 'Request deleted successfully!');
    }

    public function resetFields()
    {
        $this->resident_id = null;
        $this->certificate_type = null;
        $this->purpose = null;
        $this->request_id = null;
    }

    public function issueRequest($request_id)
    {
        $this->redirect(route('auth.certs.temp1', $request_id));
    }

    public function render()
    {
        return view('livewire.pages.certificate-request-page', [
            'requests' => CertificateRequest::latest()->get(),
        ]);
    }

    public function processRequest($id, $newStatus)
    {
        $request = CertificateRequest::findOrFail($id);
        if($newStatus == 'Approved') {
            $capt = BarangayOfficial::where('position','LIKE', '%Punong Barangay%')->where('status', 'A')->first();
            $request->update([
                'barangay_official_id' => $capt->id,
                'status' => $newStatus,
                'approved_at' => now(),
                'processed_by' => Auth::id(),
            ]);
        } else {
            $request->update([
                'status' => $newStatus,
                'released_at' => now(),
                'processed_by' => Auth::id(),
            ]);
        }

        session()->flash('message', 'Request updated successfully.');
    }
}