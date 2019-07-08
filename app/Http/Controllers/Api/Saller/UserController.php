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
                'username' => 'N/A', 
                'phone' => 'N/A', 
                'image' => 'N/A', 
            ]);
        }else{
            if($request->has('phone') && $request->has('password') && $request->phone != null){
                if(Auth::attempt(['phone' => $phone , 'password' => $password])){
                    $user = Auth::user();
                    return response()->json([
                        'message' => 'You have logined successfully.',
                        'username' => $user->username,  
                        'phone' => $user->phone,  
                        'image' => asset('uploads/users/' . $user->image)
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Your phone or password is incorrect.',
                        'username' => 'N/A', 
                        'phone' => 'N/A',  
                        'image' => 'N/A', 
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
            $user->address = $address; 
            $user->password = bcrypt($password); 
            $user->save();
            return [
                'message' => 'You have registered new account successfully.',
                'code' => 200,
                'username' => $user->username, 
                'email' => $user->email, 
                'phone' => $user->phone, 
                'role' => $user->role, 
                'image' => asset('uploads/users/' . $user->image), 
                'address' => $user->address,
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
