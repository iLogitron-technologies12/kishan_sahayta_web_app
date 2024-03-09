<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Http\Requests\Farmer_Application_Request;
use App\Models\User;
use App\Models\AclRule;
use App\Models\Tripura;
use App\Models\UserOtp;
use App\Models\Farmer_Application;
use App\Models\PRI_Approval_Sheets;
use App\Models\Farmer_Land_Location;
use App\Models\Phone_Number_and_OTP;
use App\Models\Upload_Farmer_Land_Images;
use App\Models\Temp_Data_of_Applications;
use App\Models\Upload_Farmer_Land_Documents;
use App\Models\Reject_Farmer_Application_Reason;
use App\Models\TrainingBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class FarmerApplicationController extends Controller
{
    public function new_application()
    {
        // $districts = DB::table('tripura')->select('district')->distinct()->get(); please don't remove

        // return view('new_application.new_application_for_farmer', compact('districts'));
        return view('new_application.new_application_page_1');
    }

    public function post_step1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_of_applicant' => 'required|min:3',
            'gender' => 'required',
            'phone_number' => 'required|digits:10',
            'ration_card_number' => 'required|digits:12'

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // dd($request->all());

        $same_mobile_number = User::where('mobile_no', $request->input('phone_number'))->get();

        $same_mobile_number = $same_mobile_number->count();

        if ($request->email_id != null) {
            // dd($request->email_id);
            $same_email_id = User::where('email', $request->email_id)->get();
            $same_email_id = $same_email_id->count();

            if ($same_email_id > 0)
                return back()->withInput()->with('error', 'Email ID already exists. Please try again with another one.');
        }

        $same_ration_number = Farmer_Application::where('ration_no', $request->input('ration_card_number'))->get();

        $same_ration_number = $same_ration_number->count();

        if (($same_mobile_number > 0) && ($same_ration_number > 0))
            return back()->withInput()->with('error', 'Ration Card number and Phone number already exists. Please try again with another one.');


        if ($same_mobile_number > 0)
            return back()->withInput()->with('error', 'Phone number already exists. Please try again with another one.');

        if ($same_ration_number > 0)
            return back()->withInput()->with('error', 'Ration Card number already exists. Please try again with another one.');



        $data = Temp_Data_of_Applications::create([
            'name_of_applicant' => $request->name_of_applicant,
            'husband_fathers_name' => $request->husband_fathers_name,
            'email_id' => $request->email_id,
            'phone_number' => $request->phone_number,
            'ration_card_number' => $request->ration_card_number,
            'gender' => $request->gender,
        ]);

        $id = $data->id;


        // $user = User::where('mobile_no', $request->phone_number)->first();

        $otp = mt_rand(100000, 999999);
        $expire_at = Carbon::now()->addMinutes(10);

        Phone_Number_and_OTP::create([
            'phone_number' => $request->phone_number,
            'otp' => $otp
        ]);

        return redirect()->to('/new-application/step2/' . $id);

        // return redirect()->route('new-application.new-application-page-2',compact('id'));
        // return view('new_application.new_application_page_2', compact('data'));
    }

    public function post_step2_application(Request $request, $id)
    {
        $data = Temp_Data_of_Applications::where('id', $id)->first();
        $name_of_applicant = $data->name_of_applicant;
        $phone_number = $data->phone_number;

        // this is for temporary purpose
        $otp = Phone_Number_and_OTP::where('phone_number', $phone_number)->latest()->first()->otp;
        // dd($otp);
        // please uncomment it and use after once your otp service is added.
        // return view('new_application.new_application_page_2', compact('name_of_applicant', 'phone_number'));
        // the below one is the temporary
        return view('new_application.new_application_page_2', compact('name_of_applicant', 'phone_number', 'otp'));
    }

    public function post_step2(Request $request, $id)
    {
        $phone_number = Temp_Data_of_Applications::where('id', $id)->first()->phone_number;
        $otp = Phone_Number_and_OTP::where('phone_number', $phone_number)->latest()->first()->otp;

        if ($otp == $request->otp) {
            return redirect()->to('/new-application/step3/' . $id);
        } else {
            return redirect()->back()->withInput()->with('error', 'Wrong OTP. Please try again.');
        }
    }

    public function post_step3_application($id)
    {
        // dd($id);
        $application_details_from_temp_data = Temp_Data_of_Applications::where('id', $id)->first();
        $ration_card_number = $application_details_from_temp_data->ration_card_number;

        $districts = DB::table('tripura')->select('district')->distinct()->get();
        return view('new_application.new_application_page_3', compact('districts', 'ration_card_number'));
    }

    public function post_step3(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'district' => 'required',
            'sub_division' => 'required',
            'block' => 'required',
            //'ward_gp_vc' => 'required', *******As par new update ward_gp_vc is not required****
            'complete_address' => 'required',
            'ttaadc_area' => 'required',
            'farming_area_in_acre' => 'required',
            'bank_name' => 'required',
            'beneficiary_name' => 'required',
            'account_number' => 'required',
            'confirm_account_number' => 'required | same:account_number',
            'ifsc_code' => 'required',
            'land_type' => 'required',
            'ration_card_upload' => 'required|max:5120|mimes:jpg,jpeg,png,pdf',
            'supporting_land_document_upload' => 'required|max:5120|mimes:jpg,jpeg,png,pdf'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // dd($request->all());


        $application_details_from_temp_data = Temp_Data_of_Applications::where('id', $id)->first();

        // $district = $request->district;
        // $district_first_3_characters = strtoupper(substr($district, 0, 3));

        // $sub_division = $request->sub_division;
        // $sub_division_first_3_characters = strtoupper(substr($sub_division, 0, 3));

        // $current_date_time = date("YmdHis", time());

        // $random_generated_4_number = rand(1000, 9999);

        // $application_id = $district_first_3_characters . $sub_division_first_3_characters . $current_date_time . $random_generated_4_number;


        do {
            $application_id = $this->generate_application_id($request->district, $request->sub_division);
            $exists = Farmer_Application::where('application_id', $application_id)->exists();
        } while ($exists);

        try {
            DB::beginTransaction();

            if ($request->hasFile('ration_card_upload')) {
                $folder_path = 'public/ration_card_image_of_applicants/' . $application_id;

                // Check if the folder exists, if not, create it

                $image = $request->file('ration_card_upload');
                $image_extension = $image->getClientOriginalExtension();
                $image_name = time() . '.' . $image_extension;
                $image_path = $folder_path . '/' . $image_name;

                // Store the image in the applicant's folder
                $image->storeAs($folder_path, $image_name, 'public');
            }

            if ($request->hasFile('supporting_land_document_upload')) {
                $folder_path = 'public/supporting_land_document_of_applicants/' . $application_id;

                $file = $request->file('supporting_land_document_upload');
                $file_extension = $file->getClientOriginalExtension();
                $file_name = time() . '.' . $file_extension;
                $file_path = $folder_path . '/' . $file_name;

                $file->storeAs($folder_path, $file_name, 'public');
            }

            $user = User::create([
                'name' => $application_details_from_temp_data->name_of_applicant,
                'mobile_no' => $application_details_from_temp_data->phone_number,
                'ration_no' => $application_details_from_temp_data->ration_card_number,
                'password' => Hash::make('test@123')
            ]);
     //#################################################Kani Will converted to Hectare########################
     $kani =$request->farming_area_in_acre;
     $hactare = $kani / 6.25;
            $farmer_applications = Farmer_Application::create([
                'application_id' => $application_id,
                'user_id' => $user->id,
                'name_of_applicant' => $application_details_from_temp_data->name_of_applicant,
                'husband_fathers_name' => $application_details_from_temp_data->husband_fathers_name,
                'email_id' => $application_details_from_temp_data->email_id,
                'phone_number' => $application_details_from_temp_data->phone_number,
                'ration_no' => $application_details_from_temp_data->ration_card_number,
                'gender' => $application_details_from_temp_data->gender,
                'sub_division' => $request->sub_division,
                'district' => $request->district,
                'block' => $request->block,
                //new update
                'revenue_circle' => $request->revenue_circle,
                'tehsil' => $request->tehsil,
                'mouja' => $request->mouja,
                'type_of_land_indentification_no' => $request->type_of_land_indentification_no,
                'land_indentification_no' => $request->land_indentification_no,
                // 'ward_gp_vc' => $request->ward_gp_vc, *******As par new update ward_gp_vc is not required****
                'complete_address' => $request->complete_address,
                'ttaadc_area' => $request->ttaadc_area,
                'farming_area_in_acre' => $request->farming_area_in_acre,
                'farming_area_in_hectare'=>$hactare,
                'bank_name' => $request->bank_name,
                'beneficiary_name' => $request->beneficiary_name,
                'account_number' => $request->account_number,
                'confirm_account_number' => $request->confirm_account_number,
                'ifsc_code' => $request->ifsc_code,
                'land_type' => $request->land_type,
                // 'area_in_hectares' => $request->input('area_in_hectares'),
                'ration_card_image_path' => $image_path,
                'any_supporting_land_document_path' => $file_path,
                'status' => $request->status,
                'added_by' => Auth::user() ? Auth::user()->id : 0 //If Auth user is not null, it uses Auth::user()->id, otherwise, it uses 0.
            ]);

            DB::commit();
            // dd($request->status);

            if ($request->status == 1) {
                return redirect()->route('success');
            } else {
                return redirect()->route('saved-success');
            }
        } catch (\Exception $e) {
            DB::rollback();

            $errorMessage = $e->getMessage();

            // Pass the error message back to the view
            return back()->withInput()->with('error', $errorMessage);
        }

        // return redirect()->route('new-application.new_application_page_3');
    }

    public function generate_application_id($district, $sub_division)
    {
        $district_first_3_characters = strtoupper(substr($district, 0, 3));
        $sub_division_first_3_characters = strtoupper(substr($sub_division, 0, 3));
        $random_generated_6_number = rand(100000, 999999);

        return $application_id = $district_first_3_characters . $sub_division_first_3_characters . $random_generated_6_number;
    }



    // public function index()
    // {
    //     $all_applications = Farmer_Application::all();
    //     return view('frontend.ground_staff.dashboard_g', ['all_applications' => $all_applications]);
    // }

    public function officer_applications($all_applications_after_filter = 0, $count = 0)
    {

        if ($all_applications_after_filter  == null) {

            $name = Auth::user()->name;
            $sub_division = AclRule::where('user_id', Auth::user()->id)->first()->sub_division;
            // dd($sub_division);

            $blocks = DB::table('tripura')
                ->select('ulb')
                ->where('subdivision', $sub_division)
                ->distinct()
                ->get();
            // dd($blocks);

            // $all_applications = Farmer_Application::all();

            // $all_applications = Farmer_Application::where('sub_division', $sub_division)->where('status', '!=', 0)->get();
            $all_applications = Farmer_Application::where('sub_division', $sub_division)->where('status', '>', 0)->get();
            // DB::table('')

            // dd($all_applications);

            $data = [
                'name' => $name,
                'all_applications' => $all_applications,
                'sub_division' => $sub_division,
                'blocks' => $blocks,
            ];
            // dd($data);

            // Return the view with data
            return view('frontend.officer.all_applications_for_officer', $data);
        } else {
            $name = Auth::user()->name;
            $sub_division = AclRule::where('user_id', Auth::user()->id)->first()->sub_division;

            $blocks = DB::table('tripura')
                ->select('ulb')
                ->where('subdivision', $sub_division)
                ->distinct()
                ->get();

            $all_applications = $all_applications_after_filter;

            $success_message = $count . " results found!";

            $data = [
                'name' => $name,
                'all_applications' => $all_applications,
                'sub_division' => $sub_division,
                'blocks' => $blocks,
                'success_message' => $success_message,
            ];

            // Return the view with data
            return view('frontend.officer.dashboard_officer', $data);
        }
    }


    public function create(Farmer_Application_Request $request)
    {
        $same_mobile_number = Farmer_Application::where('mobile_no', $request->input('mobile_no'))->get();

        $same_mobile_number = $same_mobile_number->count();

        $same_ration_number = Farmer_Application::where('ration_no', $request->input('ration_no'))->get();

        $same_ration_number = $same_ration_number->count();

        if (($same_mobile_number > 0) && ($same_ration_number > 0))
            return back()->withInput()->with('error', 'ration number and Phone number already exists. Please try again with another one.');

        if ($same_mobile_number > 0)
            return back()->withInput()->with('error', 'Phone number already exists. Please try again with another one.');

        if ($same_ration_number > 0)
            return back()->withInput()->with('error', 'ration number already exists. Please try again with another one.');


        try {
            DB::beginTransaction();

            Farmer_Application::create([
                'name_of_beneficiary' => $request->input('name_of_beneficiary'),
                'name_of_beneficiary_father_or_husband' => $request->input('name_of_beneficiary_father_or_husband'),
                'gp_vc' => $request->input('gp_vc'),
                'block' => $request->input('block'),
                'sub_division' => $request->input('sub_division'),
                'district' => $request->input('district'),
                'pin_code' => $request->input('pin_code'),
                'mobile_no' => $request->input('mobile_no'),
                'ration_no' => $request->input('ration_no'),
                'bank_name' => $request->input('bank_name'),
                'branch_name' => $request->input('branch_name'),
                'account_number' => $request->input('account_number'),
                'ifsc_code' => $request->input('ifsc_code'),
                'area_in_hectares' => $request->input('area_in_hectares'),
                'amount_in_rupees' => $request->input('amount_in_rupees'),
                'added_by' => Auth::user() ? Auth::user()->id : 0 //If Auth user is not null, it uses Auth::user()->id, otherwise, it uses 0.
            ]);

            $user = User::create([
                'name' => $request->input('name_of_beneficiary'),
                'mobile_no' => $request->input('mobile_no'),
                'ration_no' => $request->input('ration_no'),
                'password' => Hash::make('test@123')
            ]);

            DB::commit();

            return redirect()->route('success');
        } catch (\Exception $e) {
            DB::rollback();

            $errorMessage = $e->getMessage();

            // Pass the error message back to the view
            return back()->withInput()->with('error', $errorMessage);
        }
    }

    public function track_application()
    {
        return view('track_application.track_application_page_1');
    }

    public function track_application_check_if_phone_number_exists(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $same_mobile_number = Farmer_Application::where('phone_number', $request->phone_number)->get();
        // dd( $same_mobile_number);  
       echo  $same_mobile_number = $same_mobile_number->count();

        if (($same_mobile_number == 1) || ($same_mobile_number > 1)) {

            $user = User::where('mobile_no', $request->phone_number)->first();
           
            $otp = mt_rand(100000, 999999);
            $expire_at = Carbon::now()->addMinutes(10);

            UserOtp::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'expire_at' => $expire_at
            ]);
            return redirect()->to('/track-application/enter-otp/' . $request->phone_number);
        } else {
            // return back()->withInput()->with('error', 'Seems like you are new to this system. Please go New Application and Submit or Save in Order to Track your Application. No application found with you entered Phone Number');
            return back()->withInput()->with('error', 'Seems like you are new to this system. No application found with you entered Phone Number');
        }
        return back()->withInput()->with('error', 'ration number already exists. Please try again with another one.');
    }

    // public function track_application_enter_otp($phone_number)
    public function track_application_enter_otp($phone_number)
    {
        // this one is for temporary purpose till OTP is being added
        $user_id = User::where('mobile_no', $phone_number)->first()->id;
        // dd($user_id);
        $otp = UserOtp::where('user_id', $user_id)->latest()->first()->otp;
        // dd($otp);

        // please dont remove this code uncomment this once the otp problem get fixed
        // return view('track_application.track_application_page_2_enter_otp')->with('phone_number', $phone_number);

        // this is the temporary code
        return view('track_application.track_application_page_2_enter_otp', compact('phone_number', 'otp'));
    }

    public function track_application_verify_entered_otp(Request $request, $phone_number)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('mobile_no', $phone_number)->first();
        $otp_in_table = UserOtp::where('user_id', $user->id)->latest()->first()->otp;

        if ($user && $otp_in_table == $request->otp) {
            //authenticating the user in the system
            auth()->login($user);
        } else {
            return redirect()->back()->withInput()->with('error', 'Wrong OTP. Please try again.');
        }

        $application_id = Farmer_Application::where('phone_number', $phone_number)->first()->id;

        return redirect()->to('/track-application/view-application/' . $application_id);
    }

    public function track_application_view_application($id)
    {
        // dd($id);
        $application_details = Farmer_Application::where('id', $id)->first();
        // dd($application_details);
        $application_details_user_id = $application_details->user_id;
        // dd($application_details_user_id);
        $user_id = Auth::user()->id;

        if ($application_details_user_id == $user_id) {

            $application_details_status = $application_details->status;
            // dd($application_details);

            if ($application_details_status == 0) {
                $districts = DB::table('tripura')->select('district')->distinct()->get();

                return view('track_application.view_application', compact('application_details', 'id', 'districts'));
                // return view('track_application.view_application', compact('application_details', 'id'));
            } else {
                return view('track_application.view_application_in_card', compact('application_details', 'id'));
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'This action is unauthorized.');
        }
        // dd($application_details);
    }

    public function track_application_submit_application(Request $request, $id)
    {
        // dd($id);
        $application = Farmer_Application::where('id', $id)->first();
        $application->status = 1;
        $application->save();
        // dd($application);
        return redirect('/success');
    }

    public function application_filter_for_officer(Request $request)
    {
        // dd($request->all());
        if (($request->block == null) && ($request->ward_gp_vc == null)) {
            return redirect()->back()->with('error', 'Plese select block or ward/gp/vc.');
        }

        // if ($request->ward_gp_vc == "Select Ward") {
        //     return redirect()->back()->with('error', 'Plese select ward/gp/vc.');
        // }


        $sub_division = $request->sub_division;
        $block = $request->block;
        $ward_gp_vc = $request->ward_gp_vc;

        // if user has selected nothing
        if ($block == "Select Block") {
            $all_applications_after_filter = Farmer_Application::where('sub_division', $sub_division)
                ->get();
        } else {
            // if user has selected block but not any ward/gp/vc
            if ($ward_gp_vc == "Select Ward") {
                $all_applications_after_filter = Farmer_Application::where('sub_division', $sub_division)
                    ->where('block', $block)
                    ->get();
            } else {
                // when user has selected both block ward/gp/vc
                $all_applications_after_filter = Farmer_Application::where('sub_division', $sub_division)
                    ->where('block', $block)
                    ->where('ward_gp_vc', $ward_gp_vc)
                    ->get();
            }
        }

        // dd($all_applications_after_filter->count());

        $count = $all_applications_after_filter->count();

        if ($count == 0) {
            // dd($count);
            // return redirect()->back()->with('error', 'No results found.');
            return $this->officer_applications($all_applications_after_filter, $count);
        } else {
            return $this->officer_applications($all_applications_after_filter, $count);
        }
    }

    public function view_application_and_approve_by_officer($id)
    {
        // dd($id);
        $status = Farmer_Application::where('id', $id)->first()->status;

        if (PRI_Approval_Sheets::where('farmer_applications_id', $id)->exists()) {

            $pri_approval_sheet_path = PRI_Approval_Sheets::where('farmer_applications_id', $id)->first()->pri_approval_sheet_path;

            $id_exists = 1;

            $application_details = Farmer_Application::where('id', $id)->first();

            // this if condition will be executed only when farmer application is rejected.
            if (Reject_Farmer_Application_Reason::where('farmer_applications_id', $id)->exists()) {
                $reason_for_rejection = Reject_Farmer_Application_Reason::where('farmer_applications_id', $id)->first()->reason_for_rejection;

                // checking if coordinates exist for this application i.e., application is rejected after getting physically verified.
                if (Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
                    // dd('yes coordinates exists for this rejected application');
                    $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();
                    return view('frontend.officer.view_application_and_approve', compact('application_details', 'id', 'id_exists', 'pri_approval_sheet_path', 'status', 'coordinates', 'reason_for_rejection'));
                }
                // this view will be executed only when application is rejected by pri body or before getting physically verified.
                return view('frontend.officer.view_application_and_approve', compact('application_details', 'id', 'id_exists', 'pri_approval_sheet_path', 'status', 'reason_for_rejection'));
            }

            // this if condition will be executed only when the applications is physically verified and coordinates exists.
            if (Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
                $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();
                // dd($coordinates);
                return view('frontend.officer.view_application_and_approve', compact('application_details', 'id', 'id_exists', 'pri_approval_sheet_path', 'status', 'coordinates'));
            }

            return view('frontend.officer.view_application_and_approve', compact('application_details', 'id', 'id_exists', 'pri_approval_sheet_path', 'status'));
        } else {
            // Here else part will be executed when there is not pri sheet uploaded
            $id_exists = 0;

            $application_details = Farmer_Application::where('id', $id)->first();

            return view('frontend.officer.view_application_and_approve', compact('application_details', 'id', 'id_exists', 'status'));
        }
    }

    public function print_application_for_officer($id)
    {
        $application_details = Farmer_Application::where('id', $id)->first();
        return view('frontend.officer.print_application', compact('application_details', 'id'));
    }

    public function upload_pri_approval_sheet_by_officer(Request $request, $id)
    {
        if ($request->approval_value == '4') {
            $application_details = Farmer_Application::where('id', $id)->first();
            $application_details->status = 4;
            $application_details->save();

            return $this->view_application_and_approve_by_officer($application_details->id);
        }

        if ($request->approval_value == '6') {
            $application_details = Farmer_Application::where('id', $id)->first();
            $application_details->status = 6;
            $application_details->save();

            return $this->view_application_and_approve_by_officer($application_details->id);
        }

        if ($request->approval_value == '5') {

            $validator = Validator::make(
                $request->all(),
                [
                    'reason' => 'required',
                ],
                [
                    'reason.required' => 'The reason for rejection is required.'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $application_details = Farmer_Application::where('id', $id)->first();
            $application_details->status = 5;
            $application_details->save();

            Reject_Farmer_Application_Reason::create([
                'farmer_applications_id' => $id,
                'reason_for_rejection' => $request->reason
            ]);

            return $this->view_application_and_approve_by_officer($application_details->id, $request->reason);
        }

        $validator = Validator::make($request->all(), [
            'pri_approval_sheet' => 'required|mimes:pdf|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->approval_status == "approved") {
            $application_details = Farmer_Application::where('id', $id)->first();
            $application_details->status = 2;
            $application_details->save();
        } else {
            $application_details = Farmer_Application::where('id', $id)->first();
            $application_details->status = 3;
            $application_details->save();
        }

        $application_details = Farmer_Application::where('id', $id)->first();

        $application_id = $application_details->application_id;

        if ($request->hasFile('pri_approval_sheet')) {
            $folder_path = 'public/pri_approval_sheet/' . $application_id;
            $image = $request->file('pri_approval_sheet');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = time() . '.' . $image_extension;
            $image_path = $folder_path . '/' . $image_name;

            // Store the image in the applicant's folder
            $image->storeAs($folder_path, $image_name, 'public');
        }

        PRI_Approval_Sheets::create([
            'farmer_applications_id' => $application_details->id,
            'pri_approval_sheet_path' => $image_path
        ]);

        return $this->view_application_and_approve_by_officer($application_details->id);
    }

    /*************************************************** Methods for officer ends here ***************************************************/

    //----------------------------------------------------------------------------------------------------------------------------


    /*************************************************** Methods for training_partner ***************************************************/


    // public function training_partner_forwarded_applications($all_applications_after_filter = 0, $count = 0)
    // {
    //     dd('123');
    //     // dd($all_applications_after_filter);
    //     // $count = $all_applications_after_filter->count() ?? 0;

    //     /* if ($all_applications_after_filter  == null) {


    //         $name = Auth::user()->name;
    //         $sub_division = AclRule::where('user_id', Auth::user()->id)->first()->sub_division;

    //         $blocks = DB::table('tripura')
    //             ->select('ulb')
    //             ->where('subdivision', $sub_division)
    //             ->distinct()
    //             ->get();
    //         // dd($blocks);

    //         // $all_applications = Farmer_Application::all();

    //         $all_applications = Farmer_Application::where('sub_division', $sub_division)->where('status', '<>', 0)->get();
    //         // dd($all_applications);

    //         $data = [
    //             'name' => $name,
    //             'all_applications' => $all_applications,
    //             'sub_division' => $sub_division,
    //             'blocks' => $blocks,
    //         ];

    //         // Return the view with data
    //         return view('frontend.officer.dashboard_officer', $data);
    //     } else {
    //         $name = Auth::user()->name;
    //         $sub_division = AclRule::where('user_id', Auth::user()->id)->first()->sub_division;

    //         $blocks = DB::table('tripura')
    //             ->select('ulb')
    //             ->where('subdivision', $sub_division)
    //             ->distinct()
    //             ->get();

    //         $all_applications = $all_applications_after_filter;

    //         $success_message = $count . " results found!";

    //         $data = [
    //             'name' => $name,
    //             'all_applications' => $all_applications,
    //             'sub_division' => $sub_division,
    //             'blocks' => $blocks,
    //             'success_message' => $success_message,
    //         ];

    //         // Return the view with data
    //         return view('frontend.officer.dashboard_officer', $data);*/

    //         // return view('training_partner.dashboard_training_partner');
    // }
//********forwared application is updated into submitted applications********//
    public function training_partner_view_submitted_applications()
    {
        $user_id = Auth::user()->id;
        $role = AclRule::where('user_id', $user_id)->first()->role;

        if ($role == 'training_partner_patanjali') {

            $districts = Tripura::select('district')
                ->distinct()
                ->whereIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        } else {
            $districts = Tripura::select('district')
                ->distinct()
                ->whereNotIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        }

        $name = Auth::user()->name;

        // $all_applications = Farmer_Application::whereIn('district', $districts)->where('status', '=', 1)->get();
        //**********************************************new update so that the viewer can the send for physically verify and physically verified  ***16/01/2023*************/
        $all_applications = Farmer_Application::whereIn('district', $districts)
    ->where(function ($query) {
        $query->where('status', '=', 1)
            ->orWhere('status', '=', 2);
    })
    ->get();

        // $all_applications = $all_applications->where('status', '<', 6);
        // $all_applications = $all_applications->where('status', '<', 7);

        $data = [
            'name' => $name,
            'all_applications' => $all_applications,
            'districts' => $districts,
        ];

        return view('frontend.training_partner.submitted_applications', $data);
    }

    public function training_partner_view_approved_applications()
    {
        $user_id = Auth::user()->id;
        $role = AclRule::where('user_id', $user_id)->first()->role;

        if ($role == 'training_partner_patanjali') {

            $districts = Tripura::select('district')
                ->distinct()
                ->whereIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        } else {
            $districts = Tripura::select('district')
                ->distinct()
                ->whereNotIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        }

        $name = Auth::user()->name;

        $all_applications = Farmer_Application::whereIn('district', $districts)->where('status', '=', [3, 4])->get();

        // $all_applications = $all_applications->where('status', '<', 6);
        // $all_applications = $all_applications->where('status', '<', 7);

        $data = [
            'name' => $name,
            'all_applications' => $all_applications,
            'districts' => $districts,
        ];

        return view('frontend.training_partner.approved_applications', $data);

       
    }
    //############################################## All Others Applications ####################################//

    public function training_partner_view_all_others_applications()
    {
        $user_id = Auth::user()->id;
        $role = AclRule::where('user_id', $user_id)->first()->role;

        if ($role == 'training_partner_patanjali') {

            $districts = Tripura::select('district')
                ->distinct()
                ->whereIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        } else {
            $districts = Tripura::select('district')
                ->distinct()
                ->whereNotIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        }

        $name = Auth::user()->name;

        $all_applications = Farmer_Application::whereIn('district', $districts)->where('status', '=', [5, 6, 7,8])->get();

        // $all_applications = $all_applications->where('status', '<', 6);
        // $all_applications = $all_applications->where('status', '<', 7);

        $data = [
            'name' => $name,
            'all_applications' => $all_applications,
            'districts' => $districts,
        ];

        return view('frontend.training_partner.view_all_others_applications', $data);

       
    }

//********************************************** Start Added By UJJAL SARKAR ***************************************//
      
//********************************************** End Added By UJJAL SARKAR ***************************************//







    public function training_partner_view_application_and_physical_verification($id)
    {
        $application_details = Farmer_Application::where('id', $id)->first();

        $status = $application_details->status;

        $id_exists = 0;

        if (Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists()) {
            $land_image = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;
        } else {
            $land_image = 'no_image_path';
        }

        if (Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            $land_document = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
        } else {
            $land_document = 'no_document_path';
        }

        if (Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();
        } else {
            $coordinates = 'no_coordinates';
        }

        if ($status == 1) {
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document', 'coordinates'));
        } else {
            return view('frontend.training_partner.view_non_editable_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document', 'coordinates'));
        }



        //****************************************** checking physically verified or not starts here  ****************************************************************************** */
        // if training partner has physically verified the form after that the form will be non-editable only viewable
        if ($status >= 5) {
            // dd('123');
            // checking when physically verified , land image uploaded and document is uploaded

            if (Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && Farmer_Land_Location::where('farmer_applications_id', $id)->exists() && Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
                // dd('image uploaded, doc uploaded and physically verified');
                $land_document = 'exists';
                $land_image = 'exists';

                $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
                $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;
                $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();
                // dd($coordinates);
                return view('frontend.training_partner.view_non_editable_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document', 'document_path', 'coordinates'));
            }

            // checking when physically verified,  land image uploaded and document is not uploaded

            elseif (Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && Farmer_Land_Location::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
                // dd('in case where image is uploaded, verified but document is not uploaded');

                $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();

                $land_document = 'not_exists';
                $land_image = 'exists';
                // dd($land_image);

                $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;

                return view('frontend.training_partner.view_non_editable_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document', 'coordinates'));
            }
        }
        // dd('123');

        //****************************************** checking physically verified or not ends here  ****************************************************************************** */

        // when land image, land document both exists and coodinates exist (CASE 1).
        if (Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists() && Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            // dd('image , documents and coordinates exists');
            $land_document = 'exists';
            $land_image = 'exists';

            $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;
            $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();

            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document', 'document_path', 'coordinates'));
        }

        // when land image, land document both exists but coodinates doesn't exist (CASE 2).
        if (Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists() && Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && !Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            // dd("image , documents but coordinates doesn't exists");
            $land_document = 'exists';
            $land_image = 'exists';

            $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;

            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document', 'document_path'));
        }

        // when land image, cordinates exist but document doesn't exist (CASE 3).
        if (Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && Farmer_Land_Location::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            // dd("image , coordinates but documents doesn't exists");
            $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();

            $land_document = 'not_exists';
            $land_image = 'exists';

            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;

            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document', 'coordinates'));
        }

        // when land image , documents exist but coordinates is not uploaded (CASE 4)

        if (Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;
            // dd('land image is uploaded but land doc is not uploaded');
            $land_image = 'exists';
            $land_document = 'not_exists';
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document'));
            dd('executed from here!');
        }

        // when land document is uploaded & land image is not uploaded (CASE 3)

        if (!Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
            // dd('land image is not uploaded but land doc is uploaded');
            // dd($document_path);
            $land_image = 'not_exists';
            $land_document = 'exists';
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document', 'document_path'));
            dd('executed from here!');
        }

        // when neither land document is uploaded nor land image is not uploaded (CASE 4)
        if (!Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            // dd('neither of them is uploaded');
            // $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_images;
            // dd('land image is uploaded but land doc is not uploaded');
            // dd($document_path);
            $land_image = 'not_exists';
            $land_document = 'not_exists';
            // dd('here');
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document'));
            dd('executed from here!');
        }

        // when none of them exists (CASE 5)
        if (!Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists() && !Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            dd('neither of them is uploaded');
            $land_image = 'not_exists';
            $land_document = 'not_exists';
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document'));
            dd('executed from here!');
        }


        // when land image, document is not uploaded
        if (!Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists()) {
            // dd('land image does not exists');
            $land_image = 'not_exists';
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document'));
            dd('executed from here!');
        }

        // when land document is uploaded
        if (!Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            // $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
            // dd('land document does exists');
            $land_document = 'not_exists';
            // dd($document_path);
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'land_document'));
            // dd('executed from here!');
        }







        // dd($id);

        // if land image exists then

        // if(Upload_Farmer_Land_Images::where('farmer_applications_id',$id)->exists()){
        //     dd('land image exists');
        // }
        // dd($land_image_id);



        if (Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'coordinates'));
        }

        return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status'));
    }

    public function training_partner_update_address_and_land_details(Request $request, $id)
    {
        // dd($request->all());

        $application = Farmer_Application::where('id', $id)->first();

        if ($request->ward_gp_vc != null) {
            $application->ward_gp_vc = $request->ward_gp_vc;
        }
        $kani =$request->farming_area_in_acre;
        $hactare = $kani / 6.25;
        $application->complete_address = $request->complete_address;
        $application->ttaadc_area = $request->ttaadc_area;
        $application->land_type = $request->land_type;
        $application->farming_area_in_acre = $request->farming_area_in_acre;
        $application->farming_area_in_hectare = $hactare;
        $application->save();

        return redirect()->back()->with('success', 'Details updated successfully.');
    }

    public function training_partner_update_to_physically_verified(Request $request, $id)
    {
        $application = Farmer_Application::where('id', $id)->first();
        $application->status = $request->approval_value;
        $application->save();
        if($request->latitude==""){
            $request->latitude=0;
        }
        if($request->longitude==""){
            $request->longitude=0;
        }

        Farmer_Land_Location::create([
            'farmer_applications_id' => $application->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Physically Verified.');
    }

    public function training_partner_update_to_sent_for_approval(Request $request, $id)
    {
        // dd($request->all());
        $application = Farmer_Application::where('id', $id)->first();
        // dd($application);
        $application->status = $request->approval_value;
        $application->save();

        return redirect()->back()->with('success', 'Sent to Officer for Approval Successfully!');
    }

    public function training_partner_upload_land_images(Request $request, $id)
    {
        // dd($request->all());
        $application = Farmer_Application::where('id', $id)->first();

        $validator = Validator::make($request->all(), [
            'land_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('land_image')) {
            $folder_path = 'public/land_images/' . $application->application_id;

            $image = $request->file('land_image');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = time() . '.' . $image_extension;
            $image_path = $folder_path . '/' . $image_name;
            // dd($image_path);

            $image->storeAs($folder_path, $image_name, 'public');

            Upload_Farmer_Land_Images::create([
                'farmer_applications_id' => $id,
                'farmer_land_images' => $image_path,
            ]);
        }

        return redirect()->back()->with('success', 'Images Uploaded Successfully.');
    }

    public function training_partner_upload_land_documents(Request $request, $id)
    {
        // dd($request->all());
        $application = Farmer_Application::where('id', $id)->first();

        $validator = Validator::make($request->all(), [
            'land_document' => 'required|max:5120|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('land_document')) {
            $folder_path = 'public/land_document/' . $application->application_id;

            $document = $request->file('land_document');
            $document_extension = $document->getClientOriginalExtension();
            $document_name = time() . '.' . $document_extension;
            $document_path = $folder_path . '/' . $document_name;
            // dd($image_path);

            $document->storeAs($folder_path, $document_name, 'public');

            Upload_Farmer_Land_Documents::create([
                'farmer_applications_id' => $id,
                'farmer_land_documents_path' => $document_path
            ]);
        }

        return redirect()->back()->with('success', 'Documents Uploaded Successfully.');
    }

    public function training_partner_applications($all_applications_after_filter = 0, $count = 0)
    {
        $user_id = Auth::user()->id;
        $role = AclRule::where('user_id', $user_id)->first()->role;

        if ($role == 'training_partner_patanjali') {

            $districts = Tripura::select('district')
                ->distinct()
                ->whereIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        } else {
            $districts = Tripura::select('district')
                ->distinct()
                ->whereNotIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        }

        $name = Auth::user()->name;

        $all_applications = Farmer_Application::whereIn('district', $districts)->where('status', '>=', 1)->get();

        if ($all_applications_after_filter  == null) {

            $name = Auth::user()->name;

            $all_applications = Farmer_Application::whereIn('district', $districts)->where('status', '>=', 1)->get();
            // dd($all_applications);

            $data = [
                'name' => $name,
                'all_applications' => $all_applications,
                'districts' => $districts,
            ];

            return view('frontend.training_partner.submitted_applications', $data);
        } else {
            $name = Auth::user()->name;
            $sub_division = AclRule::where('user_id', Auth::user()->id)->first()->sub_division;

            $all_applications = $all_applications_after_filter;

            $success_message = $count . " results found!";

            $data = [
                'name' => $name,
                'all_applications' => $all_applications,
                'districts' => $districts,
                'success_message' => $success_message,
            ];

            // Return the view with data
            return view('frontend.training_partner.submitted_applications', $data);

            // return view('frontend.officer.dashboard_officer', $data);
        }
    }

    public function training_partner_submitted_applications_filter(Request $request)
    {
        // dd($request->all());

        $district = $request->district;
        $sub_division = $request->sub_division;
        $block = $request->block;
        $ward_gp_vc = $request->ward_gp_vc;

        #########################################################################################
        //  Flag Part:
        $user_id = Auth::user()->id;
        $role = AclRule::where('user_id', $user_id)->first()->role;
        #########################################################################################

        // fetching all the subdivisions
        $subdivisions = Tripura::select('subdivision')
            ->where('district', $district)
            ->distinct()
            ->get();

        if ($role == 'training_partner_patanjali') {

            $districts = Tripura::select('district')
                ->distinct()
                ->whereIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        } else {
            $districts = Tripura::select('district')
                ->distinct()
                ->whereNotIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        }

        ########################################################################################

        // this will be executed when user has selected nothing
        if ($district == "Select District") {

            $all_applications_after_filter = Farmer_Application::whereIn('district', $districts)
                ->where('status', '=', 1)
                ->get();

            // dd($all_applications_after_filter);
        } else {
            // this will be executed when user has selected district and nothing
            if ($sub_division == "Select Sub Division") {

                // dd('sub division not selected so select all sub division of that district');

                $all_applications_after_filter = Farmer_Application::where('district', $district)
                    ->whereIn('sub_division', $subdivisions)
                    ->where('status', '=', 1)
                    ->get();

                // dd($all_applications_after_filter);
            } else {

                // this will be executed when user has selected district and sub division

                if ($block == "Select Block") {

                    // dd('block is not selected so select all block with respect to the sub division');

                    $all_applications_after_filter = Farmer_Application::where('district', $district)
                        ->where('sub_division', $sub_division)
                        ->where('status', '=', 1)
                        ->get();

                    // dd($all_applications_after_filter);
                } else {

                    // this will be executed when user has selected district, sub division and block

                    if ($ward_gp_vc == "Select Ward") {

                        // dd('ward gp vc is not selected so select all ward gp vc with respect to the block');

                        $all_applications_after_filter = Farmer_Application::where('district', $district)
                            ->where('sub_division', $sub_division)
                            ->where('status', '=', 1)
                            ->where('block', $block)
                            ->get();

                        // dd($all_applications_after_filter);
                    } else {
                        // dd('in this part');
                        $all_applications_after_filter = Farmer_Application::where('district', $district)
                            ->where('sub_division', $sub_division)
                            ->where('block', $block)
                            ->where('ward_gp_vc', $ward_gp_vc)
                            ->where('status', '=', 1)
                            ->get();

                        // dd($all_applications_after_filter);
                    }
                }
            }
        }
        // dd('stop');
        $count = $all_applications_after_filter->count();
        // dd($count);

        if ($count == 0) {
            // return redirect()->back()->with('error', 'No results found.');
            return $this->training_partner_applications($all_applications_after_filter, $count);
        } else {
            return $this->training_partner_applications($all_applications_after_filter, $count);
        }
    }

    //************Filter Framer approved Applications based on  district, sud-division etc****Ujjal***/
    public function training_partner_approved_applications_filter(Request $request)
    {
        // dd($request->all());

        $district = $request->district;
        $sub_division = $request->sub_division;
        $block = $request->block;
        $ward_gp_vc = $request->ward_gp_vc;

        #########################################################################################
        //  Flag Part:
        $user_id = Auth::user()->id;
        $role = AclRule::where('user_id', $user_id)->first()->role;
        #########################################################################################

        // fetching all the subdivisions
        $subdivisions = Tripura::select('subdivision')
            ->where('district', $district)
            ->distinct()
            ->get();

        if ($role == 'training_partner_patanjali') {

            $districts = Tripura::select('district')
                ->distinct()
                ->whereIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        } else {
            $districts = Tripura::select('district')
                ->distinct()
                ->whereNotIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
        }

        ########################################################################################

        // this will be executed when user has selected nothing
        if ($district == "Select District") {

            $all_applications_after_filter = Farmer_Application::whereIn('district', $districts)
                ->where('status', '=', 4)
                ->get();

            // dd($all_applications_after_filter);
        } else {
            // this will be executed when user has selected district and nothing
            if ($sub_division == "Select Sub Division") {

                // dd('sub division not selected so select all sub division of that district');

                $all_applications_after_filter = Farmer_Application::where('district', $district)
                    ->whereIn('sub_division', $subdivisions)
                    ->where('status', '=', 4)
                    ->get();

                // dd($all_applications_after_filter);
            } else {

                // this will be executed when user has selected district and sub division

                if ($block == "Select Block") {

                    // dd('block is not selected so select all block with respect to the sub division');

                    $all_applications_after_filter = Farmer_Application::where('district', $district)
                        ->where('sub_division', $sub_division)
                        ->where('status', '=', 4)
                        ->get();

                    // dd($all_applications_after_filter);
                } else {

                    // this will be executed when user has selected district, sub division and block

                    if ($ward_gp_vc == "Select Ward") {

                        // dd('ward gp vc is not selected so select all ward gp vc with respect to the block');

                        $all_applications_after_filter = Farmer_Application::where('district', $district)
                            ->where('sub_division', $sub_division)
                            ->where('status', '=', 4)
                            ->where('block', $block)
                            ->get();

                        // dd($all_applications_after_filter);
                    } else {
                        // dd('in this part');
                        $all_applications_after_filter = Farmer_Application::where('district', $district)
                            ->where('sub_division', $sub_division)
                            ->where('block', $block)
                            ->where('ward_gp_vc', $ward_gp_vc)
                            ->where('status', '=', 4)
                            ->get();

                        // dd($all_applications_after_filter);
                    }
                }
            }
        }
        // dd('stop');
        $count = $all_applications_after_filter->count();
        // dd($count);

        if ($count == 0) {
            // return redirect()->back()->with('error', 'No results found.');
            return $this->training_partner_applications($all_applications_after_filter, $count);
        } else {
            return $this->training_partner_applications($all_applications_after_filter, $count);
        }
    }












    public function training_partner_view_approved_application($id)
    {
        $application_details = Farmer_Application::where('id', $id)->first();

        $status = $application_details->status;

        $id_exists = 0;

        // when land image, land document both exists and coodinates exist (CASE 1).
        if (Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists() && Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            // dd('image , documents and coordinates exists');
            $land_document = 'exists';
            $land_image = 'exists';

            $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;
            $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();

            return view('frontend.training_partner.view_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document', 'document_path', 'coordinates'));
        }

        // when land image, land document both exists but coodinates doesn't exist (CASE 2).
        if (Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists() && Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && !Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            // dd("image , documents but coordinates doesn't exists");
            $land_document = 'exists';
            $land_image = 'exists';

            $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;

            return view('frontend.training_partner.view_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document', 'document_path'));
        }
        // dd('124');

        // when land image, cordinates exist but document doesn't exist (CASE 3).
        if (Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && Farmer_Land_Location::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            // dd("image , coordinates but documents doesn't exists");
            $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();

            $land_document = 'not_exists';
            $land_image = 'exists';

            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;

            return view('frontend.training_partner.view_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document', 'coordinates'));
        }
        // dd('124');

        // when land image exists but documents and coordinates is not uploaded (CASE 4)

        if (Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;
            // dd('land image is uploaded but land doc is not uploaded');
            $land_image = 'exists';
            $land_document = 'not_exists';
            return view('frontend.training_partner.view_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'image_path', 'land_document'));
            // dd('executed from here!');
        }
        dd('123');

        // when land document is uploaded & land image is not uploaded (CASE 3)

        if (!Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
            // dd('land image is not uploaded but land doc is uploaded');
            // dd($document_path);
            $land_image = 'not_exists';
            $land_document = 'exists';
            return view('frontend.training_partner.view_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document', 'document_path'));
            // dd('executed from here!');
        }

        // when neither land document is uploaded nor land image is not uploaded (CASE 4)
        if (!Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            // dd('neither of them is uploaded');
            // $document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_images;
            // dd('land image is uploaded but land doc is not uploaded');
            // dd($document_path);
            $land_image = 'not_exists';
            $land_document = 'not_exists';
            return view('frontend.training_partner.view_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document'));
            // dd('executed from here!');
        }

        // when none of them exists (CASE 5)
        if (!Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists() && !Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists() && !Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            // dd('neither of them is uploaded');
            $land_image = 'not_exists';
            $land_document = 'not_exists';
            return view('frontend.training_partner.view_particular_approved_application', compact('application_details', 'id', 'id_exists', 'status', 'land_image', 'land_document'));
            // dd('executed from here!');
        }


        if (Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();
            return view('frontend.training_partner.view_application_and_physical_verify', compact('application_details', 'id', 'id_exists', 'status', 'coordinates'));
        }
    }

    /*************************************************** Methods for training_partner ends here ***************************************************/

    /*************************************************** Methods for director starts here ***************************************************/

    public function all_applications_for_director()
    {
        $name = Auth::user()->name;
        $districts = Tripura::select('district')->distinct()->get();
        $all_applications = Farmer_Application::all();

        $data = [
            'name' => $name,
            'all_applications' => $all_applications,
            'districts' => $districts
        ];

        // Return the view with data
        return view('frontend.director.show_applications_to_director', $data);
        // return view('new_application.new_application_page_3', compact('districts', 'ration_card_number'));

    }

    public function application_filter_for_director(Request $request)
    {
        // dd($request->all());
        $district = $request->district;
        // dd($district);
        $sub_division = $request->sub_division;
        $block = $request->block;
        $ward_gp_vc = $request->ward_gp_vc;

        $all_applications_after_filter = 0;

        // this will be executed when user has selected nothing
        if ($district == "Select District") {
            $all_applications_after_filter = Farmer_Application::all()
                ->where('status', '>', 0);
            // dd($all_applications_after_filter);
        } else {
            // this will be executed when user has selected district and nothing
            if ($sub_division == "Select Sub Division") {
                // dd('sub division not selected so select all sub division of that district');
                $all_applications_after_filter = Farmer_Application::where('district', $district)
                    ->where('status', '>', 0)
                    ->get();
                // dd($all_applications_after_filter);
            } else {
                // this will be executed when user has selected district and sub division
                if ($block == "Select Block") {
                    // dd('block is not selected so select all block with respect to the sub division');
                    $all_applications_after_filter = Farmer_Application::where('district', $district)
                        ->where('sub_division', $sub_division)
                        ->get();
                    // dd($all_applications_after_filter);
                } else {
                    // this will be executed when user has selected district, sub division and block
                    if ($ward_gp_vc == "Select Ward") {
                        // dd('ward gp vc is not selected so select all ward gp vc with respect to the block');
                        $all_applications_after_filter = Farmer_Application::where('district', $district)
                            ->where('sub_division', $sub_division)
                            ->where('block', $block)
                            ->get();
                        // dd($all_applications_after_filter);
                    } else {
                        // dd('in this part');
                        $all_applications_after_filter = Farmer_Application::where('district', $district)
                            ->where('sub_division', $sub_division)
                            ->where('block', $block)
                            ->where('ward_gp_vc', $ward_gp_vc)
                            ->get();
                    }
                }
            }
        }
        // if ($all_applications_after_filter === null) {
        //     dd('nothing found upore');
        // } else {
        //     $count = $all_applications_after_filter->count();
        // }

        $count = $all_applications_after_filter->count();

        // $all_applica
        // dd($all_applications_after_filter);

        return $this->application_filter_for_director_nested($all_applications_after_filter, $count);


        dd($all_applications_after_filter);
    }

    public function application_filter_for_director_nested($all_applications_after_filter = 0, $count = 0)
    {
        // dd($all_applications_after_filter);
        $name = Auth::user()->name;
        $districts = Tripura::select('district')->distinct()->get();
        $all_applications = $all_applications_after_filter;
        $success_message = $count . " results found!";

        $data = [
            'name' => $name,
            'districts' => $districts,
            'all_applications' => $all_applications,
            'success_message' => $success_message,
        ];

        return view('frontend.director.show_applications_to_director', $data);
    }

    public function dashboard_for_all()
    {
        return view('dashboard');
    }
    //#####################################################################################################################

    //******************************Dashboard For Director **********       NEW UPDATE       ******************************//

    //#####################################################################################################################
    public function dashboard_for_director()
    {
    //######################################################### Making Chart of Training Enrolled and Complete Based on District ########################################################################//
    $training_batch = DB::select("SELECT training_under, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS enrolled_training_batchs, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS complated_training_batchs FROM training_batches WHERE status IN (1,2) GROUP BY training_under;");
    $sub_division_officer = [];
    $enrolled_training = [];
    $training_complated = [];
   
    foreach($training_batch as $list){
        $sub_division_officer[]=$list->training_under;
        $enrolled_training[]=$list->enrolled_training_batchs;
        $training_complated[]=$list->complated_training_batchs;
       
    }
   //########################################### End Status Chart ##############################################

  //################## To make Area wise Chart( Approved Area{status=4}, Processing Area{submitted [status=1],verified[status=2],sent for approval[status=3]}, Rejected{status=5}) #####################################//


    $district_area = DB::select("SELECT district as area_district, SUM(CASE WHEN status IN (4,6,7,8) THEN farming_area_in_hectare ELSE 0 END) AS approved_farming_area, SUM(CASE WHEN status IN (1,2, 3) THEN farming_area_in_hectare ELSE 0 END) AS processing_farming_area,SUM(CASE WHEN status = 5 THEN farming_area_in_hectare ELSE 0 END) AS rejected_farming_area FROM farmer_applications GROUP BY district;");
    $area_district_name = [];
    $approved_area = [];
    $processing_area = [];
    $rejected_area = [];
    foreach($district_area as $list){
        $area_district_name [] = $list->area_district;
        $approved_area [] = $list->approved_farming_area;
        $processing_area [] = $list->processing_farming_area;
        $rejected_area [] = $list->rejected_farming_area;
    }
   //################################################ End of Area Chart #############################################
   //########################################  Status  Wise Application Chart amont all Application ########################################
    $application_status = DB::select("SELECT status, COUNT(*) as total_application FROM farmer_applications GROUP BY status");
    $application_count = [];
    $application_status_name =[];
    foreach($application_status as $list){
        $application_count [] = $list->total_application;
        if($list->status=='1'){
            $list->status = "Panding Applications";
        } else if($list->status=='2') {
            $list->status = "verified Applications";
        } else if($list->status=='3') {
            $list->status = " Applications sent for approval";
        } else if($list->status=='4') {
            $list->status = " Applications Approved";
        } else if($list->status=='5') {
            $list->status = " Applications Rejected";
        } else if($list->status=='6') {
            $list->status = " Applications enrolled for training";
        } else if($list->status=='7') {
            $list->status = " Applications training Completed";
        } else if($list->status=='8') {
            $list->status = " Go Green";
        }
        $application_status_name [] = $list->status;

    }
  //######################################################### End of status wise application ###############################
   //####################################################### Gender Wise application Chart ###################################

    // $gender_wise_application = DB::select("SELECT COUNT(*) as total_gender_application FROM farmer_applications GROUP BY gender");
    // $gender_wise_count = [];
    // foreach($gender_wise_application as $list){
    //     $gender_wise_count [] = $list->total_gender_application;

    // }
    //############################################################ End of Gender wise Application #############################
    //#######################################Date Based Applications Details ##################################

    $date_applications = DB::select("SELECT district, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count,SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) GROUP BY district ORDER BY district;");
       
     
    $date_based_district_name = [];
    $date_based_application_submitted = [];
    $date_based_application_physically_verified = [];
    $date_based_application_sent_for_approval = [];
    $date_based_application_approved = [];
    $date_based_application_rejected = [];
    $date_based_enroll_for_training = [];
    $date_based_training_complete = [];
    $date_based_plant_alloted =[];
    foreach($date_applications as $list){
        $date_based_district_name [] = $list->district;
        $date_based_application_submitted [] = $list->status_1_count;
        $date_based_application_physically_verified [] = $list->status_2_count;
        $date_based_application_sent_for_approval [] = $list->status_3_count;
        $date_based_application_approved [] = $list->status_4_count;
        $date_based_application_rejected [] = $list->status_5_count;
        $date_based_enroll_for_training [] = $list->status_6_count;
        $date_based_training_complete [] = $list->status_7_count;
        $date_based_plant_alloted [] = $list->status_8_count;
    }
    

//####################################### End Date Based Applications Details ############################
     $name ="Director";
     
        return view('frontend.director.dashboard',compact('name','sub_division_officer','enrolled_training','training_complated','application_count','application_status_name','area_district_name','approved_area','processing_area','rejected_area','date_based_district_name','date_based_application_submitted','date_based_application_physically_verified','date_based_application_sent_for_approval','date_based_application_approved','date_based_application_rejected','date_based_enroll_for_training','date_based_training_complete','date_based_plant_alloted'));
        //  dd($district);
   }
    //#############################################################################################################

 //**********************************************End Director Dashboard *************************************//

