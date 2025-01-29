<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
    public $login_id, $password;
    public $returnUrl;

    public function mount()
    {
        $this->returnUrl = request()->returnUrl;
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }

    public function LoginHandler()
    {
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5',
            ], [
                'login_id.required' => 'Enter your username or email address',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'This email is not registered in the database',
                'password.required' => 'Password is required',
            ]);
        } else {
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5',
            ], [
                'login_id.required' => 'Enter your username or email address',
                'login_id.exists' => 'Username is not registered in the database',
                'password.required' => 'Password is required',
            ]);
        }

        $creds = array($fieldType => $this->login_id, 'password' => $this->password);

        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where($fieldType, $this->login_id)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('auth.login')->with('fail', 'Your account had been blocked!');
            } else {
                if ($this->returnUrl != null) {
                    return redirect()->to($this->returnUrl);
                } else {
                    redirect()->route('auth.home');
                }
            }
        } else {
            return redirect()->route('auth.login')->with('fail', 'Wrong password!');
        }
    }
}
