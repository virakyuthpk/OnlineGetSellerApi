@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Update User</h3></div>
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
                    <form class="form-horizontal" id="frm-user" method="post" action="{{route('post-edit-user')}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$user->id}}" name="id">
                        <div class="form-group">
                            <label class="control-label col-lg-2">User Type</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="role">
                                    <option value="admin" {!!$user->role=='admin'?'selected':''!!}>Administrator</option>
                                    <option value="member" {!!$user->role=='member'?'selected':''!!}>Member</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="first-name" class="control-label col-lg-2">User Name</label>
                            <div class="col-lg-4">
                                <input class="form-control" id="user_name" name="user_name" type="text" value="{!!$user->username!!}">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="last-name" class="control-label col-lg-2">Email</label>
                            <div class="col-lg-4">
                                <input class="form-control" id="email" name="email" type="text" value="{!!$user->email!!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Status</label>
                            <div class="col-lg-4">
                                <select class="form-control" name="status">
                                    <option value="1" {!!$user->status==1?'selected':''!!}>Active</option>
                                    <option value="0" {!!$user->status==0?'selected':''!!}>Inactive</option>
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
                        minlength: 6
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
                        minlength: "Please enter password more than 6"
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop