<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
    public function registerUser(Request $request){

    	$user = new User();
    	$user->firstname = $request->firstName;
    	$user->lastname = $request->lastName;
    	$user->email = $request->email;
    	//$user->gender = $request->gender;
    	//$user->birthday = $request->birthday;
    	$user->username = $request->username;
        $hash = Hash::make($request->pass);
        $user->password = $hash;
        $user->save();
    	return 200;
    }

    public function loginUser(Request $request){
    	$user = User::where('username',$request->username)->get();
     	if (Hash::check($request->pass, $user[0]->password))
    		return $user[0];
        else
            return 500;
    }
}
