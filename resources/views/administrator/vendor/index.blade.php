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
                    <label>List of vendor</label>
                </div>
            </div>
        </div>
        </br>
        <div class="row">

            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">

                    <table id="table-vendor" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Shop name</th>
                                <th>Shop logo</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th width="20%">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(!$vendors->isEmpty())
                                <?php $i=1;?>
                                @foreach($vendors as $vendor)
                                    <tr>
                                        <td>{!! $i !!}</td>
                                        <td>{!! $vendor->shop_name !!}</td>
                                         <td><img src="{{asset('uploads/vendor/'.$vendor->pic)}}" width="100"></td>
                                        <td>{!! $vendor->user->email !!}</td>
                                        <td>{!! $vendor->user->phone !!}</td>
                                        <td>
                                            @if($vendor->status == 1)
                                                <a onclick="activeDatas({{$vendor->id}})" class="btn btn-icon btn-warning m-b-5" title="Click here to disable"><i class="fa fa-unlock"></i></a>
                                            @else
                                                <a onclick="activeDatas({{$vendor->id}})" class="btn btn-icon btn-warning m-b-5" title="Click here to endable"><i class="fa fa-lock"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                <?php $i++;?>
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
    <script>
        $(document).ready(function () {
            $("#table-vendor").dataTable();
        });
        function activeDatas(id){
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
                    url: "{{route('active_vendor')}}",
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