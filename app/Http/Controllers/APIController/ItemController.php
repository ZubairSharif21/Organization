<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Models\item;
use App\Models\organization;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    function add_item(Request $req)
    {
        $req->validate(['item_name' => 'required|string']);
        $user = auth()->user();
        $organization = organization::where('user_id', $user->id)->first();
        if ($organization) {
            $item = new item();
            $item->item_name = $req->input('item_name');
            $item->organization_id = $organization->id;
            $item->save();
            return response()->json(['message' => 'Item has added into your organization with id as', 'Organization_id' => $organization->id], 201);
        } else {
            return response()->json(['message' => 'Unauthorized organization'], 403);
        }
    }
    function delete_item($id)
    {
        $user=auth()->user();
        $organization=organization::where('user_id',$user->id)->first();
        $item = Item::where('organization_id', $organization->id)->where('id', $id)->first();
        if ($item) {
            $item->delete();
            return response()->json(['message' => 'Item Deleted Successfully'], 200);
        }else{
            return response()->json(['message' => 'Sorry there is no such an item of this ID'], 401);

        }
    }
    function update_item(Request $req,$id)
    {
        $req->validate(['name'=>'required']);

        $user=auth()->user();
        $organization=organization::where('user_id',$user->id)->first();
        $item = Item::where('organization_id', $organization->id)->where('id', $id)->first();
        if ($item) {
            $item->item_name=$req->input('name');
            $item->save();
            return response()->json(['message' => 'Item Updated Successfully'], 200);
        }else{
            return response()->json(['message' => 'Sorry there is no such an item of this ID'], 401);
        }
    }
    function show_item(){
        $user=auth()->user();
        $organization=organization::where('user_id',$user->id)->first();

        $item=item::where('organization_id',$organization->id)->get();
    if($item){
        return $item;
    }else{
        return response()->json(['message' => "Sorry there is no such an item's"], 401);

    }
    }
}
