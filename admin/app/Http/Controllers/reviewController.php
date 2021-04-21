<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reviewModel;

class reviewController extends Controller
{
    
	//Review index 
    function reviewindex(){
    	return view('Review');
    }

      //get Review data
    function getReviewData(){
    	$result = json_encode(reviewModel::orderBy('id','desc')->get());
    	return $result;
    }

      //Review Delete 
    function reviewDelete(Request $req){
    	$id = $req->input('id');
    	$result = reviewModel::where('id','=',$id)->delete();

 		if($result==true){
 			return 1;
 		}else{
 			return 0;
 		}

    }

    //get Review Details
    function getReviewDetails(Request $req){
        $id = $req->input('id');
        $result = json_encode(reviewModel::where('id','=',$id)->get());
        return $result;
    }

    //Review Update 
    function reviewUpdate(Request $req){
        $id = $req->input('id');
        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');

        $result = reviewModel::where('id','=',$id)->update([
        	'name'=>$name,
        	'des'=>$des,
        	'img'=>$img,
        ]);

        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
    
	//Review Add 
    function reviewAdd(Request $req){
        $review_name = $req->input('name');
        $review_des = $req->input('des');
 		$review_img = $req->input('img');
        

        $result = reviewModel::insert([
        	'name'=>$review_name,
        	'des'=>$review_des,
        	'img'=>$review_img,
        	
        ]);

        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }


}
