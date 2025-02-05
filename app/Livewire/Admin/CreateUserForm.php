<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUserForm extends Component
{
    public $emp_name, $username, $email, $password, $password_confirmation, $userroles = [];


    public function render()
    {
        $roles = Role::all();

        return view('livewire.admin.create-user-form', compact(
            'roles',
        ));
    }
}