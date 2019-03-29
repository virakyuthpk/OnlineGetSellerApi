@if(!$add_left_top->isEmpty())
    @foreach($add_left_top as $add)
        <div class="module">
            <div class="banners banners2">
                <div class="banner">
                    <a href="#"><img src="{!! $add?$add-> image==''?asset('uploads/advertise/ico9'):asset('uploads/advertise/'.$add->  image):asset('image/catalog/banners/banner4.jpg') !!}" alt="image"></a>
                </div>
            </div>
        </div>
    @endforeach
@endif
@if(!$data->isEmpty())
    @foreach($data as $value)
        @if(!$value->pup_product->isEmpty())
            @if($value->count_row == 2)
                <div class="module product-simple">
                    <h3 class="modtitle">
                    <span>  <i class="bf-icon  fa fa-folder-open"></i> Populor product </span>
                    </h3>
                    <div class="modcontent">
                        <div id="so_extra_slider_1" class="extraslider" >
                            <div class="yt-content-slider extraslider-inner" data-rtl="yes" data-pagination="yes" data-autoplay="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="no" data-lazyload="yes" data-loop="no" data-buttonpage="top">
                                <div class="item ">
                                    @foreach($value->pup_product as $pop)
                                        <div class="product-layout item-inner style1 ">
                                            <div class="item-image">
                                                <div class="item-img-info">
                                                    <a href="{{route('product-detail',$pop->id)}}" target="_self" title="Mandouille short ">
                                                        <img src="{!! $pop?$pop->image==''?asset('front/image/no1.png'):asset('uploads/product/feature/'.$pop->image):asset('front/image/no1.png') !!}" alt="Mandouille short">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title">
                                                    <a href="{{route('product-detail',$pop->id)}}" target="_self" title="Mandouille short">
                                                        @if(App::isLocale('kh'))
                                                            {!!$pop?$pop->name_kh: ''!!}
                                                        @else
                                                            {!!$pop?$pop->name_en: ''!!}
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content_price price">
                                                    <span class="price-new product-price">
                                                        {!!$pop->sell_price!!}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
@endif
<div class="module">
    <ul class="block-infos">
        <li class="info1">
            <div class="inner">
                <i class="fa fa-file-text-o"></i>
                <div class="info-cont">
                    <a href="#">free delivery</a>
                    <p>On order over $49.86</p>
                </div>
            </div>
        </li>
        <li class="info2">
            <div class="inner">
                <i class="fa fa-shield"></i>
                <div class="info-cont">
                    <a href="#">order protecttion</a>
                    <p>secured information</p>
                </div>
            </div>
        </li>
        <li class="info3">
            <div class="inner">
                <i class="fa fa-gift"></i>
                <div class="info-cont">
                    <a href="#">promotion gift</a>
                    <p>special offers!</p>
                </div>
            </div>
        </li>
        <li class="info4">
            <div class="inner">
                <i class="fa fa-money"></i>
                <div class="info-cont">
                    <a href="#">money back</a>
                    <p>return over 30 days</p>
                </div>
            </div>
        </li>
    </ul>
</div>
<!--<div class="module">
    <div class="banners banners4">
        <div class="banner">
            <a href="#"><img src="{!!asset('front/image/catalog/banners/banner5.jpg') !!}" alt="image"></a>
        </div>
    </div>
</div>-->
@if(!$add_left_butom->isEmpty())
    @foreach($add_left_butom as $addbu)
        <div class="module">
            <div class="banners banners2">
                <div class="banner">
                    <a href="#"><img src="{!! $addbu?$addbu->image==''?asset('uploads/advertise/ico9'):asset('uploads/advertise/'.$addbu->image):asset('image/catalog/banners/banner4.jpg') !!}" alt="image"></a>
                </div>
            </div>
        </div>
    @endforeach
@endif
