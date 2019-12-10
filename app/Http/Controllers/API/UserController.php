<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'error'=>$validator->errors(),
                'success'=>false,
                'status'=> 401
            ]);
            }
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();
        $userDetails['name'] =  $user->name;
        $userDetails['token'] = $user->createToken('MyApp')->accessToken;
        
        return response()->json([
            'success'=>true,
            'message'=>'Registration Successful',
            'status'=> 200,
            'user'=>$userDetails
        ]);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if(!Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            return response()->json([
                'success'=>false,
                'message' => 'Invalid Email or Password',
                'status'=> 401
            ]);
        }
        $user = Auth::user();
        $userDetails['name'] =  $user->name;
        $userDetails['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json([
                'success'=>true,
                'message'=>'Login Successful',
                'status'=> 200,
                'user'=>$userDetails
            ]);
    }

    
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        
        return response()->json([
            'success'=>true,
            'status'=> 200,
            'message' => 'Successfully logged out.'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    // public function user()
    // {
    //     $user = Auth::user();
    //     return response()->json([
    //         'success'=>true,
    //         'message'=>'Retrived Successful',
    //         'status'=> 200,
    //         'user'=>$user
    //     ]);
    // }
}
