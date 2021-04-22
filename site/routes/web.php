<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\contactController;

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

Route::get('/',[homeController::class, 'homeindex']);
Route::get('/project',[projectController::class, 'projectPage']);
Route::get('/course',[courseController::class, 'coursePage']);
Route::get('/contact',[contactController::class, 'contactPage']);
Route::post('/contact',[homeController::class, 'ContactSend']);

