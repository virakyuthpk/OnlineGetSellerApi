@extends('administrator.login.layouts')
@section('content')

    <div class="wrapper-page animated fadeInDown">
        <div class="panel panel-color panel-primary">
            <div class="panel-heading">
                <h3 class="text-center m-t-10"> Reset Password </h3>
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

            <form class="form-horizontal m-t-40" id="frm-reset" action="{{route('reset-new-password')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="reset_token" value="{{$token?$token:''}}">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" id="password" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group ">

                    <div class="col-xs-12">
                        <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirm">
                    </div>
                </div>
                <div class="form-group text-right">
                    <div class="col-xs-12">
                        <button class="btn btn-purple w-md" type="submit">Reset</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@stop
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-reset").validate({
                rules : {
                    password : {
                        required: true,
                        minlength : 8
                    },
                    password_confirm : {
                        required: true,
                        minlength : 8,
                        equalTo : "#password"
                    }
                },
                // Specify validation error messages
                messages: {
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long",
                    },
                    password_confirm: "Please enter confirm password",
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop