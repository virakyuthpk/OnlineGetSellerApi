<div class="footer-middle ">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">
                <div class="infos-footer module">
                    <h3 class="modtitle"><?php echo trans('menu.contact info'); ?></h3>
                    <ul class="menu">
                        <li class="adres">
                            <?php if(App::isLocale('kh')): ?>
                                 <?php echo $address?$address->location_kh:''; ?>

                            <?php else: ?>
                                 <?php echo $address?$address->location_en:''; ?>

                            <?php endif; ?>
                        </li>
                        <li class="phone">
                            (+855) <?php echo $address?$address->phone:''; ?>  <?php echo $address?$address->phone1:''; ?>

                        </li>
                        <li class="mail">
                            
                            <a href="mailto:<?php echo $address?$address->email:''; ?>" target="_top"><?php echo $address?$address->email:''; ?></a>
                        </li>
                       <!-- <li class="time">
                             <?php if(App::isLocale('kh')): ?>
                                 <?php echo $address?$address->open_kh:''; ?>

                            <?php else: ?>
                                 <?php echo $address?$address->open_en:''; ?>

                            <?php endif; ?>
                        </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                <div class="box-information box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle"><?php echo trans('menu.Information'); ?></h3>
                        <div class="modcontent">
                            <ul class="menu">
                                <li><a href="<?php echo e(route('home')); ?>"><?php echo trans('menu.home'); ?></a></li>
                                <li><a href="<?php echo e(route('aboutus')); ?>"><?php echo trans('menu.about'); ?></a></li>
                                <li><a href="<?php echo e(route('howtobuy')); ?>"><?php echo trans('menu.How To Buy'); ?></a></li>
                                <li><a href="<?php echo e(route('dilivery')); ?>"><?php echo trans('menu.Delivery Information'); ?></a></li>
                                <li><a href="<?php echo e(route('return')); ?>"><?php echo trans('menu.Returns Policy'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                <div class="box-account box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle"><?php echo trans('menu.Customer Service'); ?></h3>
                        <div class="modcontent">
                            <ul class="menu">
                                <li><a href="<?php echo e(route('contactus')); ?>"><?php echo trans('menu.contact'); ?></a></li>
                                <li><a href="<?php echo e(route('return')); ?>"><?php echo trans('menu.Returns'); ?></a></li>
                                <li><a href="<?php echo e(route('member-login')); ?>"><?php echo trans('menu.My account'); ?></a></li>
                                <li><a href="<?php echo e(route('order-history')); ?>"><?php echo trans('menu.Order History'); ?></a></li>
                                <li><a href="#"><?php echo trans('menu.Career'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                <div class="box-service box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle"><?php echo trans('menu.GET THE APP'); ?></h3>
                        <div class="modcontent">
                            <ul class="menu">
                               <!-- <li><img src="<?php echo asset('front/image/logo1.png'); ?>" title="Your Store" alt="Your Store" /></li>-->
                                <li class="appstore"><a href="https://itunes.apple.com/kh/app/onlineget/id1415569080?mt=8" target="_blank"><img class="divle" src="<?php echo asset('front/image/applestore.png'); ?>" alt="IOS"></a></li>
                                <li class="playstore"><a href="https://play.google.com/store/apps/details?id=phsatech.onlineget.starter" target="_blank"><img class="divle" src="<?php echo asset('front/image/googleplay.png'); ?>" alt="Android"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">
                <div class="module box-footer so-instagram-gallery-ltr">
                    <h4 class="modtitle"><?php echo trans('menu.OUR FACEBOOK PAGE'); ?></h4>
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
                          data-href="https://www.facebook.com/Onlinegets" 
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
