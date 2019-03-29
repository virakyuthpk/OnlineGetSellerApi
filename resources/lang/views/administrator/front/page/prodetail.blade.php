@extends('front.layout.layout')
@section('content')
@if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{Session::get('message')}}</strong>
        </div>
    @endif
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">{!!$prodetail?$prodetail->name_en: ''!!}</a></li>
    </ul>
    <div class="row">
        <div id="content" class="col-md-12 col-sm-8">
            <div class="product-view row">
                <div class="left-content-product">
                    <div class="product-image-section col-md-5 col-xs-12">
    <div class="img-product-wrapper">
      <div class="img-thumbs">
        <div class="slim-scroll">
          @foreach($pho as $pro)
          <div class="item">
            <a href="" title="" data-lg-img="{!!$pro?$pro->path==''?asset('frontEnd/image/no1.png'):asset('uploads/product/small/'.$pro->path):asset('frontEnd/image/no1.png') !!}" class="pic"><img src="{!!$pro?$pro->path==''?asset('frontEnd/image/no1.png'):asset('uploads/product/small/'.$pro->path):asset('frontEnd/image/no1.png') !!}" title="{!!$prodetail->name_en!!}" alt="" class="img-responsive"></a>
          </div>
          @endforeach
          
        </div>
      </div>
      <div class="lg-img-view">
        <div class="inner">
          <a href="{!!$pro?$pro->path==''?asset('frontEnd/image/no1.png'):asset('uploads/product/small/'.$pro->path):asset('frontEnd/image/no1.png') !!}" class="fancy-view">
             <img src="{!!$gallery?$gallery->path==''?asset('front/image/no1.png'):asset('uploads/product/small/'.$gallery->path):asset('front/image/no1.png') !!}" alt="" title="{!!$prodetail->name_en!!}" class="large-view">
          </a>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
                    <div class="content-product-right col-md-7 col-sm-12 col-xs-12">
                        <div class="title-product">
                            <h1>
                                @if(App::isLocale('kh'))
                                   {!!$prodetail?$prodetail->name_kh: ''!!}
                                @else
                                   {!!$prodetail?$prodetail->name_en: ''!!}
                                @endif
                            </h1>
                        </div>
                        <div class="product-label form-group">
                            <div class="product_page_price price" itemprop="offerDetails" itemscope="" itemtype="http://data-vocabulary.org/Offer">
                                <span class="price-new">
                                    @if($dis != null)
                                        <?php
                                        $price = $prodetail->sell_price;
                                        $percentage = $dis->percentage;
                                        $price_discount = ($price*$percentage)/100;
                                        echo $total_price = $price-$price_discount;
                                         ?>
                                    @else
                                        $ {!!$prodetail->sell_price!!} 
                                    @endif
                                </span>
                                @if($dis != null)
                                    <span class="price-old">
                                     $ {!!$prodetail->sell_price!!} 
                                    </span>
                                @endif
                               <!-- <span class="price-new" itemprop="price">${!!$prodetail?$prodetail->sell_price: ''!!}</span>
                                <span class="price-old">$122.00</span>-->
                            </div>
                        </div>
                        <div class="product-box-desc">
                            <p>
                                @if(App::isLocale('kh'))
                                   {!!$prodetail?$prodetail->detail_kh: ''!!}
                                @else
                                   {!!$prodetail?$prodetail->detail_en: ''!!}
                                @endif
                            </p>
                        </div>
                        <div id="product">
                            <div class="form-group box-info-product">
                                <div class="cart">
                                    <input type="button" data-toggle="tooltip" title="" value="Add to Cart" data-loading-text="Loading..." id="button-cart" class="btn btn-mega btn-lg" onclick="cart.add('42', '1');" data-original-title="Add to Cart">
                                </div>
                                <div class="add-to-links wish_comp">
                                    <ul class="blank list-inline">
                                      
                                        <li class="compare">
                                            <a class="icon" href="{{route('order',$prodetail->id)}}">
                                             Order
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="producttab ">
                <div class="tabsslider horizontal-tabs  col-xs-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Description</a></li>
                    </ul>
                    <div class="tab-content col-xs-12">
                        <div id="tab-1" class="tab-pane fade active in">
                             @if(App::isLocale('kh'))
                                   {!!$prodetail?$prodetail->des_kh: ''!!}
                                @else
                                  {!!$prodetail?$prodetail->des_en: ''!!}
                                @endif
                           <!-- <p></p>-->
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-12 col-sm-12">
                <form class="form-horizontal" method="post" action="{{route('comment')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <div class="form-group">
                    <input type="hidden" value="{!!$prodetail->id!!}" name="pro_id">
                        <label>Comments: <span class="required">*</span></label>
                        <textarea cols="6" name="comment" rows="6" placeholder="Your comments..." class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success pull-right">Comment</button>
                </form>
            </div>
            <div class="related titleLine products-list grid module ">
                <h3 class="modtitle">Related Products  </h3>
              <!--  <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">-->   
                    @foreach($related as $re)
                        <div class="col-md-3">
                            <div class="item-inner product-layout transition product-grid">
                                <div class="product-item-container">
                                    <div class="left-block">
                                        <div class="product-image-container second_img">
                                            <a href="{{route('product-detail',$re->id)}}" target="_self" title="{!!$re?$re->name_en: ''!!}">  <img itemprop="image" class="product-image-zoom" src="{!! $re?$re->image==''?asset('front/image/no1.png'):asset('uploads/product/feature/'.$re->image):asset('front/image/no1.png') !!}" class="img-1 img-responsive" alt="image"  title="{!!$re?$re->name_en: ''!!}" alt="{!!$re?$re->name_en: ''!!}">
                                            </a>
                                        </div>
                                        <div class="button-group so-quickview cartinfo--left">
                                            <form  method="post" class="formcart">
                                                 {{csrf_field()}}
                                                <button type="button" class="addToCart btn-button" title="Add to cart" data-id="{!! $re->id !!}"
                                                  data-name="{!! $re->name_en !!}"
                                                  data-price="{!! $re->sell_price !!}"
                                                  data-qty="1"
                                                  data-img="{!!$re->image !!}">  
                                                    <i class="fa fa-shopping-basket"></i>
                                                    <span>Add to cart </span>
                                                </button>
                                            </form>
                                           <!--  <a class="iframe-link btn-button quickview_handler visible-lg" href="{{route('product-detail',$re->id)}}" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a> -->
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4><a href="{{route('product-detail',$re->id)}}" title="{!!$re?$re->name_en: ''!!}" target="_self">{!!$re?$re->name_en: ''!!}</a></h4>
                                            <div class="price">${!!$re?$re->sell_price: ''!!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
@stop