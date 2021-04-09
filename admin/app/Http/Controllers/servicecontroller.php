<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\serviceModel;

class servicecontroller extends Controller
{
    function serviceindex(){

    	return view('Service');
    }

    function getServiceData(){
    $result= json_encode(serviceModel::all());
    return $result;
    }
}