//##############################################################################################################################

//###################################################################################################
//***************************************** Start Officer Dashboard*********************************//
//##################################################################################################

public function dashboard_for_officer()
{
    $name = Auth::user()->name;
    $sub_division = AclRule::where('user_id', Auth::user()->id)->first()->sub_division;
 
    $application_status = DB::table('farmer_applications')
    ->select('status',
        DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count'),
        DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count'),
        DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count'),
        DB::raw('SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count'),
        DB::raw('SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count'),
        DB::raw('SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count'),
        DB::raw('SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count'),
        DB::raw('SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count'))
    ->where('status', '>=', 1)
    ->whereIn('status', [1, 2, 3, 4, 5, 6, 7, 8])
    ->where('sub_division', '=', $sub_division)
    ->groupBy('status')
    ->get();    

    
    // $application_status = DB::select("SELECT status, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count,SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND sub_division = $sub_division GROUP BY status;");
    $application_status_name =[];
    $status_based_application_submitted = [];
    $status_based_application_physically_verified = [];
    $status_based_application_sent_for_approval = [];
    $status_based_application_approved = [];
    $status_based_application_rejected = [];
    $status_based_enroll_for_training = [];
    $status_based_training_complete = [];
    $status_based_plant_alloted =[];
    foreach($application_status as $list){
        $status_based_application_submitted [] = $list->status_1_count;
        $status_based_application_physically_verified [] = $list->status_2_count;
        $status_based_application_sent_for_approval [] = $list->status_3_count;
        $status_based_application_approved [] = $list->status_4_count;
        $status_based_application_rejected [] = $list->status_5_count;
        $status_based_enroll_for_training [] = $list->status_6_count;
        $status_based_training_complete [] = $list->status_7_count;
        $status_based_plant_alloted [] = $list->status_8_count;
        if($list->status=='1'){
            $list->status = "submitted Applications";
        } else if($list->status=='2') {
            $list->status = "verified Applications";
        } else if($list->status=='3') {
            $list->status = " Applications sent for approval";
        } else if($list->status=='4') {
            $list->status = " Applications Approved";
        } else if($list->status=='5') {
            $list->status = " Applications Rejected";
        } else if($list->status=='6') {
            $list->status = " Applications enrolled for training";
        } else if($list->status=='7') {
            $list->status = " Applications training Completed";
        } else if($list->status=='8') {
            $list->status = " Go Green";
        }
        $application_status_name [] = $list->status;
    }

    $training_applications_batches = DB::select("SELECT status,COUNT(*) as total_applications_batches FROM training_batches GROUP BY status");
    $training_batches = [];
    $training_batches_status = [];
    foreach($training_applications_batches as $list){
        $training_batches [] = $list->total_applications_batches;
        if($list->status=='1'){
            $list->status = "New Enrolled Training Batches";
        } else {
            $list->status = "Completed Training Batches";
        }
        $training_batches_status [] = $list->status;
    }

    return view('frontend/officer/officer_dashboard',compact('name','sub_division','application_status_name','status_based_application_submitted','status_based_application_physically_verified','status_based_application_sent_for_approval','status_based_application_approved','status_based_application_rejected','status_based_enroll_for_training','status_based_training_complete','status_based_plant_alloted','training_batches','training_batches_status'));

}

