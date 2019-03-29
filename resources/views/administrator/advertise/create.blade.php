@extends('administrator.layouts.layouts')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{!! $id?'Update Advertise':'Add New Advertise' !!}</h3>
			</div>
			<div class="panel-body">
				@if(Session::has('message'))
				<div class="alert alert-success alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>{{Session::get('message')}}</strong>
				</div>
				@endif
				<div class="form">
					<form class="form-horizontal" id="for_job" method="post" action="{{route('post-advertise',$id)}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="form-group">
							<label for="cname" class="control-label col-md-2">Advertise URL <span>*</span> </label>
							<div class="col-md-10">
								<input class="form-control" name="link" type="url" value="{{$advertise?$advertise->link:''}}" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="cname" class="control-label col-md-2">Advertise Position <span>*</span></label>
							<div class="col-md-10">
								<select class="form-control" name="position">
									<option value="Left Top" {!! $advertise?$advertise->position== "Left Top"?'selected':'':''!!}>Left Top</option>
									<option value="Left Buttom" {!! $advertise?$advertise->position== "Left Buttom"?'selected':'':''!!}>Left Buttom</option>
									<option value="Center" {!! $advertise?$advertise->position== "Center"?'selected':'':''!!}>Center</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="cname" class="control-label col-md-2">Image <span>*</span></label>
							<div class="col-md-2">
                                <div class="picture" >
                                    <img id="blah" src="{!! $advertise?$advertise->image==''?asset('backEnd/img/no.jpg'):asset('uploads/advertise/'.$advertise->image):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                                    <input type='file' id="wizard-picture" name="fileImage" onchange="readURL(this);">
                                    <input type="hidden" name="tmp_file" value="{{$advertise?$advertise->image:''}}">
                                </div>
                                <label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-md-10">
								<button class="btn btn-success" type="submit">Save</button>
							</div>
						</div>
					</form>
				</div> <!-- .form -->
			</div> <!-- panel-body -->
		</div> <!-- panel -->
	</div> <!-- col -->
</div> <!-- End row -->
@stop
@section('scripts')
	<script>
		 $(document).ready(function(){
        	 $("#wizard-picture").change(function(){
                readURL(this,'blah');
            });
        });
	</script>
@stop