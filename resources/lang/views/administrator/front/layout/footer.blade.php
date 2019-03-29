<div class="footer-middle ">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">
                <div class="infos-footer module">
                    <h3 class="modtitle">{!! trans('menu.contact info')!!}</h3>
                    <ul class="menu">
                        <li class="adres">
                            @if(App::isLocale('kh'))
                                 {!!$address?$address->location_kh:''!!}
                            @else
                                 {!!$address?$address->location_en:''!!}
                            @endif
                        </li>
                        <li class="phone">
                            (+855) {!!$address?$address->phone:''!!} - {!!$address?$address->phone1:''!!}
                        </li>
                        <li class="mail">
                            
                            <a href="mailto:{!!$address?$address->email:''!!}" target="_top">{!!$address?$address->email:''!!}</a>
                        </li>
                        <li class="time">
                             @if(App::isLocale('kh'))
                                 {!!$address?$address->open_kh:''!!}
                            @else
                                 {!!$address?$address->open_en:''!!}
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                <div class="box-information box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle">{!!trans('menu.Information')!!}</h3>
                        <div class="modcontent">
                            <ul class="menu">
                                <li><a href="{{route('home')}}">{!!trans('menu.home')!!}</a></li>
                                <li><a href="{{route('aboutus')}}">{!!trans('menu.about')!!}</a></li>
                                <li><a href="{{route('howtobuy')}}">{!!trans('menu.How To Buy')!!}</a></li>
                                <li><a href="{{route('dilivery')}}">{!!trans('menu.Delivery Information')!!}</a></li>
                                <li><a href="{{route('return')}}">{!!trans('menu.Returns Policy')!!}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                <div class="box-account box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle">{!!trans('menu.Customer Service')!!}</h3>
                        <div class="modcontent">
                            <ul class="menu">
                                <li><a href="{{route('contactus')}}">{!!trans('menu.contact')!!}</a></li>
                                <li><a href="{{route('return')}}">{!!trans('menu.Returns')!!}</a></li>
                                <li><a href="{{route('member-login')}}">{!!trans('menu.My account')!!}</a></li>
                                <li><a href="{{route('order-history')}}">{!!trans('menu.Order History')!!}</a></li>
                                <li><a href="#">{!!trans('menu.Career')!!}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                <div class="box-service box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle">{!!trans('menu.GET THE APP')!!}</h3>
                        <div class="modcontent">
                            <ul class="menu">
                               <!-- <li><img src="{!!asset('front/image/logo1.png') !!}" title="Your Store" alt="Your Store" /></li>-->
                                <li class="appstore"><img class="divle" src="{!!asset('front/image/itunes-app-store-logo.png') !!}" alt="IOS"></li>
                                <li class="playstore"><img class="divle" src="{!!asset('front/image/googleplay.png') !!}" alt="Android"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">
                <div class="module box-footer so-instagram-gallery-ltr">
                    <h4 class="modtitle">{!!trans('menu.OUR FACEBOOK PAGE')!!}</h4>
                    <div class="modcontent">
                       <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=450076342128919&autoLogAppEvents=1';
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-page"
                          data-href="https://www.facebook.com/onlineget.co" 
                          data-width="340"
                          data-hide-cover="false"
                          data-show-facepile="true">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>