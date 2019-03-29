@extends('front.joinus.layout')
@section('content')
<div class="main-container container">
		<div class="row">
			<div id="content" class="col-sm-12">
				<div class="about-us about-demo-4">
					<div class="row">
						<div class="col-lg-6 col-md-6 about-us-content">
							<div class="content-about">
								<h2 class="about-title">About Us</h2> <img src="{!! asset('/uploads/teams/'.$team->image) !!}" alt="About Us">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 faq-about-us">
							<h2 class="about-title">Name : {!!$team?$team->name_en: ''!!}</h2>
							<div class="content-faq">
								<div id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel">

										{!!$team?$team->des_en: ''!!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@stop