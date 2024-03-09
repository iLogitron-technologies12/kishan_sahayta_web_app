<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\API\AddressApiController;
use App\Http\Controllers\API\RegistrationApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/data', [ApiController::class, 'getData']); // Demo API 
Route::get('/get-district',[AddressApiController::class,'getDistrict']); // API for get District Address of Tripura(District);

Route::get('/get-sub-division/{district}',[AddressApiController::class,'getSubDivision']); // API for get Sub-Division Address of Tripura(subdivision);

Route::get('/get-block/{subdivision}',[AddressApiController::class,'getBlock']); // API for get Block Address of Tripura(ulb);


Route::get('/address',[AddressApiController::class,'listAddress']); // API for get Address Data of Tripura(District,subdivision,block)

Route::get('/farmer-api-data/{role}',[RegistrationApiController::class,'getdata']);//API to create table of farmer data for Training Partner

Route::get('/farmer-all-data/{id}',[RegistrationApiController::class,'getAllData']);//API to create table of farmer data for Training Partner

Route::post('/farmer-api-registration',[RegistrationApiController::class,'adddata']);//Farmer's API Registration from Mobile API

Route::post('/update-farmer-data/{id}',[RegistrationApiController::class,'updateFarmerData']);//Farmer's Data Update API

Route::post('/applicant-verification/{id}',[RegistrationApiController::class,'verificationUpdate']);//Farmer's Data Update API

Route::Post('/upload-land-document/{id}',[RegistrationApiController::class,'uploadLandDocument']);//Farmer's Land Document Upload API

Route::Post('/upload-land-image/{id}',[RegistrationApiController::class,'uploadLandImage']);//Farmer's Land Image Upload API
//################################################ New API ################################################//

Route::Post('/login',[RegistrationApiController::class,'login_from_api']); //Login API Route

Route::get('/application-with-gis-location/{id}',[RegistrationApiController::class,'applications_with_gis_location']);

Route::post('/send-for-approval/{id}',[RegistrationApiController::class,'send_for_approval']);//Farmers applications send for approval API

Route::get('/farmer-api-submitted-verified-data/{role}',[RegistrationApiController::class,'submitted_and_verified']);//API to create table of farmer submitted and verified data for Training Partner

Route::get('/farmer-api-all-others-data/{role}/{district?}/{subdivision?}', [RegistrationApiController::class, 'all_others_farmers_applications']);

Route::get('/district-for-training-partnar/{role}',[RegistrationApiController::class,'district_for_training_partner']); //District API For training partner