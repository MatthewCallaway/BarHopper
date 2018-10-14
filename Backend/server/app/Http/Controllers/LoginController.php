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
    	$user->password = $request->pass;
    	//$user->gender = $request->gender;
    	//$user->birthday = $request->birthday;
    	$user->username = $request->username;


        $hash = password_hash($request->password, PASSWORD_DEFAULT);
        password_verify($request->password,$data[0]->password)

    	$user->save();
    	return 200;
    }

    public function checkUser(Request $request){

     
    }
}
