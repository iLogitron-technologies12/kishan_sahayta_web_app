<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AclRule;
use App\Models\Farmer_Application;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard');

    }
          //#################################################### Dashboard for Director Change based on date,month and year#####################################
    public function datechart(Request $request)
    {
        // Retrieve data based on the request parameters
        $date = $request->input('date');
        $category = $request->input('filterType');
        $dateParts = explode('-', $date); // Split the date into an array based on the '-' delimiter
        $year = $dateParts[0]; // Year is the first element
        $month = $dateParts[1]; // Month is the second element
        

          if($category=='1') {
            $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND created_at LIKE '%$date%' GROUP BY district ORDER BY district;");
            
          } else if($category=='2') {
            $monthdate = $year."-".$month;
            $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND created_at LIKE '%$monthdate%' GROUP BY district ORDER BY district;");
            
          } else if($category=='3') {
        
            $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND created_at LIKE '%$year%' GROUP BY district ORDER BY district;");
            
          }
           else {
            $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) GROUP BY district ORDER BY district;");
        }
           $date_based_district_name = [];
           $date_based_application_Pandding = [];
           $date_based_application_physically_verified = [];
           $date_based_application_sent_for_approval = [];
           $date_based_application_approved = [];
           $date_based_application_rejected = [];

           $date_based_enroll_for_training = [];
           $date_based_training_complete = [];
            $date_based_plant_alloted =[];
           
          
        foreach($date_applications as $list){
                     $date_based_district_name [] = $list->district;
                     $date_based_application_Pandding [] = $list->status_1_count;
                     $date_based_application_physically_verified [] = $list->status_2_count;
                     $date_based_application_sent_for_approval [] =$list->status_3_count;
                     $date_based_application_approved [] = $list->status_4_count;
                     $date_based_application_rejected  [] = $list->status_5_count;
                     $date_based_enroll_for_training [] = $list->status_6_count;
                     $date_based_training_complete [] = $list->status_7_count;
                    $date_based_plant_alloted [] = $list->status_8_count;
                 }
                 $responseData['date_based_district_name'] = $date_based_district_name;
                 $responseData['date_based_application_Pandding'] = $date_based_application_Pandding;
                 $responseData['date_based_application_physically_verified'] = $date_based_application_physically_verified;
                 $responseData['date_based_application_sent_for_approval'] = $date_based_application_sent_for_approval;
                 $responseData['date_based_application_approved'] = $date_based_application_approved; 
                 $responseData['date_based_application_rejected'] = $date_based_application_rejected; 
 
                 $responseData['date_based_enroll_for_training'] = $date_based_enroll_for_training;
                 $responseData['date_based_training_complete'] = $date_based_training_complete;
                $responseData['date_based_plant_alloted'] =  $date_based_plant_alloted;
             

        // Return the response as JSON
        return response()->json($responseData);
        
    }
    //############################################## End of Director Dashboard ######################################
    //##############################    **** Start Officer Dashboard for To get Data Based on Date,Month and Year ########################
    public function applications_dashboard_for_officer(Request $request){



      $name = Auth::user()->name;
      $sub_division = AclRule::where('user_id', Auth::user()->id)->first()->sub_division;
       // Retrieve data based on the request parameters
       $date = $request->input('date');
       $category = $request->input('filterType');
       $dateParts = explode('-', $date); // Split the date into an array based on the '-' delimiter
       $year = $dateParts[0]; // Year is the first element
       $month = $dateParts[1]; // Month is the second element
       $subDivisionFilter = "AND sub_division = '$sub_division'";

         if($category=='1') {
           $date_applications = DB::select("SELECT status,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND created_at LIKE '%$date%' $subDivisionFilter GROUP BY status ORDER BY status;");
           
         } else if($category=='2') {
           $monthdate = $year."-".$month;
           $date_applications = DB::select("SELECT status,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND created_at LIKE '%$monthdate%' $subDivisionFilter GROUP BY status ORDER BY status;");
           
         } else if($category=='3') {
       
           $date_applications = DB::select("SELECT status,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND created_at LIKE '%$year%' $subDivisionFilter GROUP BY status ORDER BY status;");
           
         }
          else {
           $date_applications = DB::select("SELECT status,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) $subDivisionFilter GROUP BY status ORDER BY status;");
       }
       $application_status_name =[];
       $status_based_application_submitted = [];
       $status_based_application_physically_verified = [];
       $status_based_application_sent_for_approval = [];
       $status_based_application_approved = [];
       $status_based_application_rejected = [];
       $status_based_enroll_for_training = [];
       $status_based_training_complete = [];
       $status_based_plant_alloted =[];
       foreach($date_applications as $list){
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
         $responseFarmerData['status_based_application_submitted'] = $status_based_application_submitted;
         $responseFarmerData['status_based_application_physically_verified'] = $status_based_application_physically_verified;
         $responseFarmerData['status_based_application_sent_for_approval'] = $status_based_application_sent_for_approval;
         $responseFarmerData['status_based_application_approved'] = $status_based_application_approved;
         $responseFarmerData['status_based_application_rejected'] = $status_based_application_rejected;
         $responseFarmerData['status_based_enroll_for_training'] = $status_based_enroll_for_training;
         $responseFarmerData['status_based_training_complete'] = $status_based_training_complete;
         $responseFarmerData['status_based_plant_alloted'] = $status_based_plant_alloted;
         $responseFarmerData['application_status_name'] = $application_status_name;
         return response()->json($responseFarmerData);     
      
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
        $responseFarmerData['status_based_application_submitted'] = $status_based_application_submitted;
        $responseFarmerData['status_based_application_physically_verified'] = $status_based_application_physically_verified;
        $responseFarmerData['status_based_application_sent_for_approval'] = $status_based_application_sent_for_approval;
        $responseFarmerData['status_based_application_approved'] = $status_based_application_approved;
        $responseFarmerData['status_based_application_rejected'] = $status_based_application_rejected;
        $responseFarmerData['status_based_enroll_for_training'] = $status_based_enroll_for_training;
        $responseFarmerData['status_based_training_complete'] = $status_based_training_complete;
        $responseFarmerData['status_based_plant_alloted'] = $status_based_plant_alloted;
        $responseFarmerData['application_status_name'] = $application_status_name;
        return response()->json($responseFarmerData);
        
    }
      //############################################## End of Officer Dashboard ######################################

      public function application_for_training_partner(Request $request)
    {
        // Retrieve data based on the request parameters
        $date = $request->input('date');
        $category = $request->input('filterType');
        $dateParts = explode('-', $date); // Split the date into an array based on the '-' delimiter
        $year = $dateParts[0]; // Year is the first element
        $month = $dateParts[1]; // Month is the second element
        $name = Auth::user()->name;
        $role = Auth::user()->Role();
         if($role=='training_partner_patanjali'){
          if($category=='1') {
            $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati') AND created_at LIKE '%$date%' GROUP BY district ORDER BY district;"); 
          } else if($category=='2') {
            $monthdate = $year."-".$month;
            $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati') AND created_at LIKE '%$monthdate%' GROUP BY district ORDER BY district;"); 
          } else if($category=='3') {
            $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati') AND created_at LIKE '%$year%' GROUP BY district ORDER BY district;");    
          } else {
            $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('South Tripura', 'West Tripura', 'Khowai', 'Sepahijala', 'Gomati') GROUP BY district ORDER BY district;");    
          }
        } else {
            if($category=='1') {
                $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('North', 'Unakoti', 'Dhalai') AND created_at LIKE '%$date%' GROUP BY district ORDER BY district;"); 
              } else if($category=='2') {
                $monthdate = $year."-".$month;
                $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('North', 'Unakoti', 'Dhalai') AND created_at LIKE '%$monthdate%' GROUP BY district ORDER BY district;"); 
              } else if($category=='3') {
                $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('North', 'Unakoti', 'Dhalai') AND created_at LIKE '%$year%' GROUP BY district ORDER BY district;");    
              } else {
                $date_applications = DB::select("SELECT district,SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS status_1_count, SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS status_2_count,SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS status_3_count, SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) AS status_4_count,SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) AS status_5_count,SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS status_6_count,SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS status_7_count,SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS status_8_count FROM farmer_applications WHERE status IN (1,2,3,4,5,6,7,8) AND district IN ('North', 'Unakoti', 'Dhalai') GROUP BY district ORDER BY district;");    
              }

        }
          
           $date_based_district_name = [];
           $date_based_application_Pandding = [];
           $date_based_application_physically_verified = [];
           $date_based_application_sent_for_approval = [];
           $date_based_application_approved = [];
           $date_based_application_rejected = [];

           $date_based_enroll_for_training = [];
           $date_based_training_complete = [];
            $date_based_plant_alloted =[];
           
          
        foreach($date_applications as $list){
                     $date_based_district_name [] = $list->district;
                     $date_based_application_Pandding [] = $list->status_1_count;
                     $date_based_application_physically_verified [] = $list->status_2_count;
                     $date_based_application_sent_for_approval [] =$list->status_3_count;
                     $date_based_application_approved [] = $list->status_4_count;
                     $date_based_application_rejected  [] = $list->status_5_count;
                     $date_based_enroll_for_training [] = $list->status_6_count;
                     $date_based_training_complete [] = $list->status_7_count;
                    $date_based_plant_alloted [] = $list->status_8_count;
                 }
                 $responseData['date_based_district_name'] = $date_based_district_name;
                 $responseData['date_based_application_Pandding'] = $date_based_application_Pandding;
                 $responseData['date_based_application_physically_verified'] = $date_based_application_physically_verified;
                 $responseData['date_based_application_sent_for_approval'] = $date_based_application_sent_for_approval;
                 $responseData['date_based_application_approved'] = $date_based_application_approved; 
                 $responseData['date_based_application_rejected'] = $date_based_application_rejected; 
 
                 $responseData['date_based_enroll_for_training'] = $date_based_enroll_for_training;
                 $responseData['date_based_training_complete'] = $date_based_training_complete;
                $responseData['date_based_plant_alloted'] =  $date_based_plant_alloted;
             

        // Return the response as JSON
        return response()->json($responseData);
        
    }
    
}
