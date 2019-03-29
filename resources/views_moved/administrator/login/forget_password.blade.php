@extends('administrator.login.layouts')
@section('content')

    <div class="wrapper-page animated fadeInDown">
        <div class="panel panel-color panel-primary">
            @if(session()->has('message'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session()->get('message') }}
                </div>
            @endif
            @if(session()->has('error_message'))
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session()->get('error_message') }}
                </div>
            @endif
            <form id="frm-reset"  action="{{ route('verify-email') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group m-b-0">
                    <div class="input-group">
                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                        <span class="input-group-btn"> <button type="submit" class="btn btn-primary" id="reset">Reset</button> </span>
                    </div>
                    <label id="email-error" class="error" for="email"></label>
                </div>
            </form>
        </div>
    </div>
@stop
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#frm-reset").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                // Specify validation error messages
                messages: {
                    email: {
                        required: "Please enter email",
                        email: "Please valid email"
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop