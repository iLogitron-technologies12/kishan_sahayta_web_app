<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AclRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function view_form_of_adding_agri_expert()
    {
        $name = Auth::user()->name;
        $data = [
            'name' => $name,
        ];
        return view('frontend.super_admin.add_agri_experts', $data);
    }

    public function add_agri_expert(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'designation' => 'required|string|min:3',
                'email' => 'required|email|unique:users,email',
                'mobile_number' => 'required|digits:10|unique:users,mobile_no',
                'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[_.\-@])[A-Za-z\d_.\-@]+$/'],
                'confirm_password' => ['required', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[_.\-@])[A-Za-z\d_.\-@]+$/', 'same:password'],
                // 'confirm_password' => 'required|min:8|same:password'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user_to_be_added = User::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'email' => $request->email,
                'mobile_no' => $request->mobile_number,
                'account_status' => 1,
                'password' => Hash::make($request->confirm_password),
            ]);

            AclRule::create([
                'user_id' => $user_to_be_added->id,
                'role' => 'agri_expert',
                'district' => $request->district,
                'sub_division' => $request->sub_division,
            ]);

            return redirect()->back()->with('success', 'Agri Expert added Successfully!');
        } catch (QueryException $e) {
            // $errorCode = $e->errorInfo[1];

            /*if ($errorCode == 1062) { // 1062 is the MySQL error code for duplicate entry
                return redirect()->back()->with('error', 'Email address already exists. Please choose a different one.');
            } else {
                return redirect()->back()->with('error', 'Please try again.');
            }*/
            return redirect()->back()->with('error', 'Failed to add Agri Expert. Please check the field with errors and try again.' . $e);
        }
    }

    public function manage_agri_experts()
    {
        $name = Auth::user()->name;
        $all_users = User::all();

        $data = [
            'name' => $name,
            'all_users' => $all_users,
        ];

        return view('frontend.super_admin.manage_agri_experts', $data);
    }

    public function view_edit_agri_experts($id)
    {
        $name = Auth::user()->name;
        $that_user_to_be_edited = User::where('id', $id)->first();
        // dd($that_user_to_be_edited);

        $role_of_that_user_to_be_edited = AclRule::where('user_id', $id)->first()->role;
        // dd($role_of_that_user_to_be_edited);

        if (!$role_of_that_user_to_be_edited == "agri_expert") {
            return redirect()->back()->with('error', 'You are not allowed to do this.');
        }

        $data = [
            'name' => $name,
            'that_user_to_be_edited' => $that_user_to_be_edited,
        ];

        return view('frontend.super_admin.edit_agri_experts', $data);
    }

    public function edit_agri_experts(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'designation' => 'required|string|min:3',
                'email' => 'required|email|unique:users,email,' . $id,
                'mobile_number' => 'required|digits:10|unique:users,mobile_no,' . $id,
                'account_status' => 'required|in:0,1',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $that_user_to_be_edited = User::where('id', $id)->first();

            if (!$that_user_to_be_edited) {
                throw new \Exception('User not found.');
            }

            $that_user_to_be_edited->name = $request->name;
            $that_user_to_be_edited->designation = $request->designation;
            $that_user_to_be_edited->email = $request->email;
            $that_user_to_be_edited->mobile_no = $request->mobile_number;
            $that_user_to_be_edited->account_status = $request->account_status;
            $that_user_to_be_edited->save();

            DB::commit();

            return redirect()->back()->with('success', 'Saved Successfully!');
        } catch (QueryException $e) {
            DB::rollBack();

            /*Do not remove this block of code
            //  Handle the exception (log, redirect, etc.)
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
            */
            return redirect()->back()->with('error', 'Failed to Save: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();

            // Handle the exception (log, redirect, etc.)
            return redirect()->back()->with('error', $e->getMessage());
        }
        // return view('frontend.super_admin.edit_agri_experts', $data);
    }

    public function delete_agri_expert(Request $request)
    {
        if (Auth::user()->Role() == 'super_admin') {

            User::where('id', $request->user_id)->delete();
            AclRule::where('user_id', $request->user_id)->delete();

            return redirect()->back()->with('success', 'Agri Expert details deleted Successfully!');
        } else {
            return redirect()->back()->with('error', 'This action is unauthorized. It will be reported.');
        }
    }

    public function view_edit_profile_page()
    {
        $current_user_details = Auth::user();
        $data = [
            'name' => $current_user_details->name,
            'email' => $current_user_details->email,
            'mobile_no' => $current_user_details->mobile_no,
        ];

        return view('frontend.super_admin.profile', $data);
    }

    public function save_profile_changes(Request $request)
    {
        if ($request->filled('profile_changes')) {
            $current_user_details = Auth::user();
            $id = $current_user_details->id;
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|min:3',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'mobile_number' => 'required|digits:10|unique:users,mobile_no,' . $id,
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $current_user_details->name = $request->name;
            $current_user_details->email = $request->email;
            $current_user_details->mobile_no = $request->mobile_number;
            $current_user_details->save();

            return redirect()->back()->with('success', 'Changes saved Successfully!');
        } elseif ($request->filled('password_changes')) {

            $current_user_details_for_psw_change = Auth::user();
            // dd($request->all());
            // dd($current_user_details);

            $validator = Validator::make(
                $request->all(),
                [
                    'current_password' => ['required'],
                    'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[_.\-@])[A-Za-z\d_.\-@]+$/'],
                    'confirm_password' => ['required', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[_.\-@])[A-Za-z\d_.\-@]+$/', 'same:password'],
                    // 'confirm_password' => 'required|min:8|same:password'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $password_in_database = $current_user_details_for_psw_change->password;

            if (Hash::check($request->current_password, $password_in_database)) {

                $current_user_details_for_psw_change->password = $request->confirm_password;
                $current_user_details_for_psw_change->save();

                return redirect()->back()->with('success_after_changing_password', 'Password changed successfully!');
            } else {
                return redirect()->back()->with('error_when_changing_password', 'Current password does match with our records!')->withInput();
            }

            dd($password_in_database);
        }
    }

    public function change_password(Request $request)
    {
    }
}
