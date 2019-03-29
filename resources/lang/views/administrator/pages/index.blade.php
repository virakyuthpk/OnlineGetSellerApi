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
                    <label>List of Page</label>
                </div>
               <!-- <div class="col-md-9 text-right">
                    <a href="{{route('page-create')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
                </div>-->
            </div>
        </div>
        </br>
        <div class="row">

            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">

                    <table id="table-page" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title English</th>
                                <th>Title Khmer</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$page->isEmpty())
                            <?php $i = 1;?>
                            @foreach($page as $p)
                                <tr>
                                    <td>{!! $i !!}</td>
                                    <td>{!! $p->title_en !!}</td>
                                   <td>{!! $p->title_kh !!}</td>
                                    <td>
                                        <a href="{{route('edit-page',$p->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i> </a>
                                        <a onclick="removePage({{$p->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
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
            $("#table-page").dataTable();
        });
        function removePage(id){
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
                    url: "{{route('delete-page')}}",
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