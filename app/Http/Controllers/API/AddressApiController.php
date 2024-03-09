<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tripura;

class AddressApiController extends Controller
{
   public function listAddress(){
    return Tripura::all();
   }
   //******************************* Get District Names For API ****************************//
   public function getDistrict(){
      $districts = Tripura::select('district')->distinct()->get();

      return response()->json(['districts' => $districts]);
     }
//******************************* End District API Controller****************************//
//*******************************Get Sub-Division Names For API**************************//
   public function getSubDivision($district){
      $subdivisions = Tripura::select('subdivision')->where('district', $district)->distinct()->get();

        return response()->json(['subdivisions' => $subdivisions]);  
    }
    //*******************************End Sub-Division API Controller**************************//
    //*******************************Get Block Names API Controller****************************//
    public function getBlock($subdivision){
      $subdivisions = Tripura::select('id','ulb')->where('subdivision', $subdivision)->distinct()->get();

        return response()->json(['blocks' => $subdivisions]);  
    }
}