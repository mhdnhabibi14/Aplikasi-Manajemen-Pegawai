<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }
    public function updateRole(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);

        $userId = $request->user_id;
        $roleId = $request->role_id;

        $user = User::find($userId);
        $user->role_id = $roleId;
        $user->save();

        toast()->success('Role User Berhasil Diubah');
        return redirect()->route('users.index');
    }
}
