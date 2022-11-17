<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $data = Instructor::all();
   
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $user = new User;

            $user ->Email                  = $request->body['Email'];
            $user ->isVerified             = $request->body['isVerified'];
            $user ->role                   = $request->body['role'];
            $user ->profile                = $request->body['profile'];
            $user ->Password               = Hash::make($request->body['Password']);
            $user ->created_at             = now();
            $user ->updated_at             = now();
            $user ->save();

            $data = new Instructor;

            $data ->Firstname              = $request->body['Firstname'];
            $data ->Middlename             = $request->body['Middlename'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Contact                = $request->body['Contact'];
            $data ->isVerified             = $request->body['isVerified'];
            $data ->FK_user_ID             = $user -> id;
            $data ->Fk_section_ID          = $request->body['FK_section_ID'];
            $data->created_at              = now();
            $data->updated_at              = now();
            $data->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Added succesfully',
            ]);

     } catch (\Throwable $th) {
         return response() -> json([
             'status' => 500,
             'message' => $th -> getMessage()
         ]);
     }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $id = $request -> params;
            $data = Instructor::findOrFail($id);

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
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $id = $request->params;
            $data = Instructor::find($id);

            $data ->Firstname              = $request->body['Firstname'];
            $data ->Middlename             = $request->body['Middlename'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Email                  = $request->body['Email'];
            $data ->Contact                = $request->body['Contact'];
            $data ->isVerified             = $request->body['isVerified'];
            $data ->FK_user_ID             = $request->body['FK_user_ID'];
            $data ->updated_at              = now();
          
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
            ]);
            
        } catch (\Throwable $th) {
            return response() -> json([
                'status' => 200,
                'message' => $th -> getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            $id = $request -> params;
            $data = User::findOrFail($id);
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
