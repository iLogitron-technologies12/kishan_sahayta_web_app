<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FromRegistrationController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FarmerRegistrationController;
use App\Http\Controllers\FarmerApplicationController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DisbursementController;
use App\Http\Controllers\SuperAdminController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class, 'login_page'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
//Route for Forgot password page
Route::get('/forgot-password',[LoginController::class,'forgot_password'])->name('forgot-password');
Route::post('/forgot-password',[LoginController::class,'check_forgot_password_otp'])->name('check-otp');
//Route for generate OTP
Route::get('/generate-otp-for-forget-password',[LoginController::class,'generate_otp_for_forgot_password']);
//Route for change Password page
Route::get('/change-forgot-password',[LoginController::class,'change_forgot_password'])->name('change-forgot-password');
Route::post('/change-forgot-password',[LoginController::class,'recreate_password'])->name('recreate-password');


Route::get('/', [HomeController::class, 'index']);

/* ****************************************** **********Routes for super admin part ********** ********************************************** */

// Dashboard that will be only accessed by officer
Route::middleware(['request-filter'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');
    // Route::get('/officer/application-filter', [FarmerApplicationController::class, 'officer_applications'])->name('officer.application_filter');

});

























































































/******************************************* **********Routes for new application ********** ********************************************** */


// new application page for farmer (1st Page)
Route::get('/new-application/step1', [FarmerApplicationController::class, 'new_application'])->name('new-application');
Route::post('/new-application/step1', [FarmerApplicationController::class, 'post_step1'])->name('new-application.step1');


// new application second page for farmer
Route::get('/new-application/step2/{id}', [FarmerApplicationController::class, 'post_step2_application'])->name('new-application.new-application-page-2');
Route::post('/new-application/step2/{id}', [FarmerApplicationController::class, 'post_step2'])->name('new-application.step2');


//  new application third (or final page for farmer)
Route::get('/new-application/step3/{id}', [FarmerApplicationController::class, 'post_step3_application'])->name('new-application.new-application-page-3');
Route::post('/new-application/step3/{id}', [FarmerApplicationController::class, 'post_step3']);


/******************************************* **********Routes for new application ends here ********** ********************************************** */



/******************************************* **********Routes for track application  ********** ********************************************** */


// track application enter phone number
Route::get('/track-application', [FarmerApplicationController::class, 'track_application'])->name('track-application');
Route::post('/track-application', [FarmerApplicationController::class, 'track_application_check_if_phone_number_exists']);


// track application enter otp and validating
Route::get('/track-application/enter-otp/{phone_number}', [FarmerApplicationController::class, 'track_application_enter_otp'])->name('track-application.enter-otp');
Route::post('/track-application/enter-otp/{phone_number}', [FarmerApplicationController::class, 'track_application_verify_entered_otp']);


// view application if saved
Route::get('/track-application/view-application/{id}', [FarmerApplicationController::class, 'track_application_view_application'])->name('track-application.view-application');
Route::post('/track-application/view-application/{id}', [FarmerApplicationController::class, 'track_application_submit_application']);


/******************************************* **********Routes for track application ends here  ********** ********************************************** */


// Route::post('/new-application/step2',[FarmerApplicationController::class,'post_step2'])->name('new-application.step2');
// Route::post('/new-application/step2',[FarmerApplicationController::class,'post_step2']);


// on clicking next after validating otp
// Route::get('/new-application-otp',[FarmerApplicationController::class,'on_clicking_next_after_validating_otp'])->name('new-application-otp');


/******************************************** Using AJAX for filtering in application form  ****************************************************** */
//All sub-divisions
Route::get('/all-sub-divisions', [RegisterController::class, 'get_sub_divisions']);

//All blocks
Route::get('/all-blocks', [RegisterController::class, 'get_blocks']);

// All Wards/ GP /VC
Route::get('/all-wards-gp-vc', [RegisterController::class, 'get_wards_gp_vc']);

/******************************************* Using AJAX for filtering in application form ends here ********************************************** */


/******************************************* **********Routes for role officer ********** ********************************************** */

// filtering application for officer
// Route::post('/application-filter-for-officer',[FarmerApplicationController::class,'application_filter_for_officer'])->name('application-filter-for-officer');
Route::post('/officer/application-filter', [FarmerApplicationController::class, 'application_filter_for_officer']);

