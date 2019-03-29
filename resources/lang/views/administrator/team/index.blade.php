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
                    <label>List of Team</label>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{route('team-create')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
                    <table id="table-team" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$team->isEmpty())
                            <?php $i=1;?>
                            @foreach($team as $te)
                                <tr>
                                    <td>{!! $i !!}</td>
                                    <td>{!! $te->name_en !!}</td>
                                    <td>{!! $te->title_en !!}</td>
                                    <td>
                                        <a href="{{route('edit-team',$te->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i> </a>
                                        <a onclick="removeCareer({{$te->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
                                        @if($te->status == 1)
                                            <a onclick="activeDatas({{$te->id}})" class="btn btn-icon btn-warning m-b-5" title="Click here to disable"><i class="fa fa-unlock"></i></a>
                                        @else
                                            <a onclick="activeDatas({{$te->id}})" class="btn btn-icon btn-warning m-b-5" title="Click here to endable"><i class="fa fa-lock"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Data Available.</td>
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
            $("#table-team").dataTable();
        });
        function removeCareer(id){
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
                    url: "{{route('delete-team')}}",
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
    function activeDatas(id){
        route = "active-job";
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
                    url: "{{route('active-team')}}",
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