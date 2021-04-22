<?php

namespace App\Http\Controllers;
use App\Models\projectModel;

use Illuminate\Http\Request;

class projectController extends Controller
{
    function projectPage(){
        $projectData =json_decode(projectModel::orderBy('id','desc')->get());
        return view('Project',['projectData'=>$projectData]);
    }
}
