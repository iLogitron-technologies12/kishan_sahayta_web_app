<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmer_Application;
use App\Models\User;
use Validator;

use App\Models\Farmer_Land_Location;
use App\Models\Upload_Farmer_Land_Images;
use App\Models\Temp_Data_of_Applications;
use App\Models\Upload_Farmer_Land_Documents;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class RegistrationApiController extends Controller
{
 
//################################################# Start Login Api Function ######################//
public function login_from_api(Request $request){
    $login_rules = array(
       'email'=>'required',
       'password'=>'required'
    );
    $login_response = [];
    $validator = Validator::make($request->all(),$login_rules);
    if($validator->fails()){ //if validation failed
        $login_response ['flag'] = 0;
        $validator_fail =['error' => $validator->errors()];
        $login_response ['message'] = $validator_fail;
        return $login_response;
    } else { //after inputed data validation validation 
        if (Auth::attempt($request->only('email', 'password'))) { 
            $user = Auth::user();
            $role = optional($user)->Role();
            $name = $user->name;
            $id = $user->id;
             //when it is officer login data
            if ($role == 'officer') {
                $login_response ['flag'] = 1;
               $success = ['id' => $id, 'name' => $name, 'role' => $role];
               $login_response ['message'] = $success;
                return $login_response;
            } elseif ($role == 'training_partner_patanjali' || $role == 'training_partner_godrej') {
                // when it is training partner login data
                $login_response ['flag'] = 1;
               $success = ['id' => $id, 'name' => $name, 'role' => $role];
               $login_response ['message'] = $success;
                return $login_response;
                
            } elseif ($role == 'director') {
                //when it is Director login data
                $login_response ['flag'] = 1;
               $success = ['id' => $id, 'name' => $name, 'role' => $role];
               $login_response ['message'] = $success;
                return $login_response;      
            } else {
                //when inputed data is invalid
                $login_response ['flag'] = 0;
               $error = ['error' => 'Invalid role'];
               $login_response ['message'] = $error;
                return $login_response;
            }
        } else {
            $login_response ['flag'] = 0;
            $error = ['error' => 'Invalid Email or password'];
            $login_response ['message'] = $error;
             return $login_response;
        }
    }
}
//########################################### District For Training Partner ###################################//
public function district_for_training_partner($role){
    $response = [];
    $response['flag']=1;
    if($role=='training_partner_patanjali'){
        $district = ['South Tripura'=>'South Tripura', 'West Tripura'=>'West Tripura','Khowai'=> 'Khowai', 'Sepahijala'=>'Sepahijala','Gomati'=> 'Gomati'];
        $response['message'] =$district;
        return $response;
     } else if($role =='training_partner_godrej'){
        $district =  ['North'=>'North', 'Unakoti'=>'Unakoti','Dhalai'=>'Dhalai'];
        $response['message'] =$district;
     }

}

   //################################################# Get Farmer data Api Function (demo) ######################//
   public function getdata($role){
     if($role=='training_partner_patanjali'){
        return Farmer_Application::whereIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])->get();
     } else if($role =='training_partner_godrej'){
        return Farmer_Application::whereIn('district', ['North', 'Unakoti', 'Dhalai'])->get();
     }
}
//################################################# End Get  Farmer Api Function ######################//
//################################# Start Api for Submitted and verified Applications data ###########################//

