@extends('front.joinus.layout')
@section('content')
<div class="main-container container">
	<div class="row">
		<div id="content" class="col-sm-12 item-article">
			<div class="row box-1-about">
				<div class="col-md-12 welcome-about-us">
					<div class="title-about-us">
						<h2>Welcome To Onlineget</h2>
					</div>
					<div class="content-about-us">
						<div class="col-md-4 image-about-us">
							<img src="{!!$page_title?$page_title->image==''?asset('front/image/no1.png'):asset('uploads/pages/'.$page_title->image):asset('front/image/no1.png') !!}" alt="About Us">
						</div>
						<div class="col-md-8 des-about-us">
							@if(App::isLocale('kh'))
							{!!$page_title?$page_title->des_kh:''!!}
							@else
							{!!$page_title?$page_title->des_en:''!!}
							@endif
						</div>
					</div>
				</div>
				<div class="col-md-12 our-member">
					<div class="title-about-us">
						<h2>Our Member</h2>
					</div>
					<div class="short-des">
						<p>Consectetur adipiscing elit. Donec pellentesque venenatis elit, quis aliquet mauris malesuada vel. Donec vitae libero dolor, eget dapibus justo.Aenean facilisis aliquet feugiat. Suspendisse lacinia congue est ac semper. Nulla ut elit magna, vitae volutpat magna.</p>
					</div>
					<div class="overflow-owl-slider1">
						<div class="wrapper-owl-slider1">
							<div class="row slider-ourmember">
								@if(!$teams->isEmpty())
									@foreach($teams as $team)
										<div class="item-about col-lg-6 col-md-6 col-sm-6">
											<div class="item respl-item">
												<div class="item-inner">
													<div class="col-md-4 col-xs-12 w-image-box">
														<div class="item-image">
															<a title="Jennifer lawrence" href="{{route('team-detail',$team->id)}}">
																<img src="{!! asset('/uploads/teams/'.$team->image) !!}" alt="{!!$team?$team->name_en:''!!}" alt="Image Client">
															</a>
														</div>
													</div>
													<div class="col-md-8 col-xs-12 info-member">
														<h2 class="cl-name"><a title="Jennifer lawrence" href="{{route('team-detail',$team->id)}}">{!!$team?$team->name_en: ''!!}</a></h2>
														
														<p class="cl-des">{!!$team?$team->des_en: ''!!}</p>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop