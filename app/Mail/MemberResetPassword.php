<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Carbon\Carbon;
class MemberResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        $email = $this->request['email'];
        $reset = PasswordReset::where('email',$email)->first();
        if($reset){
            $token = $reset->token;
        }else{
            $token = Str::random(6);
            $pass = new PasswordReset;
            $pass->email = $email;
            $pass->token = $token;
            $pass->timestamps = false;
            $pass->created_at = Carbon::now();
            $pass->save();
        }
        return $this->view('mail.member-reset-mail')->with('token',$token)->with('email',$email);
    }
}
