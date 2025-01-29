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
            'employeeid' => 'required',
            'department_id' => 'required|exists:department_sections,id',
            'email' => 'required|max:100|email|unique:users',
            'username' => 'required|max:100|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ]);

        // Create New Admin
        $admin = new User();
        $admin->name = $request->name;
        $admin->department_section_id = $request->department_id;
        $admin->employeeid = $request->employeeid;
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
            'employeeid' => 'required|max:100|unique:users,employeeid,' . $id,
            'username' => 'required|max:100|unique:users,username,' . $id,
            'department_id' => 'required|exists:department_sections,id',
            'password' => 'nullable|min:6',
            'password_confirmation' => 'nullable|min:6|same:password',
        ]);

        $user->name = $request->name;
        $user->department_section_id = $request->department_id;
        $user->employeeid = $request->employeeid;
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
}
