<?php

namespace App\Livewire;

use App\Models\Blotter;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BlotterDetail extends Component
{
    public $blotter;
    public $id; // Using $id instead of $blotter_id for route model binding

    public function mount($id)
    {
        $this->id = $id;
        $this->loadBlotter();
    }

    public function loadBlotter()
    {
        $this->blotter = Blotter::with('recordedBy')->findOrFail($this->id);

        // Security check for non-admin/non-barangay officials
        if (!Auth::user()->hasRole(['admin', 'barangay_official']) && $this->blotter->recorded_by != Auth::id()) {
            abort(403, 'You do not have permission to view this blotter record.');
        }
    }

    public function render()
    {
        return view('livewire.blotter-detail');
    }
}
