<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        try {

            $data = Students::all();
   
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
     * create a user account for student who avail the year book
     * every account must be verified on creation of student account
     * since students paid for it to avail year he/she will gain access
     * to year book system
     */
    public function createStudentAccount(Request $request)
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

            $id = $request->params;
            $data = Students::find($id);

            $data ->FK_user_ID                  = $user -> id;
            $data->updated_at                   = now();
          
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
            ]);
            
        } catch (\Throwable $th) {

            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }

  
    public function store(Request $request)
    {
       print_r($request);
        //    try {
        //     $data = new Students;

        //     $data ->Firstname              = $request->body['Firstname'];
        //     $data ->Lastname               = $request->body['Lastname'];
        //     $data ->Email                  = $request->body['Email'];
        //     $data ->Contact                = $request->body['Contact'];
        //     $data ->Batch_ID               = $request->body['Batch_ID'];
        //     $data ->Section_ID             = $request->body['Section_ID'];
        //     $data ->Honors                 = $request->body['Honors'];
        //     $data ->photo                  = $request->body['photo'];
        //     $data ->sex                    = $request->body['sex'];
        //     $data->created_at              = now();
        //     $data->updated_at              = now();
        //     $data->save();
            
        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'Added succesfully',
        //     ]);

        // } catch (\Throwable $th) {
        //     return response() -> json([
        //         'status' => 500,
        //         'message' => $th -> getMessage()
        //     ]);
        // }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\students  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $id = $request -> params;
            $data = Student::findOrFail($id);

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
   
    public function update(Request $request)
    {
        try {

            $id = $request->params;
            $data = Students::find($id);

            $data ->Firstname              = $request->body['Firstname'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Email                  = $request->body['Email'];
            $data ->Contact                = $request->body['Contact'];
            $data ->Batch_ID               = $request->body['Batch_ID'];
            $data ->Section_ID             = $request->body['Section_ID'];
            $data ->Honors                 = $request->body['Honors'];
            $data ->photo                  = $request->body['photo'];
            $data ->sex                  = $request->body['sex'];
            $data->updated_at                   = now();
          
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
            ]);
            
        } catch (\Throwable $th) {

            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage()
            ]);
        }
    }    

   
    public function destroy(Request $request)
    {
        try {

            $data = Students::findOrFail($request->id);
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
