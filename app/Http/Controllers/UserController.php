<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function View_User()
    {
        $data = User::all();

        return view('admin.View_User',compact('data'));
    }

    public function activate_user($id)
    {
        $user = User::find($id);

        $user->is_active = true;
        $user->save();

        return redirect()->back();
    }

    public function deactivate_user($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->is_active = false;
        $user->save();

        return redirect()->back()->with('success', 'User account deactivated successfully');
    }



    public function Admin_Tech()
    {
        $data = Technician::all();

        return view('admin.View_Technician',compact('data'));
    }
}

