<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        try {

            $data = Session::all();
   
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
            $data = new Session;

            $data ->Batch_ID                    = $request->body['Batch_ID'];
            $data->created_at                   = now();
            $data->updated_at                   = now();
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
            $data = Session::find($id);

            $data ->Batch_ID                    = $request->body['Batch_ID'];
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

            $data = Session::findOrFail($request->id);
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
