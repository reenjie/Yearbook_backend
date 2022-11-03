<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    
    public function index()
    {
        try {

            $data = Batch::all();
   
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
            $data = new Batch;

            $data ->Name                        = $request->body['Name'];
            $data ->Year                        = $request->body['Year'];
            $data ->Description                 = $request->body['Description'];
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
            $data = Batch::find($id);

            $data ->Name                        = $request->body['Name'];
            $data ->Year                        = $request->body['Year'];
            $data ->Description                 = $request->body['Description'];
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

            $data = Batch::findOrFail($request->id);
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
