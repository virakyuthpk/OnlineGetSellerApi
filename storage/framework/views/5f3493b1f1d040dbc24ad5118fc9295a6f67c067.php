
<?php $__env->startSection('subscribe'); ?>
<?php echo $__env->make('front.layout.subscribe', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('slide'); ?>
<?php echo $__env->make('front.layout.slide', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<!--  -->
<?php $__env->startSection('partner'); ?>
<?php echo $__env->make('front.layout.partner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if(!$pcate->isEmpty()): ?>
    <?php $__currentLoopData = $pcate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="module listingtab-layout1">
    <h3 class="modtitle">
        <a target="_black" href="<?php echo e(route('product-category',$cate->id)); ?>">
            <span>
                <?php if(App::isLocale('kh')): ?>
                    <?php echo $cate?$cate->title_kh:'$cate->title_en'; ?>

                <?php else: ?>
                    <?php echo $cate?$cate->title_en:'$cate->title_kh'; ?>

                <?php endif; ?>
            </span>
        </a>
    </h3>
    <div id="so_listing_tabs_1" class="so-listing-tabs first-load">
       <!-- <div class="loadeding"></div>-->
        <div class="ltabs-wrap">
            <div class="ltabs-items-container products-list grid">
                <div class="ltabs-items ltabs-items-selected items-category-20" data-total="16">
                    <div class="ltabs-items-inner ltabs-slider">
                        <div class="ltabs-item">
                            <?php if(!$cate->product->isEmpty()): ?>
                                <?php $__currentLoopData = $cate->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item-inner product-layout transition product-grid col-md-3 col-sm-6 col-xs-6">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img">
                                                <a href="<?php echo e(route('product-detail',$pro->id)); ?>" target="_self" title="<?php echo $pro?$pro->name_en: ''; ?>">
                                                    <img src="<?php echo $pro?$pro->image==''?asset('front/image/no1.png'):asset('uploads/product/feature/'.$pro->image):asset('front/image/no1.png'); ?>" class="img-1 img-responsive" alt="image">
                                       <?php //dd($pro->imgcover->path);?>
                                                    <img src="<?php echo $pro?$pro->image==''?asset('front/image/no1.png'):asset('uploads/product/feature/'.$pro->image):asset('front/image/no1.png'); ?>" class="img-2 img-responsive" alt="image">
                                                </a>
                                            </div>
                                            <div class="box-label">
                                                <?php if($pro->dis != null): ?>
                                                   <span class="label-product label-product-sale"> 
                                                   <?php echo $pro->dis->percentage; ?> %
                                                <?php else: ?>
                                                 <?php 
                                                   $created = $pro->created_at->format('Y/m/d') ;
                                                  $currendate =  date('Y/m/d');
                                                  if ($created == $currendate ) { ?>
                                                      <span class="label-product label-new"> 
                                                       New
                                                    </span>
                                                 <?php }

                                                  ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="button-group so-quickview cartinfo--left">
                                                <form  method="post" class="formcart">
                                                 <?php echo e(csrf_field()); ?>

                                                <button type="button" class="addToCart btn-button" title="Add to cart" data-id="<?php echo $pro->id; ?>"
                                                  data-name="<?php echo $pro->name_en; ?>"
                                                  data-price="<?php echo $pro->sell_price; ?>"
                                                  data-qty="1"
                                                  data-img="<?php echo $pro->image; ?>">  
                                                    <i class="fa fa-shopping-basket"></i>
                                                    <span>Add to cart </span>
                                                    </button>
                                                </form>
                                                <!-- <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="<?php echo e(route('product-detail',$pro->id)); ?>" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a> -->
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="<?php echo e(route('product-detail',$pro->id)); ?>" title=" <?php echo $pro?$pro->name_en: ''; ?>" target="_self">
                                                    <?php if(App::isLocale('kh')): ?>
                                                    <?php echo $pro?$pro->name_kh: ''; ?>

                                                    <?php else: ?>
                                                    <?php echo $pro?$pro->name_en: ''; ?>

                                                    <?php endif; ?>
                                                </a></h4>
                                                <div class="price">
                                                    <span class="price-new">
                                                        <?php if($pro->dis != null): ?>
                                                            <?php
                                                            $price = $pro->sell_price;
                                                            $percentage = $pro->dis->percentage;
                                                            $price_discount = ($price*$percentage)/100;
                                                            echo "$".$total_price = $price-$price_discount;
                                                             ?>
                                                        <?php else: ?>
                                                            $ <?php echo $pro->sell_price; ?> 
                                                        <?php endif; ?>
                                                    </span>
                                                    <?php if($pro->dis != null): ?>
                                                        <span class="price-old">
                                                         $ <?php echo $pro->sell_price; ?> 
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <p>No result found</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>