public function submitted_and_verified($role){
    if($role == 'training_partner_patanjali'){
        return Farmer_Application::whereIn('district', ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'])
            ->whereIn('status', [1, 2])
            ->orderByDesc('created_at')
            ->get();
    } else if($role == 'training_partner_godrej'){
        return Farmer_Application::whereIn('district', ['North', 'Unakoti', 'Dhalai'])
            ->whereIn('status', [1, 2])
            ->orderByDesc('created_at')
            ->get();
    }
}

//################################# End Api for Submitted and verified Applications data ###########################//
//################################# Start Api for all others Applications data ###########################//


public function all_others_farmers_applications($role, $district = null, $subdivision = null)
{
    if ($role == 'training_partner_patanjali') {
        $districts = $district ? (array)$district : ['South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati'];
    } elseif ($role == 'training_partner_godrej') {
        $districts = $district ? (array)$district : ['North', 'Unakoti', 'Dhalai'];
    } else {
        // Handle invalid role here if needed
        return response()->json(['error' => 'Invalid role'], 400);
    }

    $query = Farmer_Application::whereIn('district', $districts)
        ->whereIn('status', [3, 4, 5, 6, 7, 8]);

    if ($subdivision) {
        // If subdivision is provided, include it in the query
        $query->whereIn('sub_division', (array)$subdivision);
    }

    return $query->orderByDesc('created_at')->get();
}



//################################# End Api for all others Applications data ###########################//


//################################################# Start Login Api Function ######################//

//################################################# Get All Farmer data Api Function ######################//

    public function getAllData($id){
        $farmerApplication = Farmer_Application::find($id);
        if ($farmerApplication) {
            $farmerApplication->ration_card_image_path = 'https://tripura.cloud/storage/' . $farmerApplication->ration_card_image_path;
            $farmerApplication->any_supporting_land_document_path = 'https://tripura.cloud/storage/' . $farmerApplication->any_supporting_land_document_path;
        }
        return $farmerApplication; 
    }
   //################################################# End Get All Farmer data Api Function ######################//
   //################################################# Get All Farmer Data with GIS Location ######################//

   public function applications_with_gis_location($id){
    $response = []; // Initialize an empty array to hold the response data
    $response['flag'] = 1;
    // Get farmer application data
    $farmerApplication = Farmer_Application::find($id);
    if ($farmerApplication) {
        // Update image paths
        $farmerApplication->ration_card_image_path = 'https://tripura.cloud/storage/' . $farmerApplication->ration_card_image_path;
        $farmerApplication->any_supporting_land_document_path = 'https://tripura.cloud/storage/' . $farmerApplication->any_supporting_land_document_path;

        // Add farmer application data to the response array
        $response['farmer_application'] = $farmerApplication;
    }

    // Get coordinates data
    $coordinates = Farmer_Land_Location::where('farmer_applications_id', $id)->first();
    if ($coordinates) {
        // Add coordinates data to the response array
        $response['location'] = $coordinates;
    }

    // Return the combined data
    return $response; 
}
//################################################# End Get All Farmer data with GIS Location ######################//
 //################################################# Start Post for farmer registration Api Function ######################//

    public function adddata(Request $request){
        $rules=array(
            'name_of_applicant'=>'required',
            'phone_number'=>'required',
            'district' => 'required',
            'ration_no' => 'required',
            'sub_division' => 'required',
            'block' => 'required',
            'complete_address' => 'required',
            'ttaadc_area' => 'required',
            'farming_area_in_acre' => 'required',
            'bank_name' => 'required',
            'beneficiary_name' => 'required',
            'account_number' => 'required',
            'confirm_account_number' => 'required | same:account_number',
            'ifsc_code' => 'required',
            'land_type' => 'required'    
        
    );
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
        return $validator->errors();
    } 
    else
    {
        $users = new User;
        $users->name = $request->name_of_applicant;
        $users->mobile_no = $request->phone_number;
        $users->ration_no = $request->ration_card_number;
        $users->password = Hash::make('test@123');
        $users_save = $users->save();
        // $application_details_from_temp_data = Temp_Data_of_Applications::where('id', $id)->first();
        $application_id = strtoupper(substr($request->district, 0, 3)).strtoupper(substr($request->sub_division, 0, 3)).rand(100000, 999999);
    
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




        $farmer_Application= new Farmer_Application;
        $farmer_Application->application_id=$application_id;
        $farmer_Application->name_of_applicant=$request->name_of_applicant;
        $farmer_Application->gender=$request->gender;
        $farmer_Application->user_id=$users->id;
        $farmer_Application->husband_fathers_name=$request->husband_fathers_name;
        $farmer_Application->email_id=$request->email_id;
        $farmer_Application->phone_number=$request->phone_number;
        $farmer_Application->ration_no=$request->ration_no;
        $farmer_Application->district=$request->district;
        $farmer_Application->sub_division=$request->sub_division;
        $farmer_Application->block=$request->block;
        $farmer_Application->complete_address=$request->complete_address;
        $farmer_Application->ttaadc_area=$request->ttaadc_area;
        $farmer_Application->farming_area_in_acre=$request->farming_area_in_acre;
        $farmer_Application->bank_name=$request->bank_name;
        $farmer_Application->beneficiary_name=$request->beneficiary_name;
        $farmer_Application->account_number=$request->account_number;
        $farmer_Application->confirm_account_number=$request->confirm_account_number;
        $farmer_Application->ifsc_code=$request->ifsc_code;
        $farmer_Application->land_type=$request->land_type;
        $farmer_Application->ration_card_image_path=$image_path;
        $farmer_Application->any_supporting_land_document_path=$file_path;
        $farmer_Application->status=1;
        $farmer_Application->added_by=Auth::user() ? Auth::user()->id : 0;

       $result= $farmer_Application->save();
       if($result){
        return response()->json(['message' => 'The Data has been uploaded successfully']);
       } else {
        return response()->json(['message' => 'The Submission has been failed !']);
       }
    }
    }
 //################################################# End Post for farmer registration Api Function ######################//

    public function updateFarmerData(Request $request, $id){
        $application = Farmer_Application::where('id', $id)->first();


        $application->complete_address = $request->complete_address;
        $application->ttaadc_area = $request->ttaadc_area;
        $application->land_type = $request->land_type;
        $application->farming_area_in_acre = $request->farming_area_in_acre;
        $update = $application->save();

        if($update){
            return response()->json(['message' => 'The Data has been updated successfully']);
           } else {
            return response()->json(['message' => 'Data Update has been failed !']);
           }
    }

    public function verificationUpdate(Request $request, $id){
        $application_verify = Farmer_Application::where('id', $id)->first();
        $application_verify->status = 2;
        $verify=$application_verify->save();
        $location=Farmer_Land_Location::create([
            'farmer_applications_id' => $application_verify->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        if($verify && $location){
            return response()->json(['message' => 'Application Verified successfully']);
           } else {
            return response()->json(['message' => 'Verification fail !']);
           }

    }

    public function uploadLandDocument(Request $request, $id){
        $application = Farmer_Application::where('id', $id)->first();
        $folder_path = 'public/land_document/' . $application->application_id;

        $image = $request->file('file');
        $image_extension = $image->getClientOriginalExtension();
        $image_name = time() . '.' . $image_extension;
        $image_path = $folder_path . '/' . $image_name;
        // dd($image_path);

        $image->storeAs($folder_path, $image_name, 'public');

       $upload_land_doc = Upload_Farmer_Land_Documents::create([
            'farmer_applications_id' => $id,
            'farmer_land_documents_path' => $image_path,
        ]);
       return ["result"=>$upload_land_doc];
       
    }
    public function uploadLandImage(Request $request, $id){
        $application = Farmer_Application::where('id', $id)->first();
        $folder_path = 'public/land_images/' . $application->application_id;

        $image = $request->file('file');
        $image_extension = $image->getClientOriginalExtension();
        $image_name = time() . '.' . $image_extension;
        $image_path = $folder_path . '/' . $image_name;
        // dd($image_path);

        $image->storeAs($folder_path, $image_name, 'public');

       $upload_land_doc = Upload_Farmer_Land_Images::create([
            'farmer_applications_id' => $id,
            'farmer_land_images' => $image_path,
        ]);
       return ["result"=>$upload_land_doc];
       
    }

    //#############################Send for Approval ###########################################//
    public function send_for_approval($id){
        $application_send_for_approval = Farmer_Application::where('id', $id)->first();
        $application_send_for_approval->status = 3;
        $send=$application_send_for_approval->save();
        $response = [];
        $response['flag']=1;
        if($send){
           $success = ['message' => 'Application Verified successfully'];
           $response['message']=$success;
            return $response;
           } else {
            $error = ['message' => 'Verification fail !'];
            $response['message']=$error;
             return $response;
           }

    }
    

}
