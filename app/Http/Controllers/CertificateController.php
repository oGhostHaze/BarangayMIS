<?php

namespace App\Http\Controllers;

use App\Models\CertificateRequest;

class CertificateController extends Controller
{
    public function template1($request_id)
    {
        $request = CertificateRequest::find($request_id);
        return view( 'back.pages.certificate-layouts.certificate-1', ['request_id' => $request_id, 'request' => $request] );
    }
}