@extends('administrator.login.layouts')
@section('content')

<div class="wrapper-page animated fadeInDown">
    <div class="panel panel-color panel-primary">
        <div class="panel-heading"> 
           <h3 class="text-center m-t-10"> Sign In to <strong>Onlineget</strong> </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-top-10">
                @if(Session::has('message'))
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{Session::get('message')}}</strong>
                    </div>
                @endif
            </div>
        </div>

        <form class="form-horizontal m-t-40" action="{{route('post-login')}}" method="post">
        {{ csrf_field() }}                      
            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" type="text" placeholder="Email" name="email" required>
                </div>
            </div>
            <div class="form-group ">
                
                <div class="col-xs-12">
                    <input class="form-control" type="password" placeholder="Password" name="password" required>
                </div>
            </div>

            <div class="form-group ">
                <div class="col-xs-12">
                    <label class="cr-styled">
                        <input type="checkbox" name="remember_me">
                        <i class="fa"></i>
                        Remember me
                    </label>
                </div>
            </div>

            <div class="form-group text-right">
                <div class="col-xs-6">
                    <a href="{{route('forget-password')}}"><i class="fa fa-lock m-r-5"></i><label class="cr-styled">Forgot your password?<label></a>
                </div>
                <div class="col-xs-6">
                    <button class="btn btn-purple w-md" type="submit">Log In</button>
                </div>
            </div>
            {{--<div class="form-group m-t-30">--}}
                {{--<div class="col-sm-7">--}}
                    {{--<a href="{{route('forget-password')}}"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>--}}
                {{--</div>--}}
                {{--<div class="col-sm-5 text-right">--}}
                    {{--<a href="{{route('register')}}">Create an account</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        </form>

    </div>
</div>

@stop