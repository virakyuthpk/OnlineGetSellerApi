@extends('front.joinus.layout')
@section('content')

@if(session()->has('message'))
    <div class="alert alert-info alert-dismissible fade in" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
            {{ session()->get('message') }}
    </div>
@endif
<div class="page-login">
    <div class="account-border">
        <div class="row">
            <div class="col-sm-8 new-customer">
                <div class="well">
                    <h2><i class="fa fa-file-o" aria-hidden="true"></i> New Customer</h2>
                    <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                    <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label " for="input-email">First Name</label>
                               <input type="text" name="first_name" class="form-control">
                                <div class="cc-input__error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label " for="input-last name">Last Name</label>
                               <input type="text" class="form-control" name="last_name">
                                <div class="cc-input__error">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label " for="input-email">E-Mail Address</label>
                               <input type="email" name="email" class="form-control" required="required">
                                <div class="cc-input__error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label " for="input-phone">Phone number</label>
                               <input type="text" name="phone" class="form-control">
                                <div class="cc-input__error">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label " for="input-password">Password</label>
                              <input type="password" name="password" id="pwd" required="required" class="form-control"><i id="eye" alt="eye" class="fa fa-eye pull-right"></i>
                                <div class="cc-input__error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label " for="input-password">Confirm Password</label>
                               <input type="password" class="form-control" name="password" id="confirm_password" required="required">
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Do you want to subscibe with us? &nbsp;</label>
                             <label class="radio-inline"><input type="radio" name="optradio" value="yes">Yes</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="no">No</label>
                            <div class="form-group">
                                <ul>
                                    <li>
                                        <label for="radio_button_5">
                                            <input type="radio" checked="" name="role" value="buyer"> Buyer
                                        </label>
                                    </li>
                                    <li>
                                        <label for="radio_button_6">
                                            <input type="radio" name="role" value="saller"> Saller
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="bottom-form">
                           <!--  <a href="{{route('member-forget-password')}}">Forgot password</a> -->
                            <input id="register-proceed" type="submit" value="Register" class="btn btn-default pull-right" />
                        </div>
                    </form>
                </div>
               <!--  <div class="bottom-form">
                    <a href="#" class="btn btn-default pull-right">Register</a>
                </div> -->
            </div>
            <form action="{{route('member-login')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-sm-4 customer-login">
                    <div class="well">
                        <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Returning Customer</h2>
                        <p><strong>I am a returning customer</strong></p>
                        <div class="form-group">
                            <label class="control-label " for="input-email">E-Mail Address</label>
                            <input class="form-control" type="text" id="input-email" name="email" value="" placeholder="" required="">
                            <div class="cc-input__error"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label " for="input-password">Password</label>
                            <input class="form-control" type="password" id="input-password" name="password" value="" placeholder="" required="">
                            <div class="cc-input__error">
                            </div>
                        </div>
                        <div class="bottom-form">
                            <a href="{{route('member-forget-password')}}">Forgot password</a>
                            <input id="register-proceed" type="submit" value="Login" class="btn btn-default pull-right" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop