<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $data = Role::all();
   
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
        try {

            $data = new Role;

            $data ->Name                        = $request->body['Name'];
            $data ->Description                 = $request->body['Description'];
            $data ->created_at                   = now();
            $data ->updated_at                   = now();
            $data ->save();
            
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
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $id = $request -> params;
            $data = Role::findOrFail($id);

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
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $id = $request->params;
            $data = Role::find($id);
 
            $data ->Name                        = $request->body['Name'];
            $data ->Description                 = $request->body['Description'];
            $data ->updated_at                  = now();
          
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {
        try {
            $id = $request -> params;
            $data = Role::findOrFail($id);
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
