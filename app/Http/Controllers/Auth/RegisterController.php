<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Enter_Phone_Number_Request;
use App\Models\AclRule;
use App\Models\Farmer_Application;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;



class RegisterController extends Controller
{
    public function super_admin_dashboard()
    {
        $name = Auth::user()->name;
        $data = [
            'name' => $name,
        ];
        return view('frontend.super_admin.dashboard', $data);
    }



    public function register_officer()
    {
        return view('auth.register_officer');
    }

    public function enter_phone_number()
    {
        return view('new_application.enter_phone_number');
    }

    public function submit_phone_number(Enter_Phone_Number_Request $request)
    {
        $mobile_number = Farmer_Application::where('mobile_no', $request->phone_number)->get();

        // dd($mobile_number->count());

        // if (($mobile_number->count() >= 1))
        //     return back()->withInput()->with('error', 'Phone number already exists. Please try again with another one.');

        if ($mobile_number->count() > 0) {
            // $this->send_otp($request->phone_number);
            return back()->withInput()->with('error', 'The entered phone number does not exist in the system.');
            // return redirect()->route('new-application');
        } else {
            return redirect()->route('verify-otp');
        }
    }

    public function send_otp($mobile_number)
    {
        return;
        // dd($mobile_number);
        $user = Farmer_Application::where('mobile_no', $mobile_number)->first();
        dd($user);
        $user_otp = UserOtp::where('user_id', $user->id)->latest()->first();

        $current_time = now();
        // if($user_otp && $current_time->expire_at)

        UserOtp::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => $current_time->addMinutes(10)
        ]);
    }

    public function verify_otp_page()
    {
        return view('new_application.verify_otp');
    }

    public function verify_otp(Request $request)
    {
        // dd($request->all());
        return redirect('new-application');
    }

    public function login_with_otp(Request $request)
    {
    }

    public function new_application()
    {
        // $districts = DB::table('tripura')->select('district')->distinct()->get(); please don't remove

        // return view('new_application.new_application_for_farmer', compact('districts'));
        return view('new_application.new_application_for_farmer');
    }



    public function get_sub_divisions(Request $request)
    {
        $district = $request->district;

        $sub_divisions = DB::table('tripura')
            ->select('subdivision')
            ->where('district', $district)
            ->distinct()
            ->pluck('subdivision')  // Use pluck to get an array of subdivision values
            ->toArray();  // Convert the collection to an array

        // Add the static value to the beginning of the array
        array_unshift($sub_divisions, 'Select Sub Division');

        return response()->json($sub_divisions);
    }

    public function get_blocks(Request $request)
    {
        // dd($request);

        $district = $request->sub_division;

        $blocks = DB::table('tripura')
            ->select('ulb')
            ->where('subdivision', $district)
            ->distinct()
            ->pluck('ulb')
            ->toArray();

        // Add the static value to the beginning of the array
        array_unshift($blocks, 'Select Block');

        return response()->json($blocks);
    }

    public function get_wards_gp_vc(Request $request)
    {
        $ulb = $request->block;

        $wards = DB::table('tripura')
            ->select('ward')
            ->where('ulb', $ulb)
            ->distinct()
            ->pluck('ward')
            ->toArray();

        // dd($wards);

        // Add the static value to the beginning of the array
        array_unshift($wards, 'Select GP/VC');

        return response()->json($wards);
    }

    // get_wards_gp_vc

    public function create(Request $request)
    {
        // dd($request->all());
        try {
            $status = User::create([
                'name' => $request['name'],
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Registered Successfully!');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) { // 1062 is the MySQL error code for duplicate entry
                return redirect()->back()->with('error', 'Email address already exists. Please choose a different one.');
            } else {
                return redirect()->back()->with('error', 'Please try again.');
            }
        }

        $status = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->back()->with('success', 'Registered Successfully!');
    }

    public function register_officer_post(RegisterRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'sub_division' => 'required',
            'mobile_no' => 'required|digits:10',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // dd($request->sub_division);

        $same_mobile_number = User::where('mobile_no', $request->mobile_no)->get();
        $same_mobile_number = $same_mobile_number->count();

        $same_email_id = User::where('email', $request->email)->get();
        $same_email_id = $same_email_id->count();

        if (($same_mobile_number > 0) && ($same_email_id > 0))
            return back()->withInput()->with('error', 'Email and Phone number already exists. Please try again with another one.');

        if ($same_mobile_number > 0)
            return back()->withInput()->with('error', 'Phone number already exists. Please try again with another one.');

        if ($same_email_id > 0)
            return back()->withInput()->with('error', 'Email already exists. Please try again with another one.');

        $user = User::create([
            'name' => $request['name'],
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'password' => Hash::make($request->password),
        ]);

        AclRule::create([
            'user_id' => $user->id,
            'role' => 'officer',
            'sub_division' => $request->sub_division,
        ]);

        if ($user) {
            return redirect()->route('register.officer')->with('success', 'Registered Successfully!');
        } else {
            return redirect()->back()->with('error', 'Please try again.');
        }
    }

    public function change_password()
    {
        return view('auth.change_password');
    }

    public function profile()
    {
        return view('auth.profile');
    }
    //**************************************************New Addition***27/12/2023***************** */
    public function add_officer()
    {
        $name = Auth::user()->name;

        $user_ids = AclRule::where('role', 'officer')->pluck('user_id');

        $users = User::whereIn('id', $user_ids)->get();

        $sub_divisions = DB::table('tripura')
            ->select('subdivision')
            ->distinct()
            ->get();

        $data = [
            'name' => $name,
            'users' => $users,
            'sub_divisions' => $sub_divisions
        ];

        return view('frontend.director.add_officer', $data);
    }

    public function update_details_of_officer(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    }

    public function add_officer_in_table(Request $request)
    {
        if (User::where('email', $request->officer_email)->exists()) {
            $response = [
                'status' => 'error',
                'message' => 'User with this email already exists.'
            ];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        } else {
            $user = User::create([
                'name' => $request->officer_name,
                'email' => $request->officer_email,
                'mobile_no' => 11,
                'password' => Hash::make($request->confirm_password)
            ]);

            AclRule::create([
                'user_id' => $user->id,
                'role' => 'officer',
                'sub_division' => $request->subdivision
            ]);

            $response = [
                'status' => 'success',
                'message' => 'User added successfully.'
            ];
            return response()->json($response, Response::HTTP_OK);
        }
    }

    public function delete_officer(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->delete();

        $user_in_acl = AclRule::where('user_id', $request->id)->first();
        $user_in_acl->delete();

        $response = [
            'status' => 'success',
            'message' => 'User credentials deleted successfully.'
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
