@extends('administrator.layouts.layouts')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<label>List of advertise</label>
			</div>
			<div class="col-md-9 text-right">
                <a href="{{route('advertise-create')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
			<table id="table-category" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Advertise URL</th>
						<th>Position</th>
						<th>Order</th>
                        <th>Image</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(!$advertise->isEmpty())
					<?php $i=1;?>
					@foreach($advertise as $ad)
					<tr>
						<td>{!! $i !!}</td>
						<td>{!! $ad->link !!}</td>
						<td>{!! $ad->position !!}</td>
						<td>{!! $ad->order_ring !!}</td>
                        <td><img src="{{asset('uploads/advertise/'.$ad->image)}}" width="100"></td>
						<td>
						    <a href="{{route('edit-advertise',$ad->id)}}"  class="btn btn-icon btn-success m-b-5"><i class="fa fa-edit"></i> </a>
                            <a onclick="removeAdd({{$ad->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
                             @if($ad->status == 1)
                           		<a onclick="activeData({{$ad->id}})" class="btn btn-icon btn-info m-b-5"><i class="fa fa-lock"></i></a>
                        	@else
                        		<a onclick="activeData({{$ad->id}})" class="btn btn-icon btn-warning m-b-5"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a>
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
            $("#table-jobs").dataTable();
        });
       /* active concept note*/
        function activeData(id){
            route = "activ-job";
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to active this Job ?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, active it!",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url: "{{route('activ-add')}}",
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
            route = "delete-job";
            swal({
                title: "Are you sure?",
                text: "Are you sure that you want to delete this job?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonText: "Yes, delete it!",
                confirmButtonColor: "#ec6c62"
            }, function() {
                $.ajax({
                    url: "{{route('delete-add')}}",
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