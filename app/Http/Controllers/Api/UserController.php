<?php

namespace App\Http\Controllers\Api;

use Auth; 
use App\User;
use App\Models\Gallery;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // mobile data 
        $phone = $request->phone;
        $email = $request->email;
        $password = $request->password;

        $validator = Validator::make($request->all() ,
            array('password' => 'required')
        );
        if($validator->fails()){
            return response()->json([
                'message' => 'Please input your password',
                'code' => 204,
                'username' => 'N/A', 
                'email' => 'N/A', 
                'phone' => 'N/A', 
                'role' => 'N/A', 
                'image' => 'N/A', 
                'address' => 'N/A',
            ]);
        }else{
            if($request->has('phone') && $request->has('password') && $request->phone != null){
                if(Auth::attempt(['phone' => $phone , 'password' => $password])){
                    $user = Auth::user();
                    return response()->json([
                        'message' => 'You have logined successfully.',
                        'code' => 200,
                        'username' => $user->username, 
                        'email' => $user->email, 
                        'phone' => $user->phone, 
                        'role' => $user->role, 
                        'image' => asset('uploads/users/' . $user->image), 
                        'address' => $user->address3,
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Your email/phone or password is incorrect.',
                        'code' => 204,
                        'username' => 'N/A', 
                        'email' => 'N/A', 
                        'phone' => 'N/A', 
                        'role' => 'N/A', 
                        'image' => 'N/A', 
                        'address' => 'N/A',
                    ]);
                }
            }else if($request->has('email') && $request->has('password') && $request->email != null){
                if(Auth::attempt(['email' => $email , 'password' => $password])){
                    $user = Auth::user();
                    return response()->json([
                        'message' => 'You have logined successfully.',
                        'code' => 200,
                        'username' => $user->username, 
                        'email' => $user->email, 
                        'phone' => $user->phone, 
                        'role' => $user->role, 
                        'image' => asset('uploads/users/' . $user->image), 
                        'address' => $user->address3,
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Your email/phone or password is incorrect.',
                        'code' => 204,
                        'username' => 'N/A', 
                        'email' => 'N/A', 
                        'phone' => 'N/A', 
                        'role' => 'N/A', 
                        'image' => 'N/A', 
                        'address' => 'N/A',
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Please provide credential to login',
                    'code' => 204,
                    'username' => 'N/A', 
                    'email' => 'N/A', 
                    'phone' => 'N/A', 
                    'role' => 'N/A', 
                    'image' => 'N/A', 
                    'address' => 'N/A',
                ]);
            }
        }
        
    }
    public function register(Request $request)
    {
        // mobile data
        $username = $request->username; 
        $email = $request->email; 
        $phone = $request->phone; 
        $password = $request->password; 
        $image = Gallery::uploadFile('/users',$request->file('image'),$request->tmp_file); 
        $address = $request->address; 

        $validator = Validator::make($request->all() ,[
            'username' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users'
        ]);
        if($validator->fails()){
            return [
                'message' => 'You failed to register new account.',
                'code' => 204,
                'username' => 'N/A', 
                'email' => 'N/A', 
                'phone' => 'N/A', 
                'role' => 'N/A', 
                'image' => 'N/A', 
                'address' => 'N/A',
            ]; 
        }else{
            $user = new User; 
            $user->username = $username; 
            $user->email = $email; 
            $user->phone = $phone; 
            $user->image = $image; 
            $user->role = 'seller'; 
            $user->address3 = $address; 
            $user->password = encrypt($password); 
            $user->save();
            return [
                'message' => 'You have registered new account successfully.',
                'code' => 200,
                'username' => $user->username, 
                'email' => $user->email, 
                'phone' => $user->phone, 
                'role' => $user->role, 
                'image' => asset('uploads/users/' . $user->image), 
                'address' => $user->address3,
            ]; 
        }
        
    }
}