//###################################################################################################
//***************************************** End Officer Dashboard*********************************//
//##################################################################################################
//**************************************************** Dashboard for Training Partner ********************************/
public function dashboard_for_training_partner(){
    $name = Auth::user()->name;
    $role = Auth::user()->Role();

 if($role=='training_partner_patanjali'){
    $date_applications = DB::select("SELECT district, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count,SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati') GROUP BY district ORDER BY district;");
 } else {
    $date_applications = DB::select("SELECT district, SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count,SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('North', 'Unakoti', 'Dhalai') GROUP BY district ORDER BY district;");
 } 
     
    $date_based_district_name = [];
    $date_based_application_submitted = [];
    $date_based_application_physically_verified = [];
    $date_based_application_sent_for_approval = [];
    $date_based_application_approved = [];
    $date_based_application_rejected = [];
    $date_based_enroll_for_training = [];
    $date_based_training_complete = [];
    $date_based_plant_alloted =[];
    foreach($date_applications as $list){
        $date_based_district_name [] = $list->district;
        $date_based_application_submitted [] = $list->status_1_count;
        $date_based_application_physically_verified [] = $list->status_2_count;
        $date_based_application_sent_for_approval [] = $list->status_3_count;
        $date_based_application_approved [] = $list->status_4_count;
        $date_based_application_rejected [] = $list->status_5_count;
        $date_based_enroll_for_training [] = $list->status_6_count;
        $date_based_training_complete [] = $list->status_7_count;
        $date_based_plant_alloted [] = $list->status_8_count;
    }

    return view('frontend.training_partner.dashboard',compact('name','date_based_district_name','date_based_application_submitted','date_based_application_physically_verified','date_based_application_sent_for_approval','date_based_application_approved','date_based_application_rejected','date_based_enroll_for_training','date_based_training_complete','date_based_plant_alloted'));
}

