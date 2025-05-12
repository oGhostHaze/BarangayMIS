<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('back.pages.admin.admin_users_list', compact(
            'users',
        ));
    }

    public function create()
    {
        return view('back.pages.admin.admin_users_create');
    }

    public function store(Request $request)
    {
        // Validation Data
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|email|unique:users',
            'username' => 'required|max:100|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ]);

        // Create New Admin
        $admin = new User();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        if ($request->userroles) {
            $admin->assignRole($request->userroles);
        }

        session()->flash('success', 'Admin has been created !!');
        return redirect()->route('auth.admin.users.list');
    }

    public function edit(int $id)
    {
        $user_id = $id;

        return view('back.pages.admin.admin_users_update', compact('user_id'));
    }

    public function update(Request $request, int $id)
    {

        // Create New Admin
        $user = User::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' . $id,
            'username' => 'required|max:100|unique:users,username,' . $id,
            'password' => 'nullable|min:6',
            'password_confirmation' => 'nullable|min:6|same:password',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        session()->flash('success', 'User has been updated !!');
        return back();
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        // Optional: Check if user is not trying to delete themselves
        if (Auth::id() === $user->id) {
            session()->flash('error', 'You cannot delete your own account!');
            return back();
        }

        // Remove roles before deleting
        $user->roles()->detach();

        // Delete the user
        $user->delete();

        session()->flash('success', 'User has been deleted successfully!');
        return redirect()->route('auth.admin.users.list');
    }
}
