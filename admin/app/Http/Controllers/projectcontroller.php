<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projectModel;

class projectcontroller extends Controller
{
    
    //project index 
    function projectindex(){
    	return view('project');
    }

    //get project data
    function getProjectData(){
    	$result = json_encode(projectModel::orderBy('id','desc')->get());
    	return $result;
    }

    //get project Details
    function getProjectDetails(Request $req){
        $id = $req->input('id');
        $result = json_encode(projectModel::where('id','=',$id)->get());
        return $result;
    }

    //Project Delete 
    function projectDelete(Request $req){
    	$id = $req->input('id');
    	$result = projectModel::where('id','=',$id)->delete();

 		if($result==true){
 			return 1;
 		}else{
 			return 0;
 		}

    }

     //Project Update 
    function projectUpdate(Request $req){
        $id = $req->input('id');
        $project_name = $req->input('project_name');
        $project_des = $req->input('project_des');
        $project_img = $req->input('project_img');
        $project_link = $req->input('project_link');

        $result = projectModel::where('id','=',$id)->update([
        	'project_name'=>$project_name,
        	'project_des'=>$project_des,
        	'project_img'=>$project_img,
        	'project_link'=>$project_link,
        ]);

        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

     //Project Add 
    function ProjectAdd(Request $req){
        $project_name = $req->input('project_name');
        $project_des = $req->input('project_des');
 		$project_img = $req->input('project_img');
        $project_link = $req->input('project_link');
        

        $result = projectModel::insert([
        	'project_name'=>$project_name,
        	'project_des'=>$project_des,
        	'project_img'=>$project_img,
        	'project_link'=>$project_link,
        ]);

        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

}
