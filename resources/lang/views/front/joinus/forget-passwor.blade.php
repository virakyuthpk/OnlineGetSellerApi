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
                        <form method="post" action="{{ route('member-verify-email') }}" id="reset-password">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label " for="input-password">Your Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="bottom-form">
                                <input id="register-proceed" type="submit" value="Submite" class="btn btn-default pull-right" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop