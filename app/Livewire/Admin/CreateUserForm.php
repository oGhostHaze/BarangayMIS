<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUserForm extends Component
{
    public $userid, $emp_name, $username, $email, $password, $password_confirmation, $userroles = [];

    public function updatedUserid()
    {
        $emp = User::find($this->userid);
        if ($emp) {
            $this->emp_name = $emp->lastname . ', ' . $emp->firstname . ' ' . $emp->middlename;
        }
    }

    public function render()
    {
        $roles = Role::all();

        return view('livewire.admin.create-user-form', compact(
            'roles',
        ));
    }
}