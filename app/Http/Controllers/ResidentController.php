<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    /**
     * Display resident details after RFID scan
     */
    public function rfidDetails(Resident $resident)
    {
        return view('back.residents.rfid-details', compact('resident'));
    }

    /**
     * Show form for assigning RFID to a resident
     */
    public function assignRfidForm(Resident $resident)
    {
        return view('back.residents.assign-rfid', compact('resident'));
    }

    /**
     * Process the RFID assignment
     */
    public function assignRfid(Request $request, Resident $resident)
    {
        $request->validate([
            'rfid_number' => 'required|string|unique:residents,rfid_number,' . $resident->id,
        ]);

        $resident->update([
            'rfid_number' => $request->rfid_number
        ]);

        return redirect()->route('auth.residents.index')
            ->with('success', 'RFID successfully assigned to resident.');
    }
}