//****************************************************End Dashboard for Training Partner ********************************/

    public function view_particular_application_for_director($id)
    {
        $application_details = Farmer_Application::where('id', $id)->first();

        $status = $application_details->status;

        $id_exists = 0;

        // checking if pri sheet exists then storing the path in the variable else storing 1
        if (PRI_Approval_Sheets::where('farmer_applications_id', $id)->exists()) {
            $pri_sheet_path = PRI_Approval_Sheets::where('farmer_applications_id', $id)->first()->pri_approval_sheet_path;
            // dd($pri_sheet_path);
        } else {
            $pri_sheet_path = 'not_exists';
        }

        // checking if land documents exists then storing the path in the variable else storing 1
        if (Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->exists()) {
            $land_document_path = Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path;
            // dd($land_document_path);
        } else {
            $land_document_path = 'not_exists';
        }

        // checking if land image exists then storing the path in the variable else storing 1
        if (Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->exists()) {
            $image_path = Upload_Farmer_Land_Images::where('farmer_applications_id', $id)->first()->farmer_land_images;
            // dd($image_path);
        } else {
            $image_path = 'not_exists';
        }

        // checking if coordinates exists then storing the path in the variable else storing 1
        if (Farmer_Land_Location::where('farmer_applications_id', $id)->exists()) {
            $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();
            // dd($coordinates);
        } else {
            $coordinates = 'not_exists';
        }

        // if(Upload_Farmer_Land_Documents::where('farmer_applications_id', $id)->first()->farmer_land_documents_path

        return view('frontend.director.view_particular_application', compact('application_details', 'id', 'id_exists', 'status', 'coordinates', 'pri_sheet_path', 'land_document_path', 'image_path'));
    }
}
