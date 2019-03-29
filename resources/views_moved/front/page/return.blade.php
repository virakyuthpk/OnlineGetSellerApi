@extends('front.joinus.layout')
@section('content')
<div class="main-container container">	
	<div class="row">
		<div id="content" class="col-sm-12">
		 	<p> @if(App::isLocale('kh'))
               {!!$page?$page->des_kh: ''!!}
             @else
               {!!$page?$page->des_en: ''!!}
             @endif
			<p>
		</div>
	</div>
</div>
@stop