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


 
Route::namespace('App\Http\Controllers') -> prefix('auth') ->name('auth.')->group(function () {
    Route::post('signup', 'UserController@signup');        //Create
    Route::post('signin', 'UserController@signin');        //Authenticate
});

Route::middleware('auth:sanctum')->group(function () {

    Route::namespace('App\Http\Controllers')->group(function () {   
        //User
            Route::get('users','UserController@checkUserToken');

        //Batch
            Route::get('batch', 'BatchController@index');         //Index
            Route::get('batch/Custom', 'BatchController@getBatch'); 
        
            
            Route::post('batch', 'BatchController@store');        //Create
          /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
          
            Route::put('batch', 'BatchController@update');        //Update
            Route::delete('batch', 'BatchController@destroy');   //delete
        
            
            Route::get('instructor', 'InstructorController@index');     //Read
            Route::get('instructor/selection', 'InstructorController@indexSelection');     //Read
            Route::post('instructor', 'InstructorController@store');        //Create
          /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
          
            Route::put('instructor', 'InstructorController@update');        //Update
            Route::delete('instructor', 'InstructorController@destroy');   //delete  
        
        //User
            // Route::get('user', 'UserController@index');         //Index
           /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
            Route::put('user', 'UserController@update');        //Update
            Route::delete('user', 'UserController@destroy');   //delete
             
        //Section
            Route::get('section', 'SectionController@index');         //Index
            Route::get('custom_section_select', 'SectionController@customSelect'); 
            Route::post('section', 'SectionController@store');        //Create
            Route::get('section/{id}', 'DoctorController@show');     //Read */
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
                //
            Route::post('session', 'SessionController@store');        //Create
            /*   Route::get('batch/{id}', 'DoctorController@show');     //Read */
            Route::put('session', 'SessionController@update');        //Update
            Route::delete('session', 'SessionController@destroy');   //delete
        });
});