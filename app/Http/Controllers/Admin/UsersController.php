<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    //
    public function users()
    {
        $users = User::role('user')->latest()->paginate();

        return view('admin.users.index')->with(compact('users'));
    }

    public function addUserForm()
    {
        return view(('admin.users.add'));
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'fullname' => 'required|max:100|string',
            'email' => 'email|required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('user');

        return redirect(route('users'))->with('success', 'User Added successfully');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.users.edit')->with(compact('user'));
    }

    public function updateUser(Request $request, $id)
    {

        $request->validate([
            'fullname' => 'required|max:100|string',
            'email' => 'email|required',
            'email' => Rule::unique('users')->ignore($id),
            'confirm_password' => 'same:password',
        ]);

        $user = User::find($id);
        $user->name = $request->get('fullname');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('users'))->with('success', 'User details updated successfully');
    }

    public function searchUser(Request $request)
    {
        $query = User::query();
        if (isset($request->q)) {
            $query->Where('name', 'like', '%' . $request->get('q') . '%')->orWhere('email', 'like', '%' . $request->get('q') . '%')->role('user')->get();
        }
        $users = $query->role('user')->paginate();
        return view('admin.users.index')->with(compact('users'));
    }

    public function changeStatus($id)
    {
        $user = User::where('id', $id)->first();


        if ($user->status == 'active') {
            $user->status = 'in_active';
        } else {
            $user->status = 'active';
        }

        $user->save();

        return redirect()->back()->with('success', 'Status changed successfully');
    }
}
