<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Blotter;
use App\Models\CertificateRequest;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->back();
        }

        // Search in residents
        $residents = Resident::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->orWhere('middle_name', 'LIKE', "%{$query}%")
            ->orWhere('contact_no', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('rfid_number', 'LIKE', "%{$query}%")
            ->get();

        // Search in blotter records
        $blotters = Blotter::where('case_number', 'LIKE', "%{$query}%")
            ->orWhere('complainant_name', 'LIKE', "%{$query}%")
            ->orWhere('respondent_name', 'LIKE', "%{$query}%")
            ->orWhere('incident_details', 'LIKE', "%{$query}%")
            ->get();

        // Search in certificate requests
        $certificateRequests = CertificateRequest::whereHas('resident', function ($q) use ($query) {
                $q->where('first_name', 'LIKE', "%{$query}%")
                  ->orWhere('last_name', 'LIKE', "%{$query}%");
            })
            ->orWhere('certificate_type', 'LIKE', "%{$query}%")
            ->orWhere('purpose', 'LIKE', "%{$query}%")
            ->get();

        return view('back.search.results', compact('query', 'residents', 'blotters', 'certificateRequests'));
    }
}