// for viewing and approving application from officer role
// Route::get('/view-application-approve-o/{id}', [FarmerApplicationController::class, 'view_application_and_approve_by_officer'])->name('view-application-approve-o');
Route::get('/officer/view-application-approve/{id}', [FarmerApplicationController::class, 'view_application_and_approve_by_officer'])->name('officer.view_application_approve');

// uploading PRI Approval sheet
Route::post('/officer/view-application-approve/{id}', [FarmerApplicationController::class, 'upload_pri_approval_sheet_by_officer']);

Route::get('/print-application/{id}', [FarmerApplicationController::class, 'print_application_for_officer']);

Route::get('/change-password', [RegisterController::class, 'change_password'])->name('change-password');

Route::get('/profile', [RegisterController::class, 'profile'])->name('profile');

//################################################################ NEW ADDITION at 10.02.2024 #########################################
Route::get('/officer/view-disbursement/{id}',[DisbursementController::class,'viewDisbursement'])->name('officer.view_disbursement');

Route::post('/officer/save-disbursement/{id}',[DisbursementController::class,'saveDisbursement'])->name('officer.save_disbursement');

Route::get('/officer/view-manage-training',[DisbursementController::class,'viewManageTraining'])->name('officer.view-manage-training');

Route::post('/officer/view-manage-training',[DisbursementController::class,'savetrainingData'])->name('officer.save-training');

Route::post('/officer/approve-training-status/{id}',[DisbursementController::class,'approve_training_status'])->name('officer.approve-training-status');

/******************************************* **********Routes for role officer ends here ********** ********************************************** */




/******************************************* **********Routes for training_partner ********** ********************************************** */

// filtering applications for training_partner
Route::post('/application-filter-for-officer', [FarmerApplicationController::class, 'application_filter_for_officer']);


// for loading approved applications
Route::get('/training-partner/approved-applications', [FarmerApplicationController::class, 'training_partner_view_approved_applications']);

Route::get('/training-partner/all-others-applications', [FarmerApplicationController::class, 'training_partner_view_all_others_applications']);

//***** training_partner_view_forwarded_applications changed into training_partner_view_submitted_applications****Ujjal Sarkar**
// for loading Forwarded changed into submitted applications
Route::get('/training-partner/submitted-applications', [FarmerApplicationController::class, 'training_partner_view_submitted_applications']);


// for viewing and physical verifying
Route::get('training-partner/view-application-physical-verify/{id}', [FarmerApplicationController::class, 'training_partner_view_application_and_physical_verification'])->name('training_partner.view_application_physical_verify');

Route::post('training-partner/view-application-physical-verify/{id}', [FarmerApplicationController::class, 'training_partner_update_address_and_land_details'])->name('training_partner.update_address_and_land_details');

Route::post('/training-partner/physical-verify/{id}', [FarmerApplicationController::class, 'training_partner_update_to_physically_verified'])->name('training_partner.physical_verify');

Route::post('/training-partner/send-for-approval/{id}', [FarmerApplicationController::class, 'training_partner_update_to_sent_for_approval'])->name('training_partner.send_for_approval');

//  for uploading land images
Route::post('/training-partner/upload-land-images/{id}', [FarmerApplicationController::class, 'training_partner_upload_land_images'])->name('training_partner.upload_land_images');


// for uploading land documents
Route::post('/training-partner/upload-land-documents/{id}', [FarmerApplicationController::class, 'training_partner_upload_land_documents'])->name('training_partner.upload_land_documents');


// for filtering application for training partner in 'forwarded applications' changed into submitted applications
Route::post('/training-partner/sunmitted-application-filter', [FarmerApplicationController::class, 'training_partner_submitted_applications_filter'])->name('training_partner.submitted_application_filter');
//Route::get('/training-partner/application-filter', [FarmerApplicationController::class, 'training_partner_applications']);

Route::post('/training-partner/approved-application-filter', [FarmerApplicationController::class, 'training_partner_approved_applications_filter'])->name('training_partner.approved_application_filter');
//Route::get('/training-partner/application-filter', [FarmerApplicationController::class, 'training_partner_applications']);

// for viewing approved applications
Route::get('training-partner/view-approved-application/{id}', [FarmerApplicationController::class, 'training_partner_view_approved_application'])->name('training_partner.view_approved_application');

//For view profile of Training Partner***Ujjal Sarkar***
Route::get('/training-partner/profile',[UserController::class,'training_partner']);

/******************************************* **********Routes for training_partner ends here ********** ********************************************** */



/******************************************* **********Routes for director  ********** ********************************************** */


