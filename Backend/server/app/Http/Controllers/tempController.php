<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class tempController extends Controller
{

    public function loadData(){
    	$data = User::find(1);
    	return $data;
    }
}
