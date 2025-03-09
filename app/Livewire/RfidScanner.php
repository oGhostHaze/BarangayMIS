<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resident;
use Illuminate\Support\Facades\Route;

class RfidScanner extends Component
{
    public $rfidInput = '';
    protected $listeners = ['rfidScanned' => 'handleRfidScanned'];

    public function mount()
    {
        // Auto-focus the input when the component mounts, but don't force it
        $this->dispatch('focusRfidInput');
    }

    public function focusInput()
    {
        // Triggered when user manually clicks the RFID icon or presses Alt+R
        $this->dispatch('focusRfidInput');
    }

    public function updated($property)
    {
        if ($property === 'rfidInput' && !empty($this->rfidInput)) {
            $this->handleRfidScanned($this->rfidInput);
            $this->rfidInput = ''; // Clear the input for the next scan
        }
    }

    public function handleRfidScanned($rfidNumber)
    {
        // Find resident with the scanned RFID
        $resident = Resident::where('rfid_number', $rfidNumber)->first();

        if ($resident) {
            return redirect()->route('admin.residents.rfid-details', $resident->id);
        } else {
            // Flash a message that the RFID is not registered
            session()->flash('rfid-error', 'RFID not registered to any resident');

            // Emit an event to show a toast notification
            $this->dispatch('showToastr', [
                'type' => 'error',
                'message' => 'RFID not registered to any resident'
            ]);

            // Re-focus the input
            $this->dispatch('focusRfidInput');
        }
    }

    public function render()
    {
        return view('livewire.rfid-scanner');
    }
}
