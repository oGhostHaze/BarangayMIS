<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Resident;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Traits\Toastr;

class ResidentShow extends Component
{
    use Toastr;

    public $resident;

    public function mount($residentId)
    {
        $this->resident = Resident::findOrFail($residentId);
    }

    public function render()
    {
        return view('livewire.pages.resident-show');
    }

    /**
     * Show the approval confirmation modal
     */
    public function confirmApproval()
    {
        $this->dispatch('show-approve-modal');
    }

    /**
     * Approve the resident and create a user account if email is available
     */
    public function approveResident()
    {
        // Only process if resident is not already approved
        if ($this->resident->user_id) {
            $this->alert('info', 'This resident is already approved.');
            $this->dispatch('close-approve-modal');
            return;
        }

        // Check if email is provided to create a user account
        if ($this->resident->email) {
            // Check if user with this email already exists
            $existingUser = User::where('email', $this->resident->email)->first();

            if ($existingUser) {
                // Link existing user to this resident
                $this->resident->user_id = $existingUser->id;
                $this->resident->save();
                $this->alert('success', 'Resident approved and linked to existing user account.');
            } else {
                // Create new user account
                $user = User::create([
                    'name' => $this->resident->first_name . ' ' . $this->resident->last_name,
                    'email' => $this->resident->email,
                    'username' => $this->resident->contact_no ?? strtolower(str_replace(' ', '.', $this->resident->first_name . '.' . $this->resident->last_name)),
                    'password' => Hash::make(Carbon::parse($this->resident->date_of_birth)->format('mdY')),
                ]);

                // Assign resident role to user
                $user->assignRole('resident');

                // Update resident with user_id
                $this->resident->user_id = $user->id;
                $this->resident->save();

                $this->alert('success', 'Resident approved and user account created successfully.');
            }
        } else {
            $this->alert('warning', 'Resident approved, but no user account created due to missing email address.');
        }

        // Refresh resident data
        $this->resident = Resident::findOrFail($this->resident->id);

        $this->dispatch('close-approve-modal');
    }
}
