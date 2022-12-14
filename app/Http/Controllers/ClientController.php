<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        try {

            $data = User::where('UserType',2)->get();
   
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
            $data = new User;

            $data ->Firstname              = $request->body['Firstname'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Email                  = $request->body['Email'];
            $data ->Contact                = $request->body['Contact'];
            $data ->isVerified             = $request->body['isVerified'];
            $data ->Payment                = $request->body['Payment'];
            $data ->UserType               = 2;
            $data ->firstlogin             = $request->body['firstlogin'];
            $data ->Payment_Method         = $request->body['Payment_Method'];
            $data ->Password               = $request->body['Password'];
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
            $data = User::find($id);

            $data ->Firstname              = $request->body['Firstname'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Email                  = $request->body['Email'];
            $data ->Contact                = $request->body['Contact'];
            $data ->isVerified             = $request->body['isVerified'];
            $data ->Payment                = $request->body['Payment'];
            $data ->UserType               = 2;
            $data ->firstlogin             = $request->body['firstlogin'];
            $data ->Payment_Method         = $request->body['Payment_Method'];
            $data ->Password               = $request->body['Password'];
            $data->updated_at              = now();
          
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

            $data = User::findOrFail($request->id);
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
