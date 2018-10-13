<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tempController extends Controller
{

    public function loadData(){
    	$data = DB::table('test')
		->get();

    	return $data;
    }
}
