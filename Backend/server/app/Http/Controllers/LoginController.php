<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function registerUser(Request $request){
    	$user = new User();
    	$user->firstname = $request->firstName;
    	$user->lastname = $request->lastName;
    	$user->email = $request->email;
    	$user->password = $request->pass;
    	//$user->gender = $request->gender;
    	//$user->birthday = $request->birthday;
    	$user->username = $request->username;

    	$user->save();
    	return 200;
    }
}
