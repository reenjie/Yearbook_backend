<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SectionController extends Controller
{
    public function index()
    {
        try {

            $data = Section::all();
   
           return response()->json([
               'status' => 200,
               'data' => $data,
           ]);
               
           } catch (\Throwable $th) {
   
            return $th;
           }
    }

    public function customSelect(){
        try {

            $data = DB::select('select id as value, Name as label from sections');
   
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
            $data = new Section;

            $data ->Name                        = $request->body['Name'];
            $data ->Description                 = $request->body['Description'];
            $data->created_at                   = now();
            $data->updated_at                   = now();
            $data->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Added succesfully',
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=>500,
                'message'=>$th,
            ]);
        }
    }

   
   
    public function update(Request $request)
    {
        try {

            $id = $request->params;
            $data = Section::find($id);
 
            $data ->Name                        = $request->body['Name'];
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

            $data = Section::findOrFail($request->id);
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
