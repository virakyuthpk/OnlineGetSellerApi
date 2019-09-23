<div class="header-top hidden-compact">
    <div class="container">
        <div class="row">
            <div class="header-top-right collapsed-block">
                <div class="col-md-9">
                    
                    <div class="mobile">
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <a href="<?php echo e(route('member-login')); ?>" title="<?php echo trans('menu.My account'); ?>" class="btn-xs" ><i class="fa  fa-user-md "></i> <span><?php echo trans('menu.My account'); ?></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <i class="fa fa-bandcamp" aria-hidden="true"></i>
                                <a href="<?php echo e(route('return')); ?>">
                                <?php echo trans('menu.Returns Policy'); ?></a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <a href="<?php echo e(route('dilivery')); ?>"><?php echo trans('menu.Delivery Information'); ?></a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <a href="<?php echo e(route('howtobuy')); ?>" title="My Account " class="btn-xs" ><i class="fa  fa-book "></i> <span><?php echo trans('menu.How To Buy'); ?></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <a href="<?php echo e(route('order-history')); ?>" title="<?php echo trans('menu.Order History'); ?>" class="btn-xs" ><i class="fa  fa-newspaper-o "></i> <span><?php echo trans('menu.Order History'); ?></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="top-link list-inline acc">
                            <li class="" id="my_account">
                                <a href="<?php echo e(route('sale')); ?>" title="<?php echo trans('menu.sale'); ?>"><i class="fa fa-money"></i> 
                                    <span><?php echo trans('menu.sale'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <div class="navbar-header" style="float: left !important;">
                    <ul class="top-link list-inline acc home_moble">
                        <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
                            <i class="fa fa-bars fa-2x"></i>
                        </button>
                    </ul>
            <!--<div class="col-md-6 col-sm-6 searchpadding">-->
            <!--    <div class="search-header-w">-->
            <!--        <div class="icon-search hidden-lg hidden-md hidden-sm">-->
            <!--            <i class="fa fa-search"></i>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
                </div>
                <div class="col-md-2">
                    <ul class="top-link list-inline lang-curr">
                        <li class="currency">
                            <div class="btn-group currencies-block">
                                <?php if(Auth()->user() != null): ?>
                                    <?php if(Auth()->user()->role == 'member'): ?>
                                    <a href="<?php echo e(route('acc_setting')); ?>" class="text_cycle"> <?php echo str_limit(Auth::user()->username,20); ?> </a>
                                     <?php elseif(Auth()->user()->role == 'saller'): ?>
                                    <a href="<?php echo e(route('product-vendor')); ?>" class="text_cycle"> <?php echo str_limit(Auth::user()->username,20); ?> </a>
                                <?php else: ?>
                                    <a class="btn btn-link" href="<?php echo e(route('member-login')); ?>">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    <?php echo trans('menu.login'); ?>  <i class="fa fa-user"></i> <?php echo trans('menu.register'); ?><span class="fa fa-angle-down"></span></a>
                                <?php endif; ?>
                                <?php else: ?>
                                    <a class="btn btn-link" href="<?php echo e(route('member-login')); ?>">
                                        <i class="fa fa-cog" aria-hidden="true"></i>  <?php echo trans('menu.login'); ?> <i class="fa fa-user"></i> <?php echo trans('menu.register'); ?>  <span class="fa fa-angle-down"></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li class="language">
                            <div class="btn-group languages-block ">
                                <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <?php if(App::isLocale('kh')): ?>
                                        <img src="<?php echo asset('front/image/kh.png'); ?>" alt="Khmer" title="English">
                                        <span class=""> ខ្មែរ</span>
                                    <?php else: ?>
                                        <img src="<?php echo asset('front/image/en.png'); ?>" alt="Khmer" title="English">
                                        <span class=""> English</span>
                                    <?php endif; ?>
                                    <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(url('/switchLanguage/en')); ?>"><img class="image_flag" src="<?php echo asset('front/image/en.png'); ?>" alt="English" title="English"/> English</a></li>
                                    <li> <a href="<?php echo e(url('/switchLanguage/kh')); ?>"> <img class="image_flag" src="<?php echo asset('front/image/kh.png'); ?>" alt="Arabic" title="Arabic" />ខ្មែរ</a> </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>