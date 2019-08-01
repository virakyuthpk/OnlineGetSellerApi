<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Models\Gallery;
use Hash;
class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request){ 

	 if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){ 
       		$user = Auth::user(); 
        	$token =  $user->createToken('MyApp')-> accessToken; 
            return ['token'=>$token, 'msg'=>"true", "user_id"=>Auth::id()]; 
        }else{
        	return response()->json(['token'=>'no access token','msg'=>'Incorrect email or password'], 401);
        }
    }
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'username' => 'required', 
            'phone' => 'required|unique:users', 
            'password' => 'required',
            'confirm_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['username'] =  $user->username;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    
    public function changePassword(Request $request)
    {
        $user = User::find($request->user_id);
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            return ([
                'success' => true,
                'data' => 'Your current password does not matches with the password you provided. Please try again.'
            ]);
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            return ([
                'success' => true,
                'data' => 'New Password cannot be same as your current password. Please choose a different password.'
            ]);
        }
        //Change Password
        $user = User::find($request->user_id);
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return ([
            'success' => true,
            'data' => 'Password changed successfully !'
        ]);
    }
    public function changeProfile(Request $request)
    {
        
        $user = User::where('id',$request->user_id)->first();
        if($request->username)
            $user->username = $request->username;
        if($request->phone)
            $user->phone = $request->phone;
        if($request->has('image')){
            $filename = Gallery::uploadFile('/users',$request->file('image'),$request->tmp_file);
            $user->image = $filename;
            $user->image_path = url('uploads/users/').'/'.$filename;
        }
        $user->save();
         return ([
            'success' => true,
            'username' => $user->username,
            'phone' => $user->phone,
            'path' => $user->image_path,
            'user_id' => $user->id
        ]);
    }
    public function userlogin(Request $request)
    {
        $phone = $request->phone;
        $password = $request->password;

        $validator = Validator::make($request->all() ,
            array('password' => 'required')
        );
        if($validator->fails()){
            return response()->json([
                'message' => 'Authenticate fails',
                'success' => false,
                'username' => 'N/A', 
                'phone' => 'N/A', 
                'path' => 'N/A', 
                'user_id' => 'N/A', 
            ]);
        }else{
            if($request->has('phone') && $request->has('password') && $request->phone != null){
                if(Auth::attempt(['phone' => $phone , 'password' => $password])){
                    $user = Auth::user();
                    return response()->json([
                        'message' => 'You have logged in successfully.',
                        'success' => true,
                        'username' => $user->username,
                        'phone' => $user->phone,
                        'path' => $user->image_path,
                        'user_id' => $user->id
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Your phone or password is incorrect.',
                        'success' => false,
                        'username' => 'N/A', 
                        'phone' => 'N/A', 
                        'path' => 'N/A', 
                        'user_id' => 'N/A',  
                    ]);
                }
            }else if($request->has('email') && $request->has('password') && $request->email != null){
                if(Auth::attempt(['email' => $email , 'password' => $password])){
                    $user = Auth::user();
                    return response()->json([
                        'message' => 'You have logged in successfully.',
                        'success' => true,
                        'username' => $user->username,
                        'phone' => $user->phone,
                        'path' => $user->image_path,
                        'user_id' => $user->id
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Your email/phone or password is incorrect.',
                        'success' => false,
                        'username' => 'N/A', 
                        'phone' => 'N/A', 
                        'path' => 'N/A', 
                        'user_id' => 'N/A', 
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Please provide credential to login',
                    'success' => false,
                    'username' => 'N/A', 
                    'email' => 'N/A', 
                    'phone' => 'N/A', 
                    'path' => 'N/A', 
                    'user_id' => 'N/A',
                ]);
            }
        }
        /*$validator = Validator::make($request->all(), [ 
            'phone' => 'required', 
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }else{
            $user = User::where('phone',$request->phone)->select('id','name','phone','path')->first();
            if (Auth::loginUsingId($user->id)) {
                return response()->json([
                    'message' => 'You have logged in successfully.',
                    'success' => true,
                    'username' => $user->name,
                    'phone' => $user->phone,
                    'path' => $user->path,
                    'user_id' => $user->id
                ]);
            }else{
                return response()->json([
                    'message' => 'Your provided credentials are incorrect',
                    'success' => false
                ]);
            }
        }*/
        /*$user = User::where('phone',$request->phone)->select('id','name','phone','path')->first();
        if (Auth::loginUsingId($user->id)) {
            return response()->json([
                'message' => 'You have logged in successfully.',
                'success' => true,
                'username' => $user->name,
                'phone' => $user->phone,
                'path' => $user->path
            ]);
        }else{
            return response()->json([
                'message' => 'Your provided credentials are incorrect',
                'success' => false
            ]);
        }*/
    }
}
