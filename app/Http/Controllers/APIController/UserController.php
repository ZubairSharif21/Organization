<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function login(Request $req){
        $req->validate([
            "email"=>'required|email',
            'password' => 'required'
        ]);

        $user=User::where('email',$req->email)->first();
        if($user){
            $password=Hash::check($req->password, $user->password);

            if($password){
        $token=$user->createToken($user->email)->plainTextToken;
        return response()->json(['message'=>'Successfully Login','token'=>$token],200);
    }else{
                return response()->json(['message'=>'Enter a valid password'],400);
            }
        }else{
            return response()->json(['message'=>'Enter a valid email'],400);

        }

    }
    function signup(Request $req){
        $req->validate([
            "email"=>'required|email|unique:users,email',
            'password' => 'required|min:8|max:16|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/',

            "confirm_password"=>'required|'
        ]);
        if($req->password==$req->confirm_password){

            $user=new User;

            // $user->name=null;
        $user->email=$req->input('email');
        $user->email_verified_at=now();
        $user->password=Hash::make($req->input('password'));
        $user->save();

        return response()->json(['message'=>'Signup successfully'],201);
    }else{
        return response()->json(['message'=>'Password & Confirm Password are not matching'],400);
    }
    }
    function update(Request $req,$id){
        $req->validate([
            'email'=>'required|email|unique:users,email',
            'password'=>'required|',
        ]);
        $user=User::where('id',$id)->first();
        $user->email=$req->input('email');

        $user->password=$req->input('password');
        $user->updated_at=now();
        $user->save();
        return response()->json(['message'=>'Updated successfully'],201);

    }
    function delete($id){
        $user=User::find($id);
        if (!$user) {
            return response()->json(['message'=>'User not found'],404);
        }
        $user->tokens()->delete();
        $user->delete();
        return response()->json(['message'=>'User deleted successfully'],200);
    }
    function data(){
    $user=User::all();
    return $user;
    }
    function logout(Request $req){
        $tokens = $req->user()->tokens;
        foreach ($tokens as $token) {
            $token->delete();
        }
        return response()->json(['message'=>'User logout successfully'],200);
    }
}
