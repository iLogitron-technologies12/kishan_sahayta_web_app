<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login_page()
    {
        $captcha_text = Str::random(6);
        session(['captcha_text' => $captcha_text]);
        return view('login.login', compact('captcha_text'));
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
                'captcha' => 'required|in:' . session('captcha_text'),
            ],
            [
                'captcha.in' => 'Invalid captcha.',
            ]
        );
        // dd($request->all());

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $role = optional(Auth::user())->Role();
            // dd($role);

            //     return redirect()->intended('/officer/applications');


            if ($role == 'super_admin') {
                return redirect()->intended('/superadmin/create-agri-experts');
            } elseif (($role == 'agri_expert') || ($role == 'training_partner_godrej')) {
                return redirect()->intended('/training-partner/submitted-applications');
            } elseif ($role == 'farmer') {
                return redirect()->intended('/director/all-applications');
            }



            // dd($request->all());
            /* if (Auth::attempt($request)) {
            $request->session()->regenerate();

            $current_logged_in_user = Auth::user();
            $roles_and_permissions = $current_logged_in_user->roles_and_permissions; //extracting user_roles_and_permissions table data

            foreach ($roles_and_permissions as $role_id) {
                $id = $role_id->role_id; //extracting role_id from that table
            }

            $role = Roles::find($id);
            $role = $role->code; //storing code
            // dd($role);

            // Extend the user object with additional information
            $user = Auth::user();
            $user->role = $role; //storing user role in auth user ***vvvimp;***
            // dd($user->role);
            // $user->save();

            // $user_role = Auth::user()->role;
            // dd($user_role);*/

            return redirect()->intended('/dashboard'); // Redirect to the intended page after successful login
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email')); // Keep the entered email in the input field
    }

    public function logout(Request $request)
    {
        // dd($request->all());
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
