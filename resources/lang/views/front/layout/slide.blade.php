 <div class="slider-container row"> 
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col2">
        <div class="module sohomepage-slider ">
            <div class="yt-content-slider"  data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                @if(!$slide->isEmpty())
                    @foreach($slide as $sli)
                        <div class="yt-content-slide">
                            <a href="{!!$sli?$sli->link:'#'!!}"><img src="{{asset('uploads/slideshow/'.$sli->image)}}" alt="slider1" class="img-responsive"></a>
                        </div>
                    @endforeach
                @endif
            </div>
            <!--<div class="loadeding"></div>-->
        </div>
    </div>
    @if(!$product_left->isEmpty())
        @foreach($product_left as $lefpro)
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col3 imglef">
                <div class="modcontent clearfix">
                    <div class="banners banners1">
                        <div class="b-img">
                            <a href="{{route('product-detail',$lefpro->id)}}"><img src="{!! $lefpro?$lefpro->image==''?asset('front/image/no1.png'):asset('uploads/leftslide/'.$lefpro->image):asset('front/image/no1.png') !!}" alt="banner1" class="pro_lef"></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="banners banners3">
    <div class="banner">
        <a href="#">
            <img src="{!!asset('uploads/advertise/'.$add_top->image)!!}" alt="image">
        </a>
    </div>
</div>