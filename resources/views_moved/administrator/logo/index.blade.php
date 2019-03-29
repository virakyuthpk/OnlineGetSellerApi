@extends('administrator.layouts.layouts')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<label>Logo for front page</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
			<table id="table-category" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
                        <th>Image</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(!$logo->isEmpty())
					<?php $i=1;?>
					@foreach($logo as $lo)
					<tr>
						<td>{!! $i !!}</td>
                        <td><img src="{{asset('uploads/logo/'.$lo->image)}}" width="100"></td>
                        <td>
                            <a href="{{route('edit-logo',$lo->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i> </a>
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
    </script>
@stop