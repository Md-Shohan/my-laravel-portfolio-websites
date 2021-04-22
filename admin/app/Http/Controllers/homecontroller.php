<?php

namespace App\Http\Controllers;
use App\Models\visitormodel;
use App\Models\serviceModel;
use App\Models\CourseModel;
use App\Models\projectModel;
use App\Models\contactModel;
use App\Models\reviewModel;


use Illuminate\Http\Request;

class homecontroller extends Controller
{
    function homeindex(){
    	$tvisitor=visitormodel::count();
    	$tservice=serviceModel::count();
    	$tCourse=CourseModel::count();
    	$tproject=projectModel::count();
    	$tcontact=contactModel::count();
    	$treview=reviewModel::count();


    	return view('Home',[
    		'tvisitor'=>$tvisitor,
    		'tservice'=>$tservice,
    		'tCourse'=>$tCourse,
    		'tproject'=>$tproject,
    		'tcontact'=>$tcontact,
    		'treview'=>$treview


    	]);
    }
}
