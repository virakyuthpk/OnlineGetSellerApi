@extends('front.layout.layout')
@section('subscribe')
@include('front.layout.subscribe')
@stop
@section('slide')
@include('front.layout.slide')
@stop
<!--  -->
@section('partner')
@include('front.layout.partner')
@stop
@section('content')
<div class="module listingtab-layout1">
    <h3 class="modtitle">
        <span>
           {!!trans('menu.product_list')!!}
        </span>
    </h3>
    <div id="so_listing_tabs_1" class="so-listing-tabs first-load">
        <div class="loadeding"></div>
        <div class="ltabs-wrap">
            <div class="ltabs-items-container products-list grid">
                <div class="ltabs-items ltabs-items-selected items-category-20" data-total="16">
                    <div class="ltabs-items-inner ltabs-slider">
                        <div class="ltabs-item">
                            @if(!$product->isEmpty())
                                @foreach($product as $pro)
                                <div class="item-inner product-layout transition product-grid col-md-3 col-sm-6 col-xs-6">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img">
                                                <a href="{{route('product-detail',$pro->id)}}" target="_self" title="{!!$pro?$pro->name_en: ''!!}">
                                                    <img src="{!! $pro?$pro->image==''?asset('front/image/no1.png'):asset('uploads/product/feature/'.$pro->image):asset('front/image/no1.png') !!}" class="img-1 img-responsive" alt="image">
                                                    <img src="{!! $pro?$pro->image==''?asset('front/image/no1.png'):asset('uploads/product/feature/'.$pro->image):asset('front/image/no1.png') !!}" class="img-2 img-responsive" alt="image">
                                                </a>
                                            </div>
                                            <div class="box-label">
                                                @if($pro->dis != null)
                                                   <span class="label-product label-product-sale"> 
                                                   {!!$pro->dis->percentage!!} %
                                                @else
                                                 <?php 
                                                   $created = $pro->created_at->format('Y/m/d') ;
                                                  $currendate =  date('Y/m/d');
                                                  if ($created == $currendate ) { ?>
                                                      <span class="label-product label-new"> 
                                                       New
                                                    </span>
                                                 <?php }

                                                  ?>
                                                @endif
                                            </div>
                                            <div class="button-group so-quickview cartinfo--left">
                                                <form  method="post" class="formcart">
                                                 {{csrf_field()}}
                                                <button type="button" class="addToCart btn-button" title="Add to cart" data-id="{!! $pro->id !!}"
                                                  data-name="{!! $pro->name_en !!}"
                                                  data-price="{!! $pro->sell_price !!}"
                                                  data-qty="1"
                                                  data-img="{!!$pro->image !!}">  
                                                    <i class="fa fa-shopping-basket"></i>
                                                    <span>Add to cart </span>
                                                    </button>
                                                </form>
                                                <!-- <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="{{route('product-detail',$pro->id)}}" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a> -->
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="{{route('product-detail',$pro->id)}}" title=" {!!$pro?$pro->name_en: ''!!}" target="_self">
                                                    @if(App::isLocale('kh'))
                                                    {!!$pro?$pro->name_kh: ''!!}
                                                    @else
                                                    {!!$pro?$pro->name_en: ''!!}
                                                    @endif
                                                </a></h4>
                                                <div class="price">
                                                    <span class="price-new">
                                                        @if($pro->dis != null)
                                                            <?php
                                                            $price = $pro->sell_price;
                                                            $percentage = $pro->dis->percentage;
                                                            $price_discount = ($price*$percentage)/100;
                                                            echo "$".$total_price = $price-$price_discount;
                                                             ?>
                                                        @else
                                                            $ {!!$pro->sell_price!!} 
                                                        @endif
                                                    </span>
                                                    @if($pro->dis != null)
                                                        <span class="price-old">
                                                         $ {!!$pro->sell_price!!} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <p>No result found</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        {!! $product->links() !!}
    </div>
</div>
@stop