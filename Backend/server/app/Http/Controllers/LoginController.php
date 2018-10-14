<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $hash = password_hash($request->password, PASSWORD_DEFAULT);
        $user->password = $hash;
        $user->save();
    	return 200;
    }


    //ADDED does not work
    public function loadData(Request $request){
    	$user = User::where('username',$request->username)->get();
        $success = "success";
        $fail = "fail";

     	if (password_verify($user[0]->password,$request->pass)) {
    		return $success;
		} else {
    		return $fail;
		}

		return 200;
    }
}
