
<?php if(!$data->isEmpty()): ?>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$value->pup_product->isEmpty()): ?>
            <?php if($value->count_row == 2): ?>
                <div class="module product-simple">
                    <h3 class="modtitle">
                    <span>  <i class="bf-icon  fa fa-folder-open"></i> Populor product </span>
                    </h3>
                    <div class="modcontent">
                        <div id="so_extra_slider_1" class="extraslider" >
                            <div class="yt-content-slider extraslider-inner" data-rtl="yes" data-pagination="yes" data-autoplay="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="no" data-lazyload="yes" data-loop="no" data-buttonpage="top">
                                <div class="item ">
                                    <?php $__currentLoopData = $value->pup_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="product-layout item-inner style1 ">
                                            <div class="item-image">
                                                <div class="item-img-info">
                                                    <a href="<?php echo e(route('product-detail',$pop->id)); ?>" target="_self" title="Mandouille short ">
                                                        <img src="<?php echo $pop?$pop->image==''?asset('front/image/no1.png'):asset('uploads/product/feature/'.$pop->image):asset('front/image/no1.png'); ?>" alt="Mandouille short">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title">
                                                    <a href="<?php echo e(route('product-detail',$pop->id)); ?>" target="_self" title="Mandouille short">
                                                        <?php if(App::isLocale('kh')): ?>
                                                            <?php echo $pop?$pop->name_kh: ''; ?>

                                                        <?php else: ?>
                                                            <?php echo $pop?$pop->name_en: ''; ?>

                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="content_price price">
                                                    <span class="price-new product-price">
                                                        <?php echo $pop->sell_price; ?>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<!--<div class="module">
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
</div>-->
<!--<div class="module">
    <div class="banners banners4">
        <div class="banner">
            <a href="#"><img src="<?php echo asset('front/image/catalog/banners/banner5.jpg'); ?>" alt="image"></a>
        </div>
    </div>
</div>-->
 <div class="module product-simple">
    <?php if(!$shops->isEmpty()): ?>
        <h3 class="modtitle">
            <span>  
            <i class="bf-icon  fa fa-shopping-bag"></i> 
            Get Mall
        </span>
        </h3>
        <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="module">
                <div class="banners banners2">
                    <a class="card-official-stores-box hp-mod-card-hover align-left" href="#" title="<?php echo $shop->shop_name; ?>">
                    <div class="card-official-stores-brand-overlay"></div>
                    <div class="card-official-stores-brand-img">
                      <img src="<?php echo $shop?$shop->shop_cover==''?asset('front/image/defaul.jpg'):asset('uploads/vendor/'.$shop->shop_cover):asset('front/image/defaul.jpg'); ?>" class="image" alt="Eloop">
                    </div>
                    <div class="card-official-stores-shop-img">
                      <img src="<?php echo $shop?$shop->pic==''?asset('front/image/default1.jpg'):asset('uploads/vendor/'.$shop->pic):asset('front/image/default1.jpg'); ?>" class="image" alt="Eloop">
                    </div>
                    <div class="card-official-stores-h1"><?php echo $shop->shop_name; ?></div>
                   <!-- <p class="card-official-stores-p"> Power Bank </p>-->
                  </a>
                   <!-- <div class="banner">
                        <a href="#"><img src="<?php echo $shop?$shop->pic==''?asset('front/image/no1.png'):asset('uploads/vendor/'.$shop->pic):asset('front/image/no1.png'); ?>" alt="image"></a>
                    </div>-->
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
