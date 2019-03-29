<div class="header-top hidden-compact">
    <div class="container">
        <div class="row">
            <div class="header-top-right collapsed-block">
                <div class="col-md-9">
                    <div class="mobile">
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <a href="{{route('member-login')}}" title="{!!trans('menu.My account')!!}" class="btn-xs" ><i class="fa  fa-user-md "></i> <span>{!!trans('menu.My account')!!}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <i class="fa fa-bandcamp" aria-hidden="true"></i>
                                <a href="{{route('return')}}">
                                {!!trans('menu.Returns Policy')!!}</a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <a href="{{route('dilivery')}}">{!!trans('menu.Delivery Information')!!}</a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <a href="{{route('howtobuy')}}" title="My Account " class="btn-xs" ><i class="fa  fa-book "></i> <span>{!!trans('menu.How To Buy')!!}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <a href="{{route('order-history')}}" title="{!!trans('menu.Order History')!!}" class="btn-xs" ><i class="fa  fa-newspaper-o "></i> <span>{!!trans('menu.Order History')!!}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <a href="{{route('sale')}}" title="{!!trans('menu.sale')!!}"><i class="fa fa-money"></i> 
                                    <span>{!!trans('menu.sale')!!}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="top-link list-inline acc home_moble">
                        <li class="" id="my_account">
                            <a href="{{route('home')}}"><i class="fa fa-home"></i> <span>Onlineget</span>
                                </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="top-link list-inline lang-curr">
                        <li class="currency">
                            <div class="btn-group currencies-block">
                                @if(Auth()->user() != null)
                                    @if(Auth()->user()->role == 'member')
                                    <a href="{{route('acc_setting')}}" class="text_cycle"> {!! str_limit(Auth::user()->username,20)!!} </a>
                                     @elseif(Auth()->user()->role == 'saller')
                                    <a href="{{route('product-vendor')}}" class="text_cycle"> {!! str_limit(Auth::user()->username,20)!!} </a>
                                @else
                                    <a class="btn btn-link" href="{{route('member-login')}}">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    {!!trans('menu.login')!!}  <i class="fa fa-user"></i> {!!trans('menu.register')!!}<span class="fa fa-angle-down"></span></a>
                                @endif
                                @else
                                    <a class="btn btn-link" href="{{route('member-login')}}">
                                        <i class="fa fa-cog" aria-hidden="true"></i>  {!!trans('menu.login')!!} <i class="fa fa-user"></i> {!!trans('menu.register')!!}  <span class="fa fa-angle-down"></span>
                                    </a>
                                @endif
                            </div>
                        </li>
                        <li class="language">
                            <div class="btn-group languages-block ">
                                <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        @if(App::isLocale('kh'))
                                        <img src="{!!asset('front/image/kh.png') !!}" alt="Khmer" title="English">
                                        <span class="">ខ្មែរ</span>
                                    @else
                                        <img src="{!!asset('front/image/en.png') !!}" alt="Khmer" title="English">
                                        <span class="">English</span>
                                    @endif
                                    <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/switchLanguage/en') }}"><img class="image_flag" src="{!!asset('front/image/en.png') !!}" alt="English" title="English"/> English</a></li>
                                    <li> <a href="{{ url('/switchLanguage/kh') }}"> <img class="image_flag" src="{!!asset('front/image/kh.png') !!}" alt="Arabic" title="Arabic" />ខ្មែរ</a> </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>