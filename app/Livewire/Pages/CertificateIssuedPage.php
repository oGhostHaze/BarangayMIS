<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CertificateRequest;

class CertificateIssuedPage extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.pages.certificate-issued-page', [
            'issuedRequests' => CertificateRequest::whereIn('status', ['Approved', 'Released'])
                ->orderByDesc('released_at')
                ->paginate(5),
        ]);
    }
}