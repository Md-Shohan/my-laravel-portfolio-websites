<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitormodel;

class visitorcontroller extends Controller
{
    function visitorindex(){

    $VisitorData =json_decode(visitormodel::orderBy('id','desc')->take('50')->get());

    	return view('Visitor',['VisitorData'=>$VisitorData]);
    }
}
