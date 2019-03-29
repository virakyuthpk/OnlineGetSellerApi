@extends('front.joinus.layout')
@section('content')
<?php
$user = Auth::user() ;
$profile = $user->profile;
?>
	<div class="main-container container">
		<div class="row">
			<div class="col-md-12" id="content">
				<h2 class="title">My Account</h2>
				<p class="lead">Welcome, <strong> 
				 	@if(Auth::check())
	                 	{!!(Auth::user()->username)!!} </a>  
	                @endif
	                </strong> - To update your account information.
	            </p>
				<div class="row">
       @if(Session::has('message'))
      <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>{{Session::get('message')}}</strong>
      </div>
      @endif
					<div class="col-sm-7">
						<fieldset id="personal-details">
							 <form action="{{route('Update_account')}}" method="post" enctype="multipart/form-data" id="sign" autocomplete="off">
							 {{csrf_field()}}
								<legend>Personal Details</legend>
								<div class="form-group required">
									<label for="input-firstname" class="control-label">First Name</label>
									<input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="{!!$profiles?$profiles->first_name:''!!}" name="firstname">
								</div>
								<div class="form-group required">
									<label for="input-lastname" class="control-label">Last Name</label>
									<input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="{!!$profiles?$profiles->last_name:''!!}" name="lastname">
								</div>
								<div class="form-group required">
									<label for="input-email" class="control-label">E-Mail</label>
									<input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="{!!$user?$user->email:''!!}" name="email">
								</div>
								<div class="form-group required">
									<label for="input-telephone" class="control-label">Telephone</label>
									<input type="tel" class="form-control" id="input-telephone" placeholder="Telephone" value="{!!$profiles?$profiles->phone:''!!}" name="telephone">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Save change</button>
								</div>
							</form>
						</fieldset>
						<br>
					</div>
					<div class="col-sm-5">
						<fieldset>
						 <form action="{{route('Update_pass')}}" method="post" enctype="multipart/form-data" id="sign" autocomplete="off">
							 {{csrf_field()}}
								<legend>Change Password</legend>
								<div class="form-group required">
									<label for="input-password" class="control-label">New Password</label>
									<input type="password" class="form-control"  placeholder="New Password" value="" name="pass">
								</div>
								<div class="form-group required">
									<label for="input-confirm" class="control-label">New Password Confirm</label>
									<input type="password" class="form-control" id="input-confirm" placeholder="New Password Confirm" value="" name="new-confirm">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Save change</button>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop