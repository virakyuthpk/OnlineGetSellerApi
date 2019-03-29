@extends('administrator.layouts.layouts')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<label>List of advertise</label>
			</div>
			<div class="col-md-9 text-right">
                <a href="{{route('category-create')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
			<table id="table-category" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Name English</th>
                        <th>Name Khmer</th>
						<th>Icon</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(!$parent->isEmpty())
					   <?php $i=1;?>
    					@foreach($parent as $pa)
    					<tr>
    						<td>{!! $i !!}</td>
    						<td>{!! $pa->title_en !!}</td>
                            <td>{!! $pa->title_kh !!}</td>
                            <td>
                                @if($pa->icon == '')
                                    <i class="fa fa-image"></i>
                                @else
                                    <img src="{!!asset('uploads/icon/'.$pa->icon)!!}" width="100">
                                @endif
                            </td>
    						<td>
    						    <a href="{{route('edit-category',$pa->id)}}"  class="btn btn-icon btn-success m-b-5"><i class="fa fa-edit"></i> </a>
                                <a onclick="removeData({{$pa->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
                                 @if($pa->status == 1)
                               		<a onclick="activeData({{$pa->id}})" class="btn btn-icon btn-info m-b-5"><i class="fa fa-unlock-alt"></i></a>
                            	@else
                            		<a onclick="activeData({{$pa->id}})" class="btn btn-icon btn-warning m-b-5"><i class="fa fa-lock" aria-hidden="true"></i></a>
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
            $("#table-category").dataTable();
        });
       /* active concept note*/
        function activeData(id){
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
                    url: "{{route('active-category')}}",
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

       function removeData(id){
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
                    url: "{{route('delete-category')}}",
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