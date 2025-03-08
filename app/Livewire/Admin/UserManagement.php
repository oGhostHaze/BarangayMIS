<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{
    public function render()
    {
        $users = User::paginate(10);

        return view('livewire.admin.user-management', [
            'users' => $users
        ]);
    }
}