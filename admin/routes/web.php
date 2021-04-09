<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\visitorcontroller;
use App\Http\Controllers\servicecontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[homecontroller::class,'homeindex']);
Route::get('/visitor',[visitorcontroller::class,'visitorindex']);
Route::get('/service',[servicecontroller::class, 'serviceindex']);
Route::get('/getservicedata',[servicecontroller::class, 'getServiceData']);
