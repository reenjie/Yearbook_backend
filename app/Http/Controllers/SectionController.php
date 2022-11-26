<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Instructor;
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
                return response()->json([
                    'status'=>500,
                    'message'=>$th -> getMessage(),
                ]);
           }
    }

    public function customSelect(){
        try {

            $data = DB::select('select id as id, Name as name from sections');
   
           return response()->json([
               'status' => 200,
               'data' => $data,
           ]);
               
           } catch (\Throwable $th) {
   
            return response() -> json([
                'status' => 500,
                'message' =>$th -> getMessage()
            ]);
           }
    }   
  
    public function store(Request $request)
    {
      
        try {
         
           
            $section = new Section;

            $section ->Name                        = $request->body['Name'];
            $section ->Description                 = $request->body['Description'];
            $section ->created_at                   = now();
            $section ->updated_at                   = now();
            $section ->save();

            if($request -> body['FK_instructor_ID']){
                $id = $request -> body['FK_instructor_ID'];
                $data = Instructor::find($id);
            
                $data ->FK_section_ID          = $section->id;
                $data ->updated_at             = now();
                
                $data->save();
            }
           
          
            
            return response()->json([
                'status' => 200,
                'message' => 'Added succesfully',
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=>500,
                'message'=>$th -> getMessage(),
            ]);
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $id = $request -> params;
            $data = Section::findOrFail($id);

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
            return response()->json([
                'status'=>500,
                'message'=>$th -> getMessage(),
            ]);
        }
    }

   
    public function destroy(Request $request)
    {
      
        try {

            $id = $request -> params;
            $data = Section::findOrFail($request->id);
            $data -> delete();

            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>500,
                'message'=>$th -> getMessage(),
            ]);
        }
       
    }
}
