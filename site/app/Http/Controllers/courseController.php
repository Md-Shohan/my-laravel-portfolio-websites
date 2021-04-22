<?php

namespace App\Http\Controllers;
use App\Models\CourseModel;


use Illuminate\Http\Request;

class courseController extends Controller
{
    function coursePage(){
        $CourseData =json_decode(CourseModel::orderBy('id','desc')->get());
        
        return view('Course',['courseData'=>$CourseData]);
    }
}
