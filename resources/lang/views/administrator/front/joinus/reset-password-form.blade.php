@extends('front.joinus.layout')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-info alert-dismissible fade in" role="alert"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('error_message'))
        <div class="alert alert-warning alert-dismissible fade in" role="alert"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                {{ session()->get('error_message') }}
        </div>
    @endif
    <div class="page-login">
        <div class="account-border">
            <div class="row">
                <div class="col-md-5 new-customer">
                    <div class="well">
                        <h1 class="cc-heading ">Reset Password</h1>
                        <form method="post" action="{{route('member-reset-new-password')}}" id="frm-reset">
                            {{ csrf_field() }}
                             <input type="hidden" name="reset_token" value="{{$token?$token:''}}">
                            <div class="form-group">
                                <label class="control-label " for="input-password">Password</label>
                               <input class="form-control" type="password" id="password" placeholder="Password" name="password" required="required">
                            </div>
                            <div class="form-group">
                                <label class="control-label " for="input-password">Confirm Password</label>
                                <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirm" required="required">
                            </div>
                            <div class="bottom-form">
                                <a href="{{route('member-login')}}">Back to login</a>
                                <input id="register-proceed" type="submit" value="Reset password" class="btn btn-default pull-right" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    var password = document.getElementById("password")
  , password_confirm = document.getElementById("password_confirm");

    function validatePassword(){
      if(password.value != password_confirm.value) {
        password_confirm.setCustomValidity("Passwords Don't Match");
      } else {
        password_confirm.setCustomValidity('');
      }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
@stop