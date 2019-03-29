@extends('front.joinus.layout')
@section('content')
<div class="main-container container">	
	<div class="row">
		<div id="content" class="col-sm-12">
			<h3>{!! $page?$page->title_en:'' !!}</h3>
		 	<p> @if(App::isLocale('kh'))
               {!!$page?$page->des_kh: '$page->des_en'!!}
             @else
               {!!$page?$page->des_en: '$page->des_kh'!!}
             @endif
			<p>
		</div>
	</div>
</div>
@stop