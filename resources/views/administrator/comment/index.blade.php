@extends('administrator.layouts.layouts')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-sm-3">
				<label>List of Product's Comments</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
			<table id="table-category" class="table table-striped table-hover">
				<thead>
					<tr>
						<th width="15%">Product_id</th>
                        <th>Comment</th>
					</tr>
				</thead>
				<tbody>
					@if(!$comment->isEmpty())
    					@foreach($comment as $pro)
    					<tr>
    						<td>{!!$pro->commnet->pcode!!}</td>
                            <td>{!! $pro->des !!}</td>
    					@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop