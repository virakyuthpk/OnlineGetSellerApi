@extends('administrator.login.layouts')
@section('content')

<div class="wrapper-page animated fadeInDown">
    <div class="panel panel-color panel-primary">
        <div class="panel-heading"> 
           <h3 class="text-center m-t-10"> Create a new Account </h3>
        </div> 

        <form class="form-horizontal m-t-40" action="index.html">
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="email" required="" placeholder="Email">
                </div>
            </div>
            
            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control " type="text" required="" placeholder="Username">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control " type="password" required="" placeholder="Password">
                </div>
            </div>

            <div class="form-group ">
                <div class="col-xs-12">
                    <label class="cr-styled">
                        <input type="checkbox" checked>
                        <i class="fa"></i> 
                         I accept <strong><a href="#">Terms and Conditions</a></strong>
                    </label>
                </div>
            </div>
            
            <div class="form-group text-right">
                <div class="col-xs-12">
                    <button class="btn btn-purple w-md" type="submit">Register</button>
                </div>
            </div>

            <div class="form-group m-t-30">
                <div class="col-sm-12 text-center">
                    <a href="login.html">Already have account?</a>
                </div>
            </div>
        </form>                                  
        
    </div>
</div>

@stop
