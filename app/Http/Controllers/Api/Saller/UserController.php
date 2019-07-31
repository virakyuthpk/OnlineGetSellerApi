<?php

namespace App\Http\Controllers\Api\Saller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Gallery;
use Auth;
use App\User;
class UserController extends Controller
{
    public function login(Request $request)
    {
        // mobile data 
        $phone = $request->phone;
        $password = $request->password;

        $validator = Validator::make($request->all() ,
            array('password' => 'required')
        );
        if($validator->fails()){
            return response()->json([
                'message' => 'Authenticate fails',
                'user_id' => 'N/A', 
            ]);
        }else{
            if($request->has('phone') && $request->has('password') && $request->phone != null){
                if(Auth::attempt(['phone' => $phone , 'password' => $password])){
                    $user = Auth::user();
                    return response()->json([
                        'message' => 'You have logined successfully.',
                        'user_id' => $user->id,  
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Your phone or password is incorrect.',
                        'user_id' => 'N/A', 
                    ]);
                }
            }else if($request->has('email') && $request->has('password') && $request->email != null){
                if(Auth::attempt(['email' => $request->email , 'password' => $password])){
                    $user = Auth::user();
                    return response()->json([
                        'message' => 'You have logined successfully.',
                        'code' => 200,
                        'user_id' => $user->id, 
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Your email/phone or password is incorrect.',
                        'code' => 204,
                        'user_id' => 'N/A', 
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Please provide credential to login',
                    'code' => 204,
                    'user_id' => 'N/A', 
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
        $address = $request->address; 

        $validator = Validator::make($request->all() ,[
            'username' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users'
        ]);
        if($validator->fails()){
            return [
                'message' => 'You failed to register new account.',
                'user_id' => 'N/A', 
            ]; 
        }else{
            $user = new User; 
            $user->username = $username; 
            $user->phone = $phone; 
            $user->role = 'seller'; 
            $user->address = $address; 
            $user->password = bcrypt($password); 
            $user->save();
            return [
                'message' => 'You have registered new account successfully.',
                'user_id' => $user->id, 
            ]; 
        }
        
    }
    public function profile(Request $request)
    {
        $user = User::where('id',$request->user_id)->select('id','username','email','phone','address','image_path')->first();
        return response()->json([
            'success' => true,
            'data' => $user
        ]); 
    }
    public function changeProfile(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        if($request->username)
            $user->username = $request->username;
        if($request->phone)
            $user->phone = $request->phone;
        if($request->address)
            $user->address = $request->address;
        if($request->bio)
            $user->bio = $request->bio;
        if($request->email)
            $user->email = $request->email;
        if($request->has('image')){
            $filename = GalleryUnique::uploadFile('/users',$request->file('image'),$request->tmp_file);
            $user->image = $filename;
            $user->path = url('uploads/users/').'/'.$filename;
        }
        $user->save();
         return ([
            'success' => true,
            'data' => $user
        ]);
    }
}
