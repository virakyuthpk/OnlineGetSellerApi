<?php

namespace App\Http\Controllers\Administrator;
use Auth;
use App\User;
use Mail;
use App\Mail\ResetPassword;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	 public function index(){
        $data['user'] = User::get();
        return view('administrator.users.index')->with($data);
    }
     public function login(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('administrator.login.login');
    }
     public function logout(){
        Auth::logout();
        return redirect()->route('admin-login');
    }
     public function postLogin(Request $request){
        $isRemember = false;
        if($request->remember_me!=null)
            $isRemember = true;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1],$isRemember)) {
            return redirect()->route('dashboard');
        }else{
            return Redirect::back()->with('message','Authentication fail');
        }
    }
     public function forgetPassword(){
        return view('administrator.login.forget_password');
    }
    public function verifyEmail(Request $request){
        $data = $request->all();
        $email = $data['email'];
        $user = User::where('email',$email)->first();
        if($user){
            Mail::to($email)->send(new ResetPassword($data));
            return redirect()->route('forget-password')->with('message', 'Send Successful');
        }else{
            return redirect()->route('forget-password')->with('error_message', 'Email have no database.');
        }

    }
    public function confirmReset($token){
        return view('administrator.login.reset_password_form')->with('token',$token);
    }
    public function resetNewPass(Request $request){
        $token = $request->reset_token;
        $password = $request->password;
        $pass = PasswordReset::where('token',$token)->first();
        if($pass){
            User::where('email',$pass->email)->update(array('password'=>bcrypt($password)));
            PasswordReset::where('token',$token)->delete();

            if (Auth::attempt(['email' => $pass->email, 'password' => $password])) {
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->back()->with('error_message','Invalid Token');
        }
    }
     public function dashboard(){
        return view('administrator.dashboard.index');
    }
    public function updateResetPass(Request $request){
        $id = $request->users_id;
        $new_pass = bcrypt($request->new_pass);
        $user = User::find($id);
        $user->password = $new_pass;
        $user->save();
        return redirect()->route('users');
    }
     public function register(){
        return view('administrator.login.register');
    }
     public function create(){
        return view('administrator.users.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
        ]);
        if($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $user_name = $request->user_name;
            $email = $request->email;
            $password = bcrypt($request->password);
            $status = $request->status;
            $role = $request->role;
            $user = new User;
            $user->username = $user_name;
            $user->email = $email;
            $user->password = $password;
            $user->role = $role;
            $user->status = $status;
            $user->save();
            return Redirect::back()->with('message','Insert Successful');
        }
    }
     public function postEditUser(Request $request){
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$id,
        ]);
        if($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $user_name = $request->user_name;
            $email = $request->email;
            $status = $request->status;
            $role = $request->role;
            $user = User::find($id);
            $user->username = $user_name;
            $user->email = $email;
            $user->role = $role;
            $user->status = $status;
            $user->save();
            return Redirect::back()->with('message','Update Successful');
        }
    }
    public function edit($id){
        $user = User::where('id',$id)->first();
        return view('administrator.users.edit')->with('user',$user);
    }	
     public function destroy(Request $request){
        User::where('id',$request->id)->delete();
        return 'success';
    }

}
