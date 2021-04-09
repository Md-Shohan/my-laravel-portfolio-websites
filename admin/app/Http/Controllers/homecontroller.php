<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homecontroller extends Controller
{
    function homeindex(){

    	return view('Home');
    }
}
