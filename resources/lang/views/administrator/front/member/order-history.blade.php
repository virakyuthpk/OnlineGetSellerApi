@extends('front.joinus.layout')
@section('content')
	<div class="main-container container">
		<div class="row">
			<h2 class="title">Order History</h2>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td class="text-center">Image</td>
							<td class="text-left">Product Name</td>
							<td class="text-center">Order ID</td>
							<td class="text-center">Qty</td>
							<td class="text-center">Status</td>
							<td class="text-center">Date Added</td>
							<td class="text-right">Total</td>
							<!--<td></td>-->
						</tr>
					</thead>
					<tbody>
					     @if(!$product->isEmpty())
                            @foreach($product as $pro)
        						<tr>
        							<td class="text-center">
        								<a href="{{route('product-detail',$pro->id)}}"><img width="85" class="img-thumbnail" title="Aspire Ultrabook Laptop" alt="Aspire Ultrabook Laptop" src="image/catalog/demo/product/funiture/1.jpg">
        								</a>
        							</td>
        							<td class="text-left"><a href="{{route('product-detail',$pro->id)}}">
        							    {!!$pro->detail?$pro->detail->name_en:""!!}</a>
        							</td>
        							<td class="text-center">#214521</td>
        							<td class="text-center">1</td>
        							<td class="text-center">Shipped</td>
        							<td class="text-center">21/06/2016</td>
        							<td class="text-right">$228.00</td>
        						<!--	<td class="text-center"><a class="btn btn-info" title="" data-toggle="tooltip" href="order-information.html" data-original-title="View"><i class="fa fa-eye"></i></a>
        							</td>-->
        						</tr>
        					@endforeach
        				@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop