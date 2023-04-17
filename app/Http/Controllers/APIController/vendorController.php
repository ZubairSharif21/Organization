<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Models\vendor;
use Illuminate\Http\Request;

class vendorController extends Controller
{
    function signup(Request $req)
    {
        $req->validate([
            'business_name' => 'required',
            'facial_year' => 'required',
            'phone' => 'required'
        ]);
        $all_vendor = vendor::where('user_id', $req->user()->id)->first();
        if ($all_vendor) {
            return response()->json(['Sir you have already an account on this email', $req->user()->email]);
        } else {
            $vendor = new vendor;
            $vendor->business_name = $req->input('business_name');
            $vendor->business_type = $req->input('business_type');
            $vendor->time_zone = $req->input('time_zone');
            $vendor->start_date = now();
            $vendor->facial_year = $req->input('facial_year');
            $vendor->currency = $req->input('currency');
            $vendor->license_num = $req->input('license_num');
            $vendor->contact_name = $req->input('contact_name');
            $vendor->contact_email = $req->user()->email;
            $vendor->street_address = $req->input('street_address');
            $vendor->state = $req->input('state');
            $vendor->zip_code = $req->input('zip');
            $vendor->country = $req->input('country');
            $vendor->phone = $req->input('phone');
            $vendor->website = $req->input('website');
            $vendor->user_id = $req->user()->id;
            $vendor->save();
            return response()->json(['message' => 'Signup successfully'], 201);
        }
    }

    function login(Request $req)
    {

        $vendor = vendor::where('contact_email', $req->user()->email)->first();
        if ($vendor) {

            return response()->json(['message' => 'Successfully Login'], 200);
        } else {
            return response()->json(['message' => 'Create an account first'], 400);
        }
    }
    function data()
    {
        $vendor = vendor::all();
        return $vendor;
    }
    function update(Request $req, $id)
    {
        $req->validate([
            'business_name' => 'required',
            'facial_year' => 'required',
            'phone' => 'required'
        ]);
        $vendor = vendor::find($id);
        if ($vendor) {

            $vendor->business_name = $req->input('business_name');
            $vendor->business_type = $req->input('business_type');
            $vendor->time_zone = $req->input('time_zone');
            $vendor->start_date = now();
            $vendor->facial_year = $req->input('facial_year');
            $vendor->currency = $req->input('currency');
            $vendor->license_num = $req->input('license_num');
            $vendor->contact_name = $req->input('contact_name');
            $vendor->contact_email = $req->user()->email;
            $vendor->street_address = $req->input('street_address');
            $vendor->state = $req->input('state');
            $vendor->zip_code = $req->input('zip');
            $vendor->country = $req->input('country');
            $vendor->phone = $req->input('phone');
            $vendor->website = $req->input('website');
            $vendor->user_id = $req->user()->id;
            $vendor->updated_at = now();
            $vendor->save();
            return response()->json(['message' => 'Data updated successfully'], 200);
        }
    }
    function delete($id){
        $vendor = vendor::find($id);
        if($vendor){
        $vendor->delete();
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
    }
}
