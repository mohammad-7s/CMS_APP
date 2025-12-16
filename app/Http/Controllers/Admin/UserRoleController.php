<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    // Update role
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,editor,user'
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('message', 'User role has been successfully updated.');
    }
}
