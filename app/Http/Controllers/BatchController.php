<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
           }
    }

    public function getCustomSelectDates(){

          
            $yearnow = date('Y');
            $data = [];
            for ($i=$yearnow; $i >= 2020 ; $i--) { 
               $data[]= $i;
            }

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
                
    }

    public function getBatch(){
        try {
          
          
            $data = DB::select('select id as value, Name as label from batches');
          
          
          return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
            
        } catch (\Throwable $th) {
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        }
    }

  
    public function store(Request $request)
    {
           try {
            $data = new Batch;

            $data ->Name                        = $request->body['Name'];
            $data ->Description                 = $request->body['Description'];
            $data ->Year                        = $request->body['Year'];
            $data->created_at                   = now();
            $data->updated_at                   = now();
            $data->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Added succesfully',
            ]);

        } catch (\Throwable $th) {
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batch  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $id = $request -> params;
            $data = Batch::findOrFail($id);

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
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        }
    }

   
    public function destroy(Request $request)
    {

       
        try {

            $id = $request -> id;
            $data = Batch::findOrFail($id);
            $data -> delete();

            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
            ]);
            
        } catch (\Throwable $th) {
            return response() -> json([
                'status' => 500,
                'message' => $th -> getMessage(),
            ]);
        }
       
    }
    
}
