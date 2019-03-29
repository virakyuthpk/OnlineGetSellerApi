@extends('administrator.layouts.layouts')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<label>List of Image on left slide</label>
			</div>
			<div class="col-md-9 text-right">
                <a href="{{route('leftslide-create')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
			<table id="table-leftslide" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th> Product URL</th>
                        <th>Image</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(!$leftslide->isEmpty())
					<?php $i=1;?>
					@foreach($leftslide as $left)
					<tr>
						<td>{!! $i !!}</td>
						<td>{!! $left->link !!}</td>
                        <td><img src="{{asset('uploads/leftslide/'.$left->image)}}" width="100"></td>
						<td>
						    <a href="{{route('edit-leftslide',$left->id)}}"  class="btn btn-icon btn-success m-b-5"><i class="fa fa-edit"></i> </a>
                            <a onclick="removeAdd({{$left->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
                             @if($left->status == 1)
                           		<a onclick="activeData({{$left->id}})" class="btn btn-icon btn-info m-b-5"><i class="fa fa-unlock"></i></a>
                        	@else
                        		<a onclick="activeData({{$left->id}})" class="btn btn-icon btn-warning m-b-5"><i class="fa fa-lock" aria-hidden="true"></i></a>
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
@stop
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#table-leftslide").dataTable();
        });
       /* active concept note*/
        function activeData(id){
            route = "activ-leftslide";
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to active this ?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, active it!",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url: "{{route('activ-leftslide')}}",
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
       /*delete concept note*/

       function removeAdd(id){
            route = "delete-leftslide";
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to delete this?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, delete it!",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url: "{{route('delete-leftslide')}}",
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