@extends('front.joinus.layout')
@section('content')
<div class="main-container container">	
	<div class="row">
		<div id="content" class="col-sm-12">
			<h3>{!! $page?$page->title_en:'' !!}</h3>
		 	<p> @if(App::isLocale('kh'))
               {!!$page?$page->des_kh: ''!!}
             @else
               {!!$page?$page->des_en: ''!!}
             @endif
			<p>
		</div>
	</div>
	<div class="row">
		@if(!$career->isEmpty())
			<?php $i=1;?>
			<table class="table table-striped table-hover">
				<thead>
				    <th>No</th>
					<th>Title</th>
                    <th>Closing Date</th>
                    <th>Public Date</th>
                    <th>Term</th>
				</thead>
				@foreach($career as $ca)
                    <tr>
                        <td>{!! $i !!}</td>
                        <td>{!! $ca->title !!}</td>
                        <td>{!! $ca->closing_date !!}</td>
                        <td>{!! $ca->public_date !!}</td>
                        <td>{!! $ca->term !!}</td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
			</table>
        @endif
	</div>
</div>
@stop