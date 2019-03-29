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
                    <label>List of Discount</label>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{route('discount-create')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        </br>
        <div class="row">

            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">

                    <table id="table-discount" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Percentage</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$discount->isEmpty())
                            <?php $i = 1;?>
                            @foreach($discount as $dis)
                                <tr>
                                    <td>{!! $i !!}</td>
                                    <td>{!! $dis->percentage !!}</td>
                                    <td>
                                        <a href="{{route('edit-discount',$dis->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i> </a>
                                        <a onclick="removeData({{$dis->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
                                        @if($dis->status == 1)
                                        <a onclick="activeData({{$dis->id}})" class="btn btn-icon btn-warning m-b-5" title="Click here to disable"><i class="fa fa-unlock"></i></a>
                                        @else
                                        <a onclick="activeData({{$dis->id}})" class="btn btn-icon btn-warning m-b-5" title="Click here to endable"><i class="fa fa-lock"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++;?>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            $("#table-discount").dataTable();
        });
        function removeData(id){
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
                    url: "{{route('delete-discount')}}",
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
        function activeData(id){
        route = "active-discount";
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to active this?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, active it!",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url: "{{route('active-discount')}}",
                    type: "GET",
                    data: {id: id},
                    success:function(data){
                        if(data == 'success'){
                            swal({
                                title: "Done!",
                                text: "It was succesfully active!",
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