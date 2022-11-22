<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Admin::all();
   
           return response()->json([
               'status' => 200,
               'data' => $data,
           ]);
               
           } catch (\Throwable $th) {
            return response()->json([
                'status'=>500,
                'message'=>$th -> getMessage(),
            ]);
           }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $user = new User;

            $user ->Email                  = $request->body['Email'];
            $user ->isVerified             = $request->body['isVerified'];
            $user ->role                   = $request->body['role'];
            $user ->profile                = $request->body['profile'];
            $user ->Password               = Hash::make($request->body['Password']);
            $user ->created_at             = now();
            $user ->updated_at             = now();
            $user ->save();
    
            
            $data = new admin;
        
            $data ->Firstname              = $request->body['Firstname'];
            $data ->Middlename             = $request->body['Middlename'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Contact                = $request->body['Contact'];
            $data ->FK_user_ID             = $user -> id;
            $data->created_at              = now();
            $data->updated_at              = now();
            $data->save();
    
            /**
             * on success return status 200
             * user will not redirect to home until his acconut is approve
             */
            return response()->json([
                'status' => 200,
                'message'=> 'Account added successfuly your account is currently pending',
            ]);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>500,
                'message'=>$th -> getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $id = $request -> params;
            $data = Admin::findOrFail($id);

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
            
        } catch (\Throwable $th) {
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {    
        try{

            $id = $request->params;
            $data = Admin::find($id);
        
            $data ->Firstname              = $request->body['Firstname'];
            $data ->Middlename             = $request->body['Middlename'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Contact                = $request->body['Contact'];
            $data->updated_at              = now();
            $data->save();
    
            /**
             * on success return status 200
             * user will not redirect to home until his acconut is approve
             */
            return response()->json([
                'status' => 200,
                'message'=> 'Account updated successfuly ',
            ]);
        }catch(\Throwable $th){
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request -> params;
            $data = Admin::findOrFail($id);
            $data -> delete();

            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
            ]);
            
        } catch (\Throwable $th) {

            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        
        }
    }
}
