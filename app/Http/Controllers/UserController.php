<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\student;
use App\Models\Admin;
use App\Models\User;
use App\Models\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        try {

            $data = User::all();
   
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

    public function signin(Request $request)
    {
    
           try {

            $credentials = [
                'email' => $request -> body['Email'],
                'password' => $request -> body['Password'],
            ];

            if (!Auth::attempt($credentials)) {    
                return response()->json([
                    'status' => 403,
                    'errors' => 'Email or password incorrect'
                ]);
            }
            
            $data = DB::SELECT("SELECT u.id,u.email, u.profile, u.isVerified, r.name as role FROM users u 
                    JOIN roles r ON r.id = u.FK_role_ID WHERE u.email = ?", [$request -> body['Email']]);

            if(!$data ){
                return response()->json([
                    'status' => 404,
                    'message' => 'Account not found.',
                ]);
            }

            /**
             * if role is 2 or Instructor 
             * then fetch in instructor table
             * if data not found response status 404 account doesn't exist
             * means the the user has an account for authentication
             * but doesn't have a user information record on instructor table
             */
            if($data[0] -> role == 2){
                $instructor = Instructor::find($data[0] -> id);

                if(!$instructor){
                    return response()->json([
                        'status' => 404,
                        'message' => 'Account exist but user information missing.',
                    ]);
                }
                
                $user = Auth::user();
                $token =  $user->createToken('year_book');
                $success['token']   =  $token -> accessToken; 
                $success['role']    =  $data[0] -> role;
                $success['name']    =  $instructor->name;
                $success['email']   =  $user->email;
                $success['profile'] =  $user->profile;
                $success['loggedIn'] = true;

                return response()->json([
                    'status' => 200,
                    'data'=> $success,
                ]);
            }
            
            /**
             * if role is 2 or students 
             * then fetch in student table
             * if data not found response status 404 account doesn't exist
             * means the the user has an account for authentication
             * but doesn't have a user information record on students table
             */
            if($data[0] -> role == 3){
                $student = Students::find();
                
                if(!$instructor){
                    return response()->json([
                        'status' => 404,
                        'message' => 'Account exist but user information missing.',
                    ]);
                }

                $user = Auth::user();
                $token =  $user->createToken('year_book');
                $success['token']   =  $token -> accessToken; 
                $success['role']    =  $data[0] -> role;
                $success['name']    =  $student->name;
                $success['email']   =  $user->email;
                $success['profile'] =  $user->profile;
                $success['loggedIn'] = true;

                return response()->json([
                    'status' => 200,
                    'data'=> $success,
                ]);
            }


            /**
             * if role is not 2 or 3  
             * then fetch in admin table
             * if data not found response status 404 account doesn't exist
             * means the the user has an account for authentication
             * but doesn't have a user information record on admin table
             */

            $admin = Admin::find();
        
            if(!$admin){
                return response()->json([
                    'status' => 404,
                    'message' => 'Account exist but user information missing.',
                ]);
            }

            $user = Auth::user();
            $token =  $user->createToken('year_book');
            $success['token']   =  $token -> accessToken; 
            $success['role']    =  $data[0] -> role;
            $success['name']    =  $admin->name;
            $success['email']   =  $user->email;
            $success['profile'] =  $user->profile;
            $success['loggedIn'] = true;

            return response()->json([
                'status' => 200,
                'data'=> $success,
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=>500,
                'message'=>$th -> getMessage(),
            ]);
        }
    }

    public function signup(Request $request)
    {
    
           try {

            $user = new User;

            $user ->Email                  = $request->body['Email'];
            $user ->isVerified             = false;
            $user ->FK_role_ID             = $request->body['role'];
            $user ->profile                = $request->body['profile'];
            $user ->Password               = Hash::make($request->body['Password']);
            $user ->created_at             = now();
            $user ->updated_at             = now();
            $user ->save();


            if($user -> FK_role_ID == 1){
                $data = new Admin;
    
                $data ->Firstname              = $request->body['Firstname'];
                $data ->Middlename             = $request->body['Middlename'];
                $data ->Lastname               = $request->body['Lastname'];
                $data ->Sex                    = $request->body['Sex'];
                $data ->FK_user_ID             = $user -> id;
                $data->created_at              = now();
                $data->updated_at              = now();
                $data->save();
    
                /**
                 * on success return status 200
                 * user will not redirect to home until his acconut is approve
                 */
                return response()->json([
                    'status' => 200,
                    'message'=> 'Account added successfuly your account is currently pending',
                ]);
            }
            
            $data = new Instructor;

            $data ->Firstname              = $request->body['Firstname'];
            $data ->Middlename             = $request->body['Middlename'];
            $data ->Lastname               = $request->body['Lastname'];
            $data ->Sex                    = $request->body['Sex'];
            $data ->FK_user_ID             = $user -> id;
            $data->created_at              = now();
            $data->updated_at              = now();
            $data->save();


            /**
             * on success return status 200
             * user will not redirect to home until his acconut is approve
             */
            return response()->json([
                'status' => 200,
                'message'=> 'Account added successfuly your account is currently pending',
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
     * @param  \App\Models\user  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $id = $request -> params;
            $data = User::findOrFail($id);

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
            $data = User::find($id);

            $data ->Email                  = $request->body['Email'];
            $data ->isVerified             = $request->body['isVerified'];
            $data ->role                   = $request->body['role'];
            $data ->profile                = $request->body['profile'];
            $data ->Password               = Hash::make($request->body['Password']);
            $data->updated_at              = now();
          
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
        
          
            $data = User::findOrFail($request->id);
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
