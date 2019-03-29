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
                    <label>List of Country</label>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{route('country-create')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        </br>
        <div class="row">

            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">

                    <table id="table-slides" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Code_Phone</th>
                                <th width="10%">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(!$country->isEmpty())
                                @foreach($country as $sl)
                                    <tr>
                                        <td>{!! $sl->name !!}</td>
                                        <td>{!! $sl->code !!}</td>
                                        <td>{!! $sl->phone_code !!}</td>
                                       
                                        <td>
                                            <a href="{{route('edit-country',$sl->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i> </a>
                                            <a onclick="removeSlide({{$sl->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No Data Available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <script>
        var socket = io('127.0.0.1:3000');
        socket.on('alert-channel:alert', function(message){
            var user_id = message.auth
            var authId = '<?php echo Auth::user()->id; ?>';
            if (user_id == authId) {
                console.log(message);
            }
                    
        });
        $(document).ready(function () {
            $("#table-slides").dataTable();
        });
        function removeSlide(id){
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
                    url: "{{route('delete-slide')}}",
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