@extends('front.joinus.layout')
@section('content')
	<div class="main-container container">
	 @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{Session::get('message')}}</strong>
        </div>
    @endif
	<form name="order" class="form-horizontal" id="for_job" method="post" action="{{route('post-order')}}" enctype="multipart/form-data">
        {{csrf_field()}}
		<div class="row">
			<div id="content" class="col-sm-12">
			  	<h2 class="title">Checkout</h2>
			  	<div class="so-onepagecheckout row">
					<div class="col-left col-sm-3">
				  		<div class="panel panel-default">
							<div class="panel-heading">
							  	<h4 class="panel-title"><i class="fa fa-book"></i> Your Information</h4>
							</div>
					 		<div class="panel-body">
								<fieldset id="address">
								  	<div class="form-group">
										<label for="input-payment-firstname" class="control-label">First Name</label>
										<input type="text" class="form-control" id="input-payment-firstname" placeholder="First Name" name="firstname">
								  	</div>
									<div class="form-group">
										<label for="input-payment-lastname" class="control-label">Last Name</label>
										<input type="text" class="form-control" id="input-payment-lastname" placeholder="Last Name" name="lastname">
									</div>
									<div class="form-group">
										<label for="input-payment-email" class="control-label">E-Mail</label>
										<input type="text" class="form-control" id="input-payment-email" placeholder="E-Mail" name="email">
									</div>
								    <div class="form-group required">
										<label for="input-payment-telephone" class="control-label">Phone</label>
										<input type="text" class="form-control number" id="input-payment-telephone" placeholder="Phone number"  name="phone">
								    </div>
								    <div class="form-group required">
										<label for="input-payment-telephone" class="control-label">Address</label>
										<input type="text" class="form-control" placeholder="Address" value="" name="address">
								    </div>
									<label>
								 	 My delivery and billing addresses are the same.
								 	</label>
								</fieldset>
						  	</div>
				  		</div>
					</div>
					<div class="col-right col-sm-9">
				  		<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default no-padding">
									<div class="col-sm-6 checkout-shipping-methods">
										<div class="panel-heading">
										  	<h4 class="panel-title"><i class="fa fa-truck"></i> Delivery Method</h4>
										</div>
										<div class="panel-body ">
											<p>Please select the preferred shipping method to use on this order.</p>
											<div class="form-group">
												<label class="control-label col-md-2">Provice</label>
												<div class="col-md-10">
													<select class="form-control" name="provice">
														<option value="">Select province</option>
														@if(!$province->isEmpty())
                        									@foreach($province as $pro)
																<option value="{!!$pro->id!!}">{!!$pro->name_en!!}</option>
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2">District</label>
												<div class="col-md-10">
													<select class="form-control" name="destric">
                                         				<option value="">Select District</option>
                                    				</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6  checkout-payment-methods">
										<div class="panel-heading">
										  	<h4 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method</h4>
										</div>
										<div class="panel-body">
											<p>Please select the preferred payment method to use on this order.</p>
											@if(!$payment->isEmpty())
                        						@foreach($payment as $pay)
													<div class="radio">
													  	<label>
													  		<input type="radio" name="optradio" value="{!!$pay->id!!}"> 
													  		@if(App::isLocale('kh'))
		                                                    	{!!$pay?$pay->name_kh: ''!!}
		                                                    @else
		                                                    	{!!$pay?$pay->name_en: ''!!}
		                                                    @endif
														</label>
													</div>
												@endforeach
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
					  			<div class="panel panel-default">
									<div class="panel-heading">
									  	<h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
									</div>
						  			<div class="panel-body">
										<div class="table-responsive">
							  				<table class="table table-bordered">
												<thead>
												  <tr>
													<td class="text-center">Image</td>
													<td class="text-left">Product Name</td>
													<td class="text-left">Quantity</td>
													<td class="text-right">Unit Price</td>
													<td class="text-right">Total</td>
												  </tr>
												</thead>
												<tbody>
													<input type="hidden" id="max_order" value="{!!$product->max_order!!}" name="max_order">
													<input type="hidden" value="{!!$product->id!!}" name="product_id">
													<tr>
														<td class="text-center"><a href="product.html"><img width="60px" src="{!! $product?$product->image==''?asset('backEnd/img/no.jpg'):asset('uploads/product/feature/'.$product->image):asset('backEnd/img/no.jpg') !!}" alt="Xitefun Causal Wear Fancy Shoes" title="Xitefun Causal Wear Fancy Shoes" class="img-thumbnail"></a></td>
														<td class="text-left"><a href="product.html">{!!$product?$product->name_en: ''!!}</a></td>
														<td class="text-left">
															<div class="checkout">
																<p class="price" data-price="{!!$product?$product->sell_price: ''!!}"></p>
															<input type="text" name="quantity" class="quantity" value="1">
															 <h4>Available Size Options</h4>
								                            <div id="input_option">
								                               @if(!$variant->isEmpty())
                            					@foreach($variant as $var)
								                                        <div class="checkbox">
								                                            <label for="checkbox_1">
								                                                <input type="checkbox" name="option" value="{!!$var->id!!}" id="checkbox_1">
								            @if(App::isLocale('kh'))
                                                        {!!$var?$var->name_kh: '$var->name_en'!!}
                                                    @else
                                                        {!!$var?$var->name_en: '$var->name_kh'!!}
                                    @endif                                                            </label>
								                                        </div>    
								                                    @endforeach
								                                @endif  
								                            </div>
															</div>
														</td>
														<td class="text-right">${!!$product?$product->sell_price: ''!!}</td>
														<td class="text-right" id="example"><span id="total">${!!$product?$product->sell_price: ''!!}</span></td>
													</tr>
												</tbody>
												<tfoot>
												  	<tr>
														<td class="text-right" colspan="4"><strong>Discount:</strong></td>
														<td class="text-right">
																@foreach($producting as $pro)
																<input type="hidden" id="dis_count" value="<?php
														if ($pro->dis != null) {
															 $price = $pro->sell_price;
                                                            $percentage = $pro->dis->percentage;
                                                            $price_discount = ($price*$percentage)/100;
                                                            echo $price_discount ;
														}else
															echo 0;
                                                             ?>" name="dis_count">
																 <input type="hidden" class="discount" data-discount="<?php
                                                             if ($pro->dis != null) {
                                                             	$percentage = $pro->dis->percentage;

                                                            echo $percentage;
                                                             }else{
                                                             	 echo  0;
                                                             }
                                                             ?>" name="dis">
															@if($pro->dis != null)
                                                           <?php
                                                            $percentage = $pro->dis->percentage;

                                                            echo $percentage.('%');
                                                             ?>
                                           					@else
                                           					<?php 
                                           						echo "0%";
                                           					 ?>
                                                        @endif
																@endforeach
														</td>
												  	</tr>
												  	<tr>
														<td class="text-right" colspan="4"><strong> Sub-Total:</strong></td>

														<td class="text-right">
														<input type="hidden" value="{!!$product?$product->sell_price: ''!!}" id="totaler" name="subtotal"><span id="sub_total">${!!$product?$product->sell_price: ''!!}
														</span></td>
												  	</tr>
												  	<tr>
														<td class="text-right" colspan="4"><strong>Amount:</strong></td>
														<td class="text-right">
															@foreach($producting as $pro)
														<input type="hidden" id="tol" value="<?php
														if ($pro->dis != null) {
															 $price = $pro->sell_price;
                                                            $percentage = $pro->dis->percentage;
                                                            $price_discount = ($price*$percentage)/100;
                                                            echo $total_price = $price-$price_discount;
														}else
															echo $pro->sell_price;
                                                             ?>" name="sell_price"><span id="amout">
														@if($pro->dis != null)
                                                            <?php
                                                            $price = $pro->sell_price;
                                                            $percentage = $pro->dis->percentage;
                                                            $price_discount = ($price*$percentage)/100;
                                                            echo $total_price = $price-$price_discount;
                                                             ?>
                                                        @else
                                                            $ {!!$pro->sell_price!!} 
                                                        @endif
                                                    </span>
																@endforeach</span>
																</td>
												  	</tr>
												</tfoot>
							  				</table>
										</div>
						  			</div>
					  			</div>
							</div>
							<div class="col-sm-12">
					  			<div class="panel panel-default">
									<div class="panel-heading">
									  	<h4 class="panel-title"><i class="fa fa-pencil"></i> Add Comments About Your Order</h4>
									</div>
						  			<div class="panel-body">
										<textarea rows="4" class="form-control" id="confirm_comment" name="comments"></textarea>
										<br>
										<label class="control-label" for="confirm_agree">
								  			<input type="checkbox" checked="checked" value="1"  class="validate required" id="confirm_agree" name="confirm agree">
								  			<span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> 
								  		</label>
										<div class="buttons">
											<div class="pull-right">
												<input type="submit" class="tester btn btn-primary" id="button-confirm" value="Confirm Order">
											</div>
										</div>
						  			</div>
					  			</div>
							</div>
				  		</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@stop