<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile ;
use App\User as Users;
use Validator;
use Auth;
use Mail;
use App\Mail\MemberResetPassword;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Redirect;
use App\Models\Subscriber;
class JoinusController extends Controller
{
    public function joinus(Request $request){
    	return view('front.joinus.joinus');
    }
    function quickRandom($length = 6){
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
    public function store(Request $request){
        //dd($request->optradio);
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
        ]);
        if($validator->fails()){
             return redirect('member-login')->with('message','This email address is already registered');
        }else{
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $email = $request->email;
            $confirmCode = $this->quickRandom();
            $password = bcrypt($request->password);
            $user = new Users;
            $user->username = $first_name.$last_name;
            $user->email = $email;
            $user->password = $password;
            $user->confirm_code  = $confirmCode;
            $user->status = '1';
            $user->role = $request->role;
            if(($request ->role) == "buyer") {
                $user->status = 1;
            }elseif(($request ->role) == "saller") {
                $user->status = 1;
            }
            else{
                $user->status = 0;
            }
            $user->save();

            $userprofile = new Profile;
            $userprofile->first_name = $first_name;
            $userprofile->last_name = $last_name;
            $userprofile->user_id = $user->id;
            $userprofile->save();
            $user_id = $user->id;
            if($request->optradio == 'yes'){
                $su = new Subscriber;
                $su->email = $request->email;
                $su->save();
            }
            return back()->with('message',"Thanks for register with us ! We have sent you an email please check you email");
        }
    }
    function activate(request $request){
        $user = Users::where('confirm_code', '=', $request->code);
        $userData = $user->first();
        if ($user->exists()) {
                $user->update(['confirm_code' => $this->quickRandom(),'status' => 1]);
                 if(Auth::loginUsingId($userData->id)){
                     return redirect()->intended('/members/conceptnote');
                }else{
                    echo "Fail to login";
                }
        }else{
            return redirect('/');
        }
    }
    public function getlogin(){
        return view('front.joinus.login');
    }
     public function postLogin(Request $request){
        if (Auth::attempt(['email' => $request->email,'role'=>'buyer', 'password' => $request->password, 'status' => 1])) {
            return redirect()->route('acc_setting');
        }elseif(Auth::attempt(['email' => $request->email, 'role'=>'saller', 'password' => $request->password, 'status' => 1])) {
            return redirect()->route('product-vendor');

    }else{
            return Redirect::back()->with('message','Authentication fail');
        }
    }
    public function forgetPassword(){
        return view('front.joinus.forget-passwor');
    }
    public function verifyEmail(Request $request){
        $data = $request->all();
        $email = $data['email'];
        $user = Users::where('email',$email)->first();
        if($user){
            Mail::to($email,'Onlineget')->send(new MemberResetPassword($data));
            return redirect()->route('member-forget-password')->with('message', 'We sent you an email with instructions for resetting your password.Please, check your email.');
        }else{
            return redirect()->route('member-forget-password')->with('error_message', 'Your eamil don not have in system.');
        }
    }
    public function confirmReset($token){
        return view('front.joinus.reset-password-form')->with('token',$token);
    }
    public function resetNewPass(Request $request){
        $token = $request->reset_token;
        $password = $request->password;
        $pass = PasswordReset::where('token',$token)->first();
        if($pass){
            Users::where('email',$pass->email)->update(array('password'=>bcrypt($password)));
            PasswordReset::where('token',$token)->delete();
            if (Auth::attempt(['email' => $pass->email, 'password' => $password])) {
                return redirect()->back()->with('message','Your password was reset');
            }
        }else{
            return redirect()->back()->with('error_message','Invalid Token');
        }
    }
}
