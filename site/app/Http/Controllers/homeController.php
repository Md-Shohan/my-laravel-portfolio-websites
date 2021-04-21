<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitormodel;
use App\Models\serviceModel;
use App\Models\CourseModel;
use App\Models\projectModel;
use App\Models\contactModel;
use App\Models\reviewModel;


class homeController extends Controller
{
    //user IP_Address and Visitors login Time track start
    function homeindex(){

        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        visitormodel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

        $servceData =json_decode(serviceModel::all());
        $CourseData =json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
        $projectData =json_decode(projectModel::orderBy('id','desc')->limit(10)->get());
        $reviewData =json_decode(reviewModel::all());

        return view('Home',[
            'servceData'=>$servceData,
            'CourseData'=>$CourseData,
            'projectData'=>$projectData,
            'reviewData'=>$reviewData,
            
            ]);
    }
    function ContactSend(Request $request){
        $contact_name= $request->input('contact_name');
        $contact_mobile= $request->input('contact_mobile');
        $contact_email= $request->input('contact_email');
        $contact_msg= $request->input('contact_msg');

    $result=contactModel::insert([
            'contact_name'=>$contact_name,
            'contact_mobile'=>$contact_mobile,
            'contact_email'=>$contact_email,
            'contact_msg'=>$contact_msg,
        ]);

        if($result==true){

            return 1;
        }
        else{

            return 0;
        }

    }

}
