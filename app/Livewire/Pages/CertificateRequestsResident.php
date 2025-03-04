<?php

namespace App\Livewire\Pages;

use App\Models\CertificateRequest;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CertificateRequestsResident extends Component
{
    use WithPagination;

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
        $this->resident_id = Auth::user()->resident->id;
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

    public function render()
    {
        $requests = CertificateRequest::where('resident_id', Auth::user()->resident->id)->paginate(10);
        return view('livewire.pages.certificate-requests-resident', [
            'requests' => $requests,
        ])->layout('back.layouts.pages-layout');
    }
}
