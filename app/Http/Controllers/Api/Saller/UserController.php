<?php

namespace App\Http\Controllers\Api\Saller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Gallery;
use App\Models\Vendors;
use Auth;
use App\User;
use Illuminate\Support\Facades\Input;
use Hash;
class UserController extends Controller
{
    public function profile(Request $request)
    {
        // $user = User::where('id',$request->user_id)->select('id','username','email','phone','address','image_path')->first();
        $user = User::find($request->user_id);
        if ($user->password != null) {
            $user['new user'] = false;
        } else {
            $user['new user'] = true;
        }
        
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }
    public function changeProfile(Request $request)
    {
        // $user = User::where('id',$request->user_id)->first();
        $user = User::find($request->user_id);
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
        if($request->firstname)
            $user->firstname = $request->firstname;
        if($request->lastname)
            $user->lastname = $request->lastname;
        if($request->has('image')){
            $filename = Gallery::uploadFile('/users',$request->file('image'),$request->tmp_file);
            $user->image = $filename;
            $user->image_path = url('uploads/users/').'/'.$filename;
        }
        $user->save();
         return ([
            'success' => true,
            'data' => $user
        ]);
    }
    public function changePassword(Request $request)
    {
        $user = User::find($request->user_id);
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            return ([
                'success' => false,
                'data' => 'Your current password does not matches with the password you provided. Please try again.'
            ]);
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            return ([
                'success' => false,
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
    public function login_fb(Request $request)
    {
        # code...
        $validator = Validator::make($request->all(), [
            'social_id' => 'required|unique:users',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'username' => 'required',
            'image_path' => 'required',
        ]);
        $user = User::where('social_id', $request->social_id)->first();
        
        if ($user != null) {
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['user_id'] =  $user->id;
            $success['register'] = false;
            $success['fb'] = true;
            $shop = Vendors::where('user_id', $user->id)->first();
            
            if ($shop != null) {
                $success['shop_id'] = $shop->id;
                return response()->json($success);
            } else {
                $shop_user['user_id'] = $user->id;
                $shop_user = Vendors::create($shop_user);
                $success['shop_id'] = $shop_user->id;
                return response()->json($success);
            }
        } else {
            $input = Input::all();
            $input['role'] = 'seller';
            $user = User::create($input);

            $shop['user_id'] = $user->id;
            $shop_user = Vendors::create($shop);
            
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['user_id'] =  $user->id;
            $success['register'] = true;
            $success['fb'] = true;
            $success['shop_id'] = $shop_user->id;
            return response()->json($success); 
        }
    } 
    public function login(Request $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user();
            $token =  $user->createToken('MyApp')-> accessToken;
            $shop = Vendors::where('user_id',Auth::id())->select('*')->first();
            return [
                'msg'=>true, 
                'user_id'=>Auth::id(),
                'shop_id' => $shop->id,
                'token'=>$token];
        } else {
            return response()->json(['token'=>'no access token','msg'=>'Incorrect email or password'], 401);
        }
    }
    public function setNewPassword(Request $request)
    {
        //Change Password
        $user = User::where('id',$request->user_id)->first();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return response()->json([
            'success' => true,
            'data' => 'Password changed successfully !',
        ]);
    }
    public function editUsername(Request $request)
    {
        # code...
        $user = User::find($request->user_id);
        $user->username = $request->username;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editEmail(Request $request)
    {
        # code...
        $user = User::find($request->user_id);
        $user->email = $request->email;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editPhone(Request $request)
    {
        # code...
        $user = User::find($request->user_id);
        $user->phone = $request->phone;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editAddress(Request $request)
    {
        # code...
        $user = User::find($request->user_id);
        $user->address = $request->address;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editBio(Request $request)
    {
        # code...
        $user = User::find($request->user_id);
        $user->bio = $request->bio;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editProfile(Request $request)
    {
        # code...
        $user = User::find($request->user_id);
        if($request->has('image')){
            $filename = Gallery::uploadFile('/users',$request->file('image'),$request->tmp_file);
            $user->image = $filename;
            $user->image_path = url('uploads/users/').'/'.$filename;
            $image = $user->image_path;
        }
        $user->save();
         return ([
            'success' => true,
            'image' => $image
        ]);
    }

    public function findUser(Request $request)
    {
        # code...
        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            return response()->json([
                'user_id' => $user->id
            ]);
        } else {
            return response()->json([
                'user_id' => null
            ]);
        }
    }
}