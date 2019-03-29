@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Create User</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Submited failed (Name have taken)! Please try again.</strong>
                        </div>
                    @endif
                    <form class="form-horizontal" id="frm-user" method="post" action="{{route('post-user')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-lg-2">User Type</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="role">
                                    <option value="admin">Administrator</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first-name" class="control-label col-lg-2">User Name</label>
                            <div class="col-lg-4">
                                <input class="form-control" id="user_name" name="user_name" type="text">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="last-name" class="control-label col-lg-2">Email</label>
                            <div class="col-lg-4">
                                <input class="form-control" id="email" name="email" type="text">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password" class="control-label col-lg-2">Password</label>
                            <div class="col-lg-4">
                                <input class="form-control" id="password" name="password" type="password" minlength="8">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Status</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </div>
                    </form>

                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->
@stop
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#frm-user").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    user_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                // Specify validation error messages
                messages: {
                    user_name: "Please enter user name",
                    email: {
                        required: "Please enter email",
                        email: "Please enter valid email"
                    },
                    password: {
                        required: "Please enter password",
                        minlength: "Your password must be at least 8 characters long",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop