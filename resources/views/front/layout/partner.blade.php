<div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="yt-content-slider contentslider" data-autoplay="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="8" data-items_column1="6" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes"
    data-pagination="no" data-lazyload="yes" data-loop="no">
    @if(!$partner->isEmpty())
        @foreach($partner as $part)
            <div class="item">
                <a href="#">
                    <img src="{!!asset('uploads/partner/'.$part->image)!!}" alt="brand">
                </a>
            </div>
        @endforeach
    @endif
</div>
</div>