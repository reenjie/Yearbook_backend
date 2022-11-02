<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 */


Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->group(function () {
   
//Batch
    Route::get('batch', 'BatchController@index');         //Index
    Route::post('batch', 'BatchController@store');        //Create
  /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
    Route::put('batch', 'BatchController@update');        //Update
    Route::delete('batch', 'BatchController@destroy');   //delete


//User
    Route::get('user', 'UserController@index');         //Index
    Route::post('user', 'UserController@store');        //Create
   /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
    Route::put('user', 'UserController@update');        //Update
    Route::delete('user', 'UserController@destroy');   //delete
     



//Section
    Route::get('section', 'SectionController@index');         //Index
    Route::post('section', 'SectionController@store');        //Create
    /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
    Route::put('section', 'SectionController@update');        //Update
    Route::delete('section', 'SectionController@destroy');   //delete


//Student
    Route::get('student', 'StudentController@index');         //Index
    Route::post('student', 'StudentController@store');        //Create
    /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
    Route::put('student', 'StudentController@update');        //Update
    Route::delete('student', 'StudentController@destroy');   //delete

    
//Session
    Route::get('session', 'SessionController@index');         //Index
    Route::post('session', 'SessionController@store');        //Create
    /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
    Route::put('session', 'SessionController@update');        //Update
    Route::delete('session', 'SessionController@destroy');   //delete
                   
  

});