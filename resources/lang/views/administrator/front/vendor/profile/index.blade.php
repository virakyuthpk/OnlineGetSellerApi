@extends('front.layout.layout')
@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="breadcrumb clearfix">
            <a class="home" href="{{route('home')}}" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Profile Setting</span>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="col-md-2 col-sm-4 col-xs-4 left_lay">
                    @include('front.layout.left-vendor')
                </div>
                <div class="col-md-10 col-sm-8 col-xs-8 frm-mid">
                	<div class="panel panel-default">
						@if(Session::has('message'))
						<div class="alert alert-success alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>{{Session::get('message')}}</strong>
						</div>
						@endif
						<div class="panel-heading">Profile setting</div>
						<div class="panel-body">
							<form class="form-horizontal" id="for_job" method="post" action="{{route('updatepassord')}}" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group">
									<label for="cname" class="control-label col-md-2">Old password<span>*</span> </label>
									<div class="col-md-10">
										<input class="form-control" name="oldpass" type="password">
										<span class="haserror">
											{{$errors->has('oldpass') ? 'Plese input the corect password' : '' }}
										</span>
									</div>
								</div>
								<div class="form-group">
									<label for="cname" class="control-label col-md-2">New Password <span>*</span></label>
									<div class="col-md-10">
										<input class="form-control" name="pwd" type="password" >
										<span class="haserror">
										{{$errors->has('pwd') ? 'Plese input new password' : '' }}</span>
									</div>
								</div>
								<div class="form-group">
									<label for="cname" class="control-label col-md-2">Confirm Password <span>*</span></label>
									<div class="col-md-10">
										<input class="form-control" name="cpwd" type="password">
										<span class="haserror">
										{{ $errors->has('cpwd') ? 'Password and confirm do not much' : '' }}</span>
									</div>
								</div>
             					<div class="form-group">
									<label for="cname" class="control-label col-md-2">Profile-Image: <span>*</span></label>
									<div class="col-md-2">
		                                <div class="picture" >
		                                     <img class="image" id="blah" src="{!! $profile?$profile->image==''?asset('backEnd/img/no.jpg'):asset('uploads/profile/'.$profile->image):asset('backEnd/img/no.jpg') !!}" >
		                                    <input type='file' id="wizard-picture" name="fileImage" onchange="readURL(this);">
		                                    <input type="hidden" name="tmp_file" value="{{$profile?$profile->image:''}}">
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
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
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