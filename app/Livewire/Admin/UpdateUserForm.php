<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UpdateUserForm extends Component
{
    public $roles = [], $user = [];
    public $userid, $name, $username, $email, $userroles = [];
    public $password, $password_confirmation;


    public function updatedEmail()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->userid,
        ]);
    }

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

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userid,
        ]);

        $user = User::find($this->userid);
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        if ($this->password) {
            $this->validate([
                'password' => 'required|confirmed',
            ]);
            $user->password = Hash::make($this->password);
        }
        $user->save();
        $user->syncRoles($this->userroles);
        session()->flash('message', $user ? 'User has been updated.' : 'User not found.');
    }
}
