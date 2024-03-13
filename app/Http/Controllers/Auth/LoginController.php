<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\UserOtp;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
    //function to view the forgot password page
    public function forgot_password(){
       return view('login.forgot');
    }
    //function to view the change password page
    public function change_forgot_password(){
        return view('login.change-forgot-password');
    }
    //function to generate otp for forgot password page
    public function generate_otp_for_forgot_password(Request $request)
    {
        $mobile_no = $request->input('phone_number');
       
        $user = User::where('mobile_no', $mobile_no)->first();
        
        if ($user) {
            $user_id = $user->id;
            $randomNumber = mt_rand(100000, 999999);
    
            // Store the random number in a session variable
            $request->session()->put('random_number', $randomNumber);
    
            $saveotp = UserOtp::create([
                'phone_number' => $mobile_no,
                'otp' => $randomNumber,
                'otp_sent_for' => 'Reset Password',
                'user_id' => $user_id,
            ]);
    
            echo $randomNumber;
        } else {
            echo "<span style='color:red;'>User not found with the provided phone number.</span>";
        }
    }
    //check Forgot password otp
    public function check_forgot_password_otp(Request $request){
        // print_r($request->all());
        // die();
        $phone_no = $request->input('phone');
        $inputOTP = $request->input('otp');
        $sessionOTP = session('random_number'); // Accessing session variable without using Session class

        if ($inputOTP == $sessionOTP) {
            // OTP matched, do something like password reset
            return redirect()->route('change-forgot-password', ['phone' => $phone_no]); // Redirect to your password reset page
        } else {
            // OTP didn't match, show error message
            return back()->with('error', 'Invalid OTP. Please try again.'); // Redirect back with error message
        }

    }
    public function recreate_password(Request $request){
        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'regex:/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])[\w\W\d\D]{5,}$/'],
            're_enter_password' => 'required | same:new_password'
        ], [
            'new_password.regex' => 'Password requires number, letter, and symbol and at least 5 characters long'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $mobile_no = $request->input('phone');
       
        $user = User::where('mobile_no', $mobile_no)->first();
        
        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        
        return redirect()->route('login')->with('success', 'Password changed successfully!');
    } else {
        // Redirect back with error message if user not found
        return back()->with('error', 'User with provided phone number not found.');
    }
        
    }
}
