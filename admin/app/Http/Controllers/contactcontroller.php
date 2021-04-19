<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contactModel;

class contactcontroller extends Controller
{
    
	function contactindex(){
    	return view('Contact');
    }

    function getContactData(){
    $result=json_encode(contactModel::orderBy('id','desc')->get());
    return $result;

    }

    //Service Delete 
    function ContactDelete(Request $req){
    	$id = $req->input('id');
    	$result = contactModel::where('id','=',$id)->delete();

 		if($result==true){
 			return 1;
 		}else{
 			return 0;
 		}

    }



}
