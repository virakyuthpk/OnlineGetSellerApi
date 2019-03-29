@extends('front.joinus.layout')
@section('content')
<div class="main-container container">	
	<div class="row">
		<div id="content" class="col-sm-12">
			<div class="info-contact clearfix">
				<div class="info-store">
					<div class="row">
						<address>
							<div class="address clearfix form-group">
								<div class="icon">
									<i class="fa fa-home"></i>
								</div>
								<div class="text">
									@if(App::isLocale('kh'))
		                                {!!$address?$address->location_kh:''!!}
		                            @else
		                                {!!$address?$address->location_en:''!!}
		                            @endif
								</div>
							</div>
							<div class="phone form-group">
								<div class="icon">
									<i class="fa fa-phone"></i>
								</div>
								<div class="text">
									Phone : {!!$address?$address->phone:''!!} - {!!$address?$address->phone1:''!!}
								</div>
							</div>
							<div class="email form-group">
								<div class="icon">
									<i class="fa fa-envelope-o"></i>
								</div>
								<div class="text">
									Email : {!!$address?$address->email:''!!}
								</div>
							</div>
							<div class="times form-group">
								<div class="icon">
									<i class="fa fa-clock-o"></i>
								</div>
								<div class="text"> 
									@if(App::isLocale('kh'))
		                                {!!$address?$address->open_kh:''!!}
		                            @else
		                                {!!$address?$address->open_en:''!!}
		                            @endif
                        		</div>
							</div>
						</address>
					</div>
				</div>
			</div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2948.8442639328655!2d-71.10008329902021!3d42.34584359264178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e379f63dc43ccb%3A0xa15d5aa87d0f0c12!2s4+Yawkey+Way%2C+Boston%2C+MA+02215!5e0!3m2!1sen!2s!4v1475081210943" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
</div>
@stop