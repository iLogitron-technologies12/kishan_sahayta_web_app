<?php

namespace App\Http\Controllers;
use App\Models\Farmer_Application;
use Illuminate\Http\Request;
use App\Models\Disbursement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TrainingBatch;
class DisbursementController extends Controller
{
    public function viewDisbursement($id){
        $application_details = Farmer_Application::where('id', $id)->first();
        $disbursement_details = Disbursement::where('application_id',$id)->get();
        $totalAreaValue = Disbursement::where('application_id', $id)->sum('disbursed_area');
        $name = Auth::user()->name;
        return view('frontend.officer.disbursement',compact('name','application_details','disbursement_details','totalAreaValue'));
    }
    public function saveDisbursement(Request $request, $id){
        // dd($request);
         $Disbursed = new Disbursement;
         $Disbursed->application_id = $id;
         $Disbursed->number_of_plants = $request->plant_nos;
         $Disbursed->disbursed_area = $request->cultivation_area;
         $Disbursed->disbursed_date = $request->disbursed_date;
         $Disbursed->status=1;
         $disbursment=$Disbursed->save();
         if ($disbursment) {
            return redirect()->back()->with('success', 'Well Done! The Applicants Application Disbursement Successfully!!');
        } else {
            return redirect()->back()->with('error', 'Something Wents Wrong!');
        }
    }
    public function viewManageTraining(){
        $name = Auth::user()->name;
        // $application_details = Farmer_Application::where('status', 4)->first(); 
        $application_details = DB::select("SELECT id,name_of_applicant,application_id FROM farmer_applications where status='4'");

         //$training_batch = DB::select("SELECT id as tid,application_id as training_applicant,applicant_batch_name,training_start_date,training_end_date  FROM training_batches");
         $training_batches_details = DB::select("SELECT training_batches.*, ( SELECT GROUP_CONCAT(name_of_applicant) FROM farmer_applications WHERE FIND_IN_SET(farmer_applications.id, training_batches.application_id) > 0 ) as applicants FROM training_batches ORDER BY id DESC;");
     
        return view('frontend.officer.training',compact('application_details','name','training_batches_details'));

    }
    public function savetrainingData(Request $request) {
        $name = Auth::user()->name;
        $applicants = $request->input('applicant');
        $Training = new TrainingBatch;
        $Training->application_id = implode(',',$applicants); // If you need to store as string
        $Training->applicant_batch_name = $request->batch; // corrected typo
        $Training->training_under = $name;
        $Training->training_start_date = $request->start_date;
        $Training->training_end_date = $request->end_date;
        $Training->status = 1;
        $saveBatch = $Training->save();
     if($saveBatch){
        foreach ($applicants as $applicantId) {
            $application_verify = Farmer_Application::where('id', $applicantId)->first();
            $application_verify->status = 6;
            $verify = $application_verify->save();
        }
     
        if ($saveBatch && $verify) {
            return redirect()->back()->with('success', 'Well Done! The Applicants are Selected for Training.');
        } else {
            return redirect()->back()->with('error', 'Something Wents Wrong!');
        }
    }
    
    }

    public function approve_training_status(Request $request, $id) {
        $applicants = explode(',', $request->input('training_applicant'));
        
        foreach ($applicants as $applicantId) {
            $application_verify = Farmer_Application::where('id', $applicantId)->first();
            if ($application_verify) {
                $application_verify->status = 7;
                $verify = $application_verify->save();
                if (!$verify) {
                    return redirect()->back()->with('error', 'Something went wrong!');
                }
            } else {
                return redirect()->back()->with('error', 'Application not found!');
            }
        }
        if($verify){
            $training_status = TrainingBatch::where('id', $id)->first();
            $training_status->status = 2;
            $update_status = $training_status->save();
            if($update_status){
               return redirect()->back()->with('success', 'Well Done! The Applicants are approved for Training.');
            }

            
        }
    }

    
}
