<?php

namespace App\Http\Controllers\WebController;

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
                session()->put('email',$user->email);
               return redirect('home');
    }else{
                return redirect()->back()->withErrors('Enter a valid password')->withInput();
            }
        }else{
            return redirect()->back()->withErrors('Enter a valid Email')->withInput();

        }
    }
//
function signup(Request $req){
    $req->validate([
        "email"=>'required|email|unique:users,email',
        'password' => 'required|min:8|max:16|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/',

        "confirm_password"=>'required|'
    ]);
    if($req->password==$req->confirm_password){

        $user=new User;
    $user->email=$req->input('email');
    $user->email_verified_at=now();
    $user->password=Hash::make($req->input('password'));
    $user->save();

                return redirect()->back()->with(['message'=>'User Created successfully']);
}else{
    return redirect()->back()->withErrors('Password & Confirm Password not matched');

}

}
// function update(Request $req,$id){
//     $req->validate([
//         'email'=>'required|email|unique:users,email',
//         'password'=>'required|',
//     ]);
//     $user=User::where('id',$id)->first();
//     $user->email=$req->input('email');

//     $user->password=$req->input('password');
//     $user->updated_at=now();
//     $user->save();
//     return redirect()->back()->with(['message'=>'User Updated successfully']);

// }
function delete($id){
    $user=User::find($id);
    $user->tokens()->delete();
    $user->delete();
    return redirect()->back()->with(['message'=>'User Deleted successfully']);
}
function data(){
$users=User::all();
return view('User.data', ['users' => $users]);



}
function logout() {
    session()->forget('email');
    return redirect('/')->with('message', 'User logout successfully');
}
 function update(Request $request, $id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Update the user's email and password
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));

    // Save the updated user to the database
    $user->save();

    // Redirect back to the user's profile page
    return redirect()->route('users.show', ['id' => $user->id]);
}
}
