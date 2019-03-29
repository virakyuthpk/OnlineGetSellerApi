<nav class="navbar-default">
    <div class="container-megamenu vertical">
        <div id="menuHeading">
            <div class="megamenuToogle-wrapper">
                <div class="megamenuToogle-pattern">
                    <div class="container hov">
                        <div>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        Categories
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-header">
            <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
            <i class="fa fa-bars"></i>
            <span>  All Categories</span>
            </button>
        </div>
        <div class="vertical-wrapper" >
            <span id="remove-verticalmenu" class="fa fa-times"></span>
            <div class="megamenu-pattern">
                <div class="container-mega">
                    <ul class="megamenu">
                        @if(!$category->isEmpty())
                            @foreach($category as $cate)
                                <li class="item-vertical css-menu with-sub-menu hover">
                                    <p class="close-menu"></p>
                                    <a href="{{route('product-detail',$cate->id)}}" class="clearfix">
                                        <img src="{!! $cate?$cate-> icon==''?asset('uploads/icon/ico9'):asset('uploads/icon/'.$cate->icon):asset('uploads/icon/ico9') !!}" alt="icon">
                                        <span>
                                            @if(App::isLocale('kh'))
                                                {!!$cate?$cate->title_kh: ''!!}
                                            @else
                                               {!!$cate?$cate->title_en: ''!!}
                                            @endif
                                        </span>
                                        <b class="caret"></b>
                                    </a>
                                    @if(!$cate->subcate->isEmpty())
                                    <div class="sub-menu" data-subwidth="20">
                                        <div class="content" >
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 hover-menu">
                                                            <div class="menu">
                                                                <ul>
                                                                    @foreach($cate->subcate as $subca)
                                                                        <li>
                                                                            <a href="{{route('product-detail',$cate->id)}}" class="main-menu">
                                                                                @if(App::isLocale('kh'))
                                                                                    {!!$subca?$subca->title_kh: ''!!}
                                                                                @else
                                                                                   {!!$subca?$subca->title_en: ''!!}
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                        <li class="loadmore">
                            <i class="fa fa-plus-square-o"></i>
                            <span class="more-view">More Categories</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>