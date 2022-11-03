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
   
            return $th;
           }
    }

  
    public function store(Request $request)
    {
           try {
            $data = new Students;

            $data ->Firstname              = $request->body['Firstname'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Email                  = $request->body['Email'];
            $data ->Contact                = $request->body['Contact'];
            $data ->Batch_ID               = $request->body['Batch_ID'];
            $data ->Section_ID             = $request->body['Section_ID'];
            $data ->Honors                 = $request->body['Honors'];
            $data ->photo                  = $request->body['photo'];
            $data->created_at              = now();
            $data->updated_at              = now();
            $data->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Added succesfully',
            ]);

        } catch (\Throwable $th) {
            return $th;
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
            $data->updated_at                   = now();
          
            $data->save();

            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
            ]);
            
        } catch (\Throwable $th) {

            return $th;
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

            return $th;
           
        }
       
    }
}
