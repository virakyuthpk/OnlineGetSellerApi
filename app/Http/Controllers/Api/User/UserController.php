<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Session;
use App\User;
class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request){ 

     if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('MyApp')-> accessToken; 
            return ['token'=>$token, 'msg'=>"true", "user_id"=>Auth::id()]; 
        }else{
            return response()->json(['msg'=>'Incorrect email or password'], 401);
        }
    }
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
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
        $success['name'] =  $user->name;
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
        $user = Auth::user();
        if($request->name)
            $user->username = $request->name;
        if($request->phone)
            $user->phone = $request->phone;
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
                        'phone' => $user->phone, 
                        'image' => asset('uploads/users/' . $user->image), 
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Your email/phone or password is incorrect.',
                        'code' => 204,
                        'username' => 'N/A', 
                        'phone' => 'N/A',  
                        'image' => 'N/A', 
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Please provide credential to login',
                    'code' => 204,
                    'username' => 'N/A', 
                    'phone' => 'N/A',  
                    'image' => 'N/A', 
                ]);
            }
        }
    }
}
