<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitormodel;
use App\Models\serviceModel;

class homeController extends Controller
{
    //user IP_Address and Visitors login Time track start
    function homeindex(){

        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        visitormodel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

        $servceData =json_decode(serviceModel::all());

        return view('Home',['servceData'=>$servceData]);
       //user IP_Address and Visitors login Time track end

    }
}
