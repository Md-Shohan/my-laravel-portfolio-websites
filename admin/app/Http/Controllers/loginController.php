<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\adminModel;
class loginController extends Controller
{
    function loginPage(){

    	return view('Login');
    }

    function onLogin(Request $request){
    $username=$request->input('username');
    $password=$request->input('password');

    $countValue=adminModel::where('username','=','$username')->where('password','=','$password')->count();

    	if($countValue==true){

    		return 1;

    	}else{

    		return 0;
    	}


    }


}
