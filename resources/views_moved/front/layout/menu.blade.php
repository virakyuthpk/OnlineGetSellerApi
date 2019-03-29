<div class="header-middle">
    <div class="container">
        <div class="row">
            <!-- Logo -->
            <div class="col-md-2 col-sm-12 col-xs-6 mobile">
                <div class="navbar-logo">
                    <div class="logo">
                        <a href="/">
                            <img src="{!! $logo?$logo->image==''?asset('front/image/logo.png'):asset('uploads/logo/'.$logo->image):asset('front/image/logo.png') !!}" title="Your Store" alt="Your Store" />
                        </a>
                    </div>
                </div>
            </div>
            <!-- //end Logo -->
            <!-- Main menu -->
            <div class="bottom1 menu-vertical  col-md-1 col-sm-1">
                <div class="responsive so-megamenu megamenu-style-dev ">
                    <div class="so-vertical-menu ">
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
                                                {!!trans('menu.Category')!!}
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
                                                            <a href="{{route('product-category',$cate->id)}}" class="clearfix">
                                                               
                                                                <span>
                                                                    @if(App::isLocale('kh'))
                                                                        {!!$cate?$cate->title_kh: '$cate->title_en'!!}
                                                                    @else
                                                                       {!!$cate?$cate->title_en: '$cate->title_kh'!!}
                                                                    @endif
                                                                </span>
                                                                <b class="caret"></b>
                                                            </a>
                                        @if(count($cate->subcate)>0)
                                                            <div class="sub-menu" data-subwidth="20" style="width: 203px; display: none; right: 0px;">
                                                                    <div class="content" style="display: none;">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12 hover-menu">
                                                                                        <div class="menu">
                                                                                            <ul>
                                                                                                @foreach($cate->subcate as $sub_cats)
                                                                                                    <li>
                                                                                                        <a href="{{route('product-category',$sub_cats->id)}}" class="main-menu">
                                                                                                            @if(App::isLocale('kh'))
                                                                                                                {!!$sub_cats?$sub_cats->title_kh: '$sub_cats->title_en'!!}
                                                                                                            @else
                                                                                                               {!!$sub_cats?$sub_cats->title_en: '$sub_cats->title_kh'!!}
                                                                                                            @endif
                                                                                                        </a>
                                                                                                        @if(count($sub_cats->child)> 0)
                                                                                                        <ul>
                                                                                                            @foreach($sub_cats->child as $child)
                                                                                                                <li>
                                                                                                                    <a href="{{route('product-category',$child->id)}}" >
                                                                                                                        @if(App::isLocale('kh'))
                                                                                                                            {!!$child?$child->title_kh: '$child->title_en'!!}
                                                                                                                        @else
                                                                                                                           {!!$child?$child->title_en: '$child->title_kh'!!}
                                                                                                                        @endif
                                                                                                                    </a>
                                                                                                                </li>  
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                        @endif
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
                                               <!-- <li class="loadmore">
                                                    <i class="fa fa-plus-square-o"></i>
                                                    <span class="more-view">More Categories</span>
                                                </li>-->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 searchpadding">
                <div class="search-header-w">
                    <div class="icon-search hidden-lg hidden-md hidden-sm"><i class="fa fa-search"></i></div>
                    <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                        <form method="GET" action="{{route('search')}}">
                            <div id="search0" class="search input-group form-group">
                                <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Search in Onlineget ..." name="search">
                                <span class="input-group-btn">
                                    <button type="submit" class="button-search btn btn-primary" name="submit_search">Search</button>
                                </span>
                            </div>
                            <input type="hidden" name="route" value="product/search" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="shopping_cart">
                    <div id="cart" class="btn-shopping-cart">
                        <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <div class="shopcart">
                                <span class="icon-c">
                                    <img src="{!!asset('front/image/cart1.png') !!}" title="Cart" alt="Cart" />
                                  <!--  <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>-->

                                </span>
                                <div class="shopcart-inner">
                                    <p class="text-shopping-cart">
                                       {!!trans('menu.My cart')!!}
                                    </p>
                                    <span class="total-shopping-cart cart-total-full">
                                        <span id="number_c" class="items_cart"><input id="counter" type="hidden" value="<?php echo Cart::count();?>" name=""><?php echo Cart::count();?></span><span class="items_cart2"> item(s)</span><span class="items_carts"><?php echo Cart::subtotal(); ?></span>
                                    </span>
                                </div>
                            </div>
                        </a>
                        @if (sizeof(Cart::content()) > 0)
                        <ul class="dropdown-menu pull-right shoppingcart-box" role="menu">
                            <li>
                                <table id="myTable" class="table table-striped">
                                    <tbody>
                                        <?php foreach(Cart::content() as $row) :?>
                                            <tr>
                                                <td class="text-center" style="width:70px">
                                                    <a href="product.html">
                                                        <img src="{!! $row?$row->img==''?asset('front/image/no1.png'):asset('uploads/product/'.$row->img):asset('front/image/no1.png') !!}" style="width:70px" alt="Yutculpa ullamcon" title="Yutculpa ullamco" class="preview">
                                                    </a>
                                                </td>
                                                <td class="text-left"> <a class="cart_product_name">
                                                    <?php echo $row->name; ?>
                                                </a>
                                                </td>
                                                <td class="text-center"><?php echo $row->qty; ?></td>
                                                <td class="text-center">$ <?php echo $row->price; ?></td>
                                                <td class="text-right">
                                                    <a href="" class="fa fa-edit"></a>
                                                </td>
                                                <td class="text-right">
                                                    <form method="post" action="{{route('removecart')}}">
                                                        <a class="fa fa-times fa-delete removeCart" data-id="{!! $row->id !!}" ></a>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="text-left"><strong>Sub-Total</strong>
                                                </td>
                                                <td class="text-right">$<?php echo Cart::subtotal(); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="text-right"> <a class="btn view-cart" href="{{route('carts')}}"><i class="fa fa-shopping-cart"></i>View Cart</a>
                                    </p>
                                </div>
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>