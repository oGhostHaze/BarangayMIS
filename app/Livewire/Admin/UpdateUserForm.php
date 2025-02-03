<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UpdateUserForm extends Component
{
    public $roles = [], $user = [];
    public $userid, $name, $username, $email, $userroles = [];

    public function render()
    {
        return view('livewire.admin.update-user-form');
    }

    public function mount($user_id)
    {
        $this->user = $user = User::find($user_id);
        $this->roles = Role::all();
        $this->userid = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->userroles = $user->getRoleNames();
    }

    public function update() {}
}