Route::get('/director/all-applications', [FarmerApplicationController::class, 'all_applications_for_director']);

Route::post('/director/application-filter', [FarmerApplicationController::class, 'application_filter_for_director'])->name('director.application_filter');

Route::get('/director/application-filter', [FarmerApplicationController::class, 'application_filter_for_director_nested']);

Route::get('/director/view-application/{id}', [FarmerApplicationController::class, 'view_particular_application_for_director']);






// Route::get('/new-application-otp',[FarmerApplicationController::class,'new_application_otp'])->name('new-application-otp');

// enter phone number
Route::get('/enter-phone-number', [RegisterController::class, 'enter_phone_number'])->name('enter-phone-number');
Route::post('/enter-phone-number', [RegisterController::class, 'submit_phone_number']);

// verify otp
Route::get('/verify-otp', [RegisterController::class, 'verify_otp_page'])->name('verify-otp')->name('verify-otp');
Route::post('/verify-otp', [RegisterController::class, 'verify_otp'])->name('verify-otp');


// success page
Route::get('/success', [HomeController::class, 'success'])->name('success');

//saved success
Route::get('/saved-success', [HomeController::class, 'saved_sucess'])->name('saved-success');

Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/farmer-registration', [FarmerRegistrationController::class, 'index']);
// Route::post('/farmer-registration', [FarmerRegistrationController::class, 'farmerdata']);
// Route::get('/farmers',function(){
//     $farmer=Farmer::all();
//     echo "<pre>";
//     print_r($farmer->toArray());
//     echo "</pre>";

// });

// for registering or adding officer
Route::get('register/officer', [RegisterController::class, 'register_officer'])->name('register.officer');

//fetch all sub-divisions for shoowing in dropdown
Route::get('/all-sub-divisions', [RegisterController::class, 'get_sub_divisions']);

Route::post('/director/register/officer', [RegisterController::class, 'register_officer_post']);


//for all users
Route::get('all-users', [UserController::class, 'all_users'])->name('all-users');

// edit user
Route::post('edit-user/{id}', [UserController::class, 'edit_user'])->name('edit-user');

//delete user
Route::post('delete-user/{id}', [UserController::class, 'delete_user'])->name('delete-user');

Route::get('name', [UserController::class, 'name'])->name('name');






/**************************************************************************************************************** */
// For Ground Staff



// Route::get('/g-dashboard',[FarmerApplicationController::class,'ground_staff_dashboard'])->name('g-dashboard');




// Dashboard that will be only accessed by officer
Route::middleware(['request-filter'])->group(function () {
    Route::get('/officer/applications', [FarmerApplicationController::class, 'officer_applications'])->name('applications');
    Route::get('/officer/application-filter', [FarmerApplicationController::class, 'officer_applications'])->name('officer.application_filter');


    //  For training partner
    // Route::get('training-partner/dashboard', [FarmerApplicationController::class, 'training_partner_forwarded_applications'])->name('training_partner.dashboard');
});
//######################################################################################################################
//#########################################################################################################################
//**************************************chart dashboard for Director,Officer and Training Partner**************************************************
Route::get('/director/dashboard',[FarmerApplicationController::class, 'dashboard_for_director']);

Route::get('/get-farmer-details-based-on-date',[DashboardController::class,'datechart']);

Route::get('/officer/dashboard',[FarmerApplicationController::class, 'dashboard_for_officer']);
//Route::get('/director/dashboard',[DashboardController::class,'dashboard_of_date_applications']);
Route::get('/get-farmer-all-details-for-officer',[DashboardController::class,'applications_dashboard_for_officer']);

Route::get('/training-partner/dashboard',[FarmerApplicationController::class,'dashboard_for_training_partner']);

Route::get('/get-farmer-details-based-on-date-for-training-partner',[DashboardController::class,'application_for_training_partner']);

// route for adding officer:

Route::get('officer/add-officer', [RegisterController::class, 'add_officer']);

//*****************New Route Addition***************27/12/2023******************************
Route::get('/director/add-officer', [RegisterController::class, 'add_officer']);
Route::post('/director/add-officer', [RegisterController::class, 'add_officer_in_table'])->name('director.add_officer');

Route::group(['middleware' => ['web']], function () {
Route::post('/director/update-details-officer', [RegisterController::class, 'update_details_of_officer'])->name('director.update_details');
Route::post('/director/delete-officer', [RegisterController::class, 'delete_officer'])->name('director.delete_details');
});
