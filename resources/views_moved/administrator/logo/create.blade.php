@extends('administrator.layouts.layouts')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{!! $id?'Update Logo':'Add New Logo' !!}</h3>
			</div>
			<div class="panel-body">
				@if(Session::has('message'))
				<div class="alert alert-success alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>{{Session::get('message')}}</strong>
				</div>
				@endif
				<div class="form">
					<form class="form-horizontal" id="for_job" method="post" action="{{route('post-logo',$id)}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="form-group">
							<label for="cname" class="control-label col-md-2">Logo<span>*</span></label>
							<div class="col-md-2">
                                <div class="picture" >
                                    <img id="blah" src="{!! $logo?$logo->image==''?asset('backEnd/img/no.jpg'):asset('uploads/logo/'.$logo->image):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                                    <input type='file' id="wizard-picture" name="fileImage" onchange="readURL(this);">
                                    <input type="hidden" name="tmp_file" value="{!!$logo?$logo->image:''!!}">
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