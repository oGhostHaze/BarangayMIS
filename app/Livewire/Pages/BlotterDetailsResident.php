<?php

namespace App\Livewire\Pages;

use App\Models\Blotter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BlotterDetailsResident extends Component
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
        $blotter = Blotter::with('recordedBy')->findOrFail($this->id);

        // Security check - ensure the resident can only view their own blotters
        if ($blotter->recorded_by != Auth::id()) {
            abort(403, 'You do not have permission to view this blotter record.');
        }

        $this->blotter = $blotter;
    }

    public function render()
    {
        return view('livewire.pages.blotter-details-resident')
            ->layout('back.layouts.pages-layout', [
                'title' => 'Blotter Details - Case #' . $this->blotter->case_number
            ]);
    }
}
