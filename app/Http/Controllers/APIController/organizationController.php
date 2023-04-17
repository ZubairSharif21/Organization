<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Models\item;
use App\Models\organization;
use Illuminate\Http\Request;

class organizationController extends Controller
{
    function signup(Request $req)
    {
        $req->validate([
            'business_name' => 'required',
            'facial_year' => 'required',
            'phone' => 'required'
        ]);
        $all_organization = organization::where('user_id', $req->user()->id)->first();
        if ($all_organization) {
            return response()->json(['Sir you have already an account on this email', $req->user()->email]);
        } else {
            $organization = new organization;
            $organization->business_name = $req->input('business_name');
            $organization->business_type = $req->input('business_type');
            $organization->time_zone = $req->input('time_zone');
            $organization->start_date = now();
            $organization->facial_year = $req->input('facial_year');
            $organization->currency = $req->input('currency');
            $organization->license_num = $req->input('license_num');
            $organization->contact_name = $req->input('contact_name');
            $organization->contact_email = $req->user()->email;
            $organization->street_address = $req->input('street_address');
            $organization->state = $req->input('state');
            $organization->zip_code = $req->input('zip');
            $organization->country = $req->input('country');
            $organization->phone = $req->input('phone');
            $organization->website = $req->input('website');
            $organization->user_id = $req->user()->id;
            $organization->save();
            return response()->json(['message' => 'Signup successfully'], 201);
        }
    }

    function login(Request $req)
    {

        $organization = organization::where('contact_email', $req->user()->email)->first();
        if ($organization) {

            return response()->json(['message' => 'Successfully Login'], 200);
        } else {
            return response()->json(['message' => 'Create an account first'], 400);
        }
    }
    function data()
    {
        $organization = organization::all();
        return $organization;
    }
    function update(Request $req, $id)
    {
        $req->validate([
            'business_name' => 'required',
            'facial_year' => 'required',
            'phone' => 'required'
        ]);
        $organization = organization::find($id);
        if ($organization) {

            $organization->business_name = $req->input('business_name');
            $organization->business_type = $req->input('business_type');
            $organization->time_zone = $req->input('time_zone');
            $organization->start_date = now();
            $organization->facial_year = $req->input('facial_year');
            $organization->currency = $req->input('currency');
            $organization->license_num = $req->input('license_num');
            $organization->contact_name = $req->input('contact_name');
            $organization->contact_email = $req->user()->email;
            $organization->street_address = $req->input('street_address');
            $organization->state = $req->input('state');
            $organization->zip_code = $req->input('zip');
            $organization->country = $req->input('country');
            $organization->phone = $req->input('phone');
            $organization->website = $req->input('website');
            $organization->user_id = $req->user()->id;
            $organization->updated_at = now();
            $organization->save();
            return response()->json(['message' => 'Data updated successfully'], 200);
        }
    }
    function delete($id){
        $organization = organization::find($id);
        if($organization){
        $organization->delete();
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
    }
    function add_item(Request $req){
        $req->validate(['item_name'=>'required|string']);
          $user=auth()->user();
        $organization=organization::where('user_id',$user->id)->first();
        if($organization){
            $item=new item;
            $item->item_name=$req->input('item_name');
            $item->organization_id=$organization->id;
            $item->save();
            return response()->json(['message' => 'Item has added into your organization with id as','id'=>$organization->id], 201);
        }else
        {
            return response()->json(['message' => 'Unauthorized organization'], 403);
        }
        }
}

