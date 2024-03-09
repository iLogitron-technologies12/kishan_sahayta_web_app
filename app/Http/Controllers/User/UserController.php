<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function all_users () {
        $all_users = User::all();

        return view('frontend.users.all_users', ['all_users' => $all_users]);
        // return view('frontend.bottle');

    }

    public function edit_user(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $status = $user->save();

        if ($status) {
            return redirect()->back()->with('success', 'User Details Edited');
        } else {
            return redirect()->back()->with('error', 'Failed to Edit User Details');
        }
    }

    public function delete_user($id)
    {
        $status = User::find($id)->delete();

        if ($status) {
            return redirect()->back()->with('success', 'User Deleted Successfully');
        } else {
            return redirect()->back()->with('success', 'Failed to User');
        }
    }

    public function name() {

        $all_users = User::all();

        return view('frontend.users.name', ['all_users' => $all_users]);
    }
    public function training_partner(){
        
        // $all_users = User::all();

        return view('/frontend/training_partner.profile');
    }


}
