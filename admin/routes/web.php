<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\visitorcontroller;
use App\Http\Controllers\servicecontroller;
use App\Http\Controllers\coursescontroller;
use App\Http\Controllers\projectcontroller;
use App\Http\Controllers\contactcontroller;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\loginController;

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


//ADMIN Panel Service management
Route::get('/service',[servicecontroller::class, 'serviceindex']);
Route::get('/getServiceData', [servicecontroller::class,'getServiceData']);
Route::post('/serviceDelete', [servicecontroller::class,'serviceDelete']);
Route::post('/ServiceDetails',[servicecontroller::class,'getServiceDetails']);
Route::post('/serviceUpdate',[servicecontroller::class,'serviceUpdate']);
Route::post('/serviceAdd',[servicecontroller::class,'serviceAdd']);

// ADMIN Panel Courses management

Route::get('/courses',[coursescontroller::class, 'coursesindex']);
Route::get('/getCoursesData', [coursescontroller::class,'getCoursesData']);
Route::post('/CoursesDelete', [coursescontroller::class,'CoursesDelete']);
Route::post('/CourseDetails',[coursescontroller::class,'getCoursesDetails']);
Route::post('/CourseUpdate',[coursescontroller::class,'CoursesUpdate']);
Route::post('/CourseAdd',[coursescontroller::class,'CoursesAdd']);

// ADMIN Panel Project management

Route::get('/project',[projectcontroller::class, 'projectindex']);
Route::get('/getProjectData', [projectcontroller::class,'getProjectData']);
Route::post('/ProjectDelete', [projectcontroller::class,'projectDelete']);
Route::post('/ProjectDetails',[projectcontroller::class,'getProjectDetails']);
Route::post('/ProjectUpdate',[projectcontroller::class,'projectUpdate']);
Route::post('/ProjectAdd',[projectcontroller::class,'ProjectAdd']);


// ADMIN Panel Contact management
Route::get('/contact',[contactcontroller::class, 'contactindex']);
Route::get('/getContactData', [contactcontroller::class,'getContactData']);
Route::post('/ContactDelete', [contactcontroller::class,'ContactDelete']);


// ADMIN Panel Review management

Route::get('/review',[reviewController::class, 'reviewindex']);
Route::get('/getReviewData', [reviewController::class,'getReviewData']);
Route::post('/reviewDelete', [reviewController::class,'reviewDelete']);
Route::post('/ReviewDetails',[reviewController::class,'getReviewDetails']);
Route::post('/ReviewUpdate',[reviewController::class,'reviewUpdate']);
Route::post('/ReviewAdd',[reviewController::class,'reviewAdd']);

//Admin Login 
Route::get('/login',[loginController::class,'loginPage']);
Route::post('/onLogin',[loginController::class,'onLogin']);