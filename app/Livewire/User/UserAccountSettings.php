<?php

namespace App\Livewire\User;

use App\Traits\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserAccountSettings extends Component
{
    use Toastr;

    // User Properties
    public $username;
    public $email;

    // Password Change
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    // Username Change
    public $new_username;

    // UI State
    public $changePasswordSection = false;
    public $changeUsernameSection = false;

    public function mount()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function rules()
    {
        return [
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'new_password_confirmation' => ['required'],
            'new_username' => ['required', 'string', 'min:5', 'max:25', 'unique:users,username,' . Auth::id()]
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Please enter your current password',
            'current_password.current_password' => 'The current password is incorrect',
            'new_password.required' => 'Please enter a new password',
            'new_password.confirmed' => 'Password confirmation does not match',
            'new_password.min' => 'Password must be at least 8 characters',
            'new_username.required' => 'Username is required',
            'new_username.min' => 'Username must be at least 5 characters',
            'new_username.max' => 'Username cannot exceed 25 characters',
            'new_username.unique' => 'This username is already taken',
        ];
    }

    public function render()
    {
        return view('livewire.user.user-account-settings')
            ->layout('back.layouts.pages-layout');
    }

    /**
     * Toggle UI sections
     */
    public function togglePasswordSection()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->changePasswordSection = !$this->changePasswordSection;

        if ($this->changePasswordSection) {
            $this->changeUsernameSection = false;
        }
    }

    public function toggleUsernameSection()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['new_username']);
        $this->changeUsernameSection = !$this->changeUsernameSection;

        if ($this->changeUsernameSection) {
            $this->changePasswordSection = false;
        }
    }

    /**
     * Update password
     */
    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'new_password_confirmation' => ['required'],
        ]);

        $user = Auth::user();

        // Update the password
        $user->password = Hash::make($this->new_password);
        $user->save();

        // Reset form fields
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->changePasswordSection = false;

        // Show success message
        $this->alert('success', 'Your password has been updated successfully.');
    }

    /**
     * Update username
     */
    public function updateUsername()
    {
        $this->validate([
            'new_username' => ['required', 'string', 'min:5', 'max:25', 'unique:users,username,' . Auth::id()],
            'current_password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();

        // Update the username
        $user->username = $this->new_username;
        $user->save();

        // Update the displayed username
        $this->username = $user->new_username;

        // Reset form fields
        $this->reset(['new_username', 'current_password']);
        $this->changeUsernameSection = false;

        // Show success message
        $this->alert('success', 'Your username has been updated successfully.');
    }
}