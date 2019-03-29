@extends('administrator.layouts.layouts')
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('message')}}
        </div>
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Submited failed! Please try again.</strong>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-3">
                    <label>List of User</label>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{route('users-create')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        </br>
        <div class="row">

            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">

                    <table id="table-user" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$user->isEmpty())
                            <?php $i=1;?>
                            @foreach($user as $u)
                                <tr>
                                    <td>{!! $i !!}</td>
                                    <td>{!! $u->username !!}</td>
                                    <td>{!! $u->email !!}</td>
                                    <td>
                                        <span class="badge bg-info">{{$u->role}}</span>
                                    </td>
                                    <td>
                                        @if($u->status==1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a data-toggle="modal" data-target="#myModal" data-id="{{$u->id}}" class="btn btn-icon btn-info m-b-5 res-pass" ><i class="fa fa-key" aria-hidden="true"></i></a>
                                        <a href="{{route('edit-user',$u->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i></a>
                                        <a onclick="removeData({{$u->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i></a>
                                    </td>
                                </tr>
                                <?php $i++;?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No Data Available.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form action="{{route('update-reset-pass')}}" method="post" id="frm-reset-pass">
                {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reset Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>New Password</label>
                                <input type="hidden" name="users_id" id="users_id">
                                <input type="password" name="new_pass" id="new_pass" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>Confirm Password</label>
                                <input type="password" name="con_pass" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-edit" id="save-pass">Save</button>
                        <button type="button" class="btn btn-default btn-edit" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('scripts')
    {!! Html::script('js/custom.js') !!}
    <script>
        $(document).ready(function () {
            $("#table-user").dataTable();
            $("#frm-reset-pass").validate({
                rules: {
                    new_pass: {
                        required: true,
                        minlength: 8
                    },
                    con_pass: {
                        required: true,
                        minlength: 8,
                        equalTo: "#new_pass"
                    }
                },
                messages: {
                    new_pass: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    con_pass: {
                        required: "Please provide a confirm password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $(".res-pass").click(function(){
                var id = $(this).data('id');
                $("#users_id").val(id);
            });
        });
        function removeData(id){
            route = "delete-user";
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to delete this user?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, delete it!",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url: "{{route('delete-user')}}",
                    type: "GET",
                    data: {id: id},
                    success:function(data){
                        if(data == 'success'){
                            swal({
                                title: "Done!",
                                text: "It was succesfully deleted!",
                                type: "success"
                            }, function() {
                                location.reload();
                            });
                        }
                    }
                });
            });
        }
    </script>
@stop