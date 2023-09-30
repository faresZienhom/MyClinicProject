<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MajorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/doctors',[DoctorController::class,'index']);
Route::get('/doctors/{id}',[DoctorController::class,'show']);
Route::post('/doctors',[DoctorController::class,'store']);
Route::put('/doctors/{id}',[DoctorController::class,'update']);
Route::delete('/doctors/{id}',[DoctorController::class,'delete']);
Route::delete('/doctors/{id}/force',[DoctorController::class,'forcedelete']);
Route::post('/doctors/{id}/restore',[DoctorController::class,'restore']);

Route::delete('/doctor/{id}/delete/image',[DoctorController::class,'deletedoctorimage']);
Route::post('/doctor/{id}/add/image',[DoctorController::class,'adddoctorimage']);
Route::post('/doctor/{id}/clear/image',[DoctorController::class,'cleardoctorimage']);



Route::get('/majors',[MajorController::class,'index']);
Route::get('/majors/{id}',[MajorController::class,'show']);
Route::post('/majors',[MajorController::class,'store']);
Route::put('/majors/{id}',[MajorController::class,'update']);
Route::delete('/majors/{id}',[MajorController::class,'delete']);


Route::get('/booking',[BookingController::class,'index']);
Route::get('/booking/{id}',[BookingController::class,'show']);
Route::post('/booking',[BookingController::class,'store']);
Route::put('/booking/{id}',[BookingController::class,'update']);
Route::delete('/booking/{id}',[BookingController::class,'delete']);


