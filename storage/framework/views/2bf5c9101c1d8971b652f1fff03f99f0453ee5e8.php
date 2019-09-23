

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Onlineget</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="keywords" content="html5 template, best html5 template, best html template, html5 basic template, multipurpose html5 template, multipurpose html template, creative html templates, creative html5 templates" />
        <meta name="description" content="Online shop in cambodia" />
        <meta name="author" content="Phsar tech">
        <meta name="robots" content="index, follow" />
        <meta property="og:image" content="<?php echo asset('front/image/logo.jpg'); ?>" />
        <meta name="google-site-verification" content="cMboETNaErswhSTXbcm2bRl6VljYKh1Z3aNB4JaztEA" />
        <!-- Mobile specific metas
        ============================================ -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Favicon
        ============================================ -->
        <link rel="shortcut icon" type="image/png" href="<?php echo asset('front/image/favicon.png'); ?>"/>
        <link href="https://fonts.googleapis.com/css?family=Battambang" rel="stylesheet">
        <!-- Libs CSS
        ============================================ -->
        <?php echo Html::style('front/css/bootstrap/css/bootstrap.min.css'); ?>

        <?php echo Html::style('front/css/font-awesome/css/font-awesome.min.css'); ?>

        <?php echo Html::style('front/js/datetimepicker/bootstrap-datetimepicker.min.css'); ?>

        <?php echo Html::style('front/js/owl-carousel/owl.carousel.css'); ?>

        <?php echo Html::style('front/css/themecss/lib.css'); ?>

        <?php echo Html::style('front/js/jquery-ui/jquery-ui.min.css'); ?>

        <?php echo Html::style('front/js/minicolors/miniColors.css'); ?>

        <?php echo Html::style('front/css/custom.css'); ?>

         <?php if(App::isLocale('kh')): ?>
             <?php echo Html::style('front/css/customkh.css'); ?>

        <?php endif; ?>
        <!-- Theme CSS
        ============================================ -->
        <?php echo Html::style('front/css/themecss/so_searchpro.css'); ?>

        <?php echo Html::style('front/css/themecss/so_megamenu.css'); ?>

        <?php echo Html::style('front/css/themecss/so-categories.css'); ?>

        <?php echo Html::style('front/css/themecss/so-listing-tabs.css'); ?>

        <!--<?php echo Html::style('front/css/themecss/so-newletter-popup.css'); ?>

        -->
        <?php echo Html::style('front/css/footer/footer1.css'); ?>

        <?php echo Html::style('front/css/header/header1.css'); ?>

        <?php echo Html::style('front/css/theme.css'); ?>

        <?php echo Html::style('front/css/responsive.css'); ?>

         <?php echo Html::style('backEnd/assets/select2/select2.css'); ?>

           <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
         <!-- Google web fonts
        ============================================ -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700' rel='stylesheet' type='text/css'>
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118334182-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118334182-2');
</script>

    </head>
    <body class="common-home res layout-1">
        <div id="wrapper" class="wrapper-fluid banners-effect-5">
            <header id="header" class=" typeheader-1">
                <?php echo $__env->make('front.layout.top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('front.layout.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </header>
            <!-- Main Container  -->
            <div class="main-container container">
                <div id="content">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 main-left sidebar-offcanvas">
                            <?php echo $__env->make('front.layout.left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 main-right">
                            <?php echo $__env->yieldContent('slide'); ?>  
                            <?php echo $__env->yieldContent('content'); ?>
                           
                        </div>
                    </div>
                </div>
                <!-- //end Footer Container -->
            </div>
            <!-- <div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <?php echo $__env->yieldContent('partner'); ?>  
                
            </div> -->
            <footer class="footer-container typefooter-1">
                <?php echo $__env->yieldContent('subscribe'); ?> 
                <!-- /Footer Top Container -->
                <?php echo $__env->make('front.layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                <!-- Footer Bottom Container -->
                <?php echo $__env->make('front.layout.copyright', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
            </footer>
        </div>
        <?php echo Html::script('backEnd/assets/select2/select2.min.js'); ?>

        <?php echo Html::script('backEnd/js/jquery.js'); ?>

        <?php echo Html::script('plugin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>

        <?php echo Html::script('plugin/jquery-validation/dist/jquery.validate.min.js'); ?>

        <?php echo Html::script('plugin/jquery-validation/dist/additional-methods.min.js'); ?>

        <?php echo Html::script('backEnd/assets/form-wizard/bootstrap-validator.min.js'); ?>

        <?php echo Html::script('backEnd/assets/form-wizard/wizard-init.js'); ?>

        <?php echo Html::script('front/js/bootstrap.min.js'); ?>

        <?php echo Html::script('front/js/owl-carousel/owl.carousel.js'); ?>

        <?php echo Html::script('front/js/themejs/libs.js'); ?>

        <?php echo Html::script('front/js/unveil/jquery.unveil.js'); ?>

        <?php echo Html::script('front/js/countdown/jquery.countdown.min.js'); ?>

        <?php echo Html::script('front/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js'); ?>

        <?php echo Html::script('front/js/datetimepicker/moment.js'); ?>

        <?php echo Html::script('front/js/datetimepicker/bootstrap-datetimepicker.min.js'); ?>

        <?php echo Html::script('front/js/jquery-ui/jquery-ui.min.js'); ?>

        <?php echo Html::script('front/js/modernizr/modernizr-2.6.2.min.js'); ?>

        <?php echo Html::script('front/js/minicolors/jquery.miniColors.min.js'); ?>

        <?php echo Html::script('plugin/sweetalert/dist/sweetalert.min.js'); ?>

        <?php echo Html::script('front/js/themejs/application.js'); ?>

        <?php echo Html::script('front/js/themejs/homepage.js'); ?>

        <?php echo Html::script('front/js/themejs/toppanel.js'); ?>

        <?php echo Html::script('front/js/themejs/so_megamenu.js'); ?>

        <?php echo Html::script('front/js/themejs/addtocart.js'); ?>

        <?php echo Html::script('front/js/themejs/cpanel.js'); ?>

        <?php echo Html::script('js/image.js'); ?>

           <?php echo $__env->yieldContent('scripts'); ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e){
                var countvalue = $('#counter').val();
                $("body").on("click",".addToCart",function(){
                    var id = $(this).data('id');  
                    var name = $(this).data("name");  
                    var price = $(this).data("price");  
                    var qty = $(this).data("qty"); 
                    var img = $(this).data("img"); 
                    var path = "<?php echo e(asset('uploads/product/feature/')); ?>";
                    $.ajax({
                        type: "POST",
                        url : "addtocart",
                        data:{
                        'id':id,
                        'name':name,
                        'price':price,
                        'qty':qty,
                        'img':img,
                        },
                        success : function(data){
                            countvalue++;
                            $('#number_c').text(countvalue);
                          var markup = "<tr><td>" + "<img src='"+path+'/'+img+"'>" + "</td><td>" + name + "</td><td>" + qty + "</td><td>" + '$' +price + "</td><td class='text-right'><a class='fa fa-edit'></td><td class='text-right'><a class='fa fa-times fa-delete'></td></td>";
                            $("#myTable").prepend(markup);

                            //console.log(data);
                            addProductNotice('Product added to Cart', '<h3>'+name+ 'added to <a href="#">shopping cart</a>!</h3>', 'success');
                        }
                    },"json");
                });  
                $( ".subscribeEmail" ).click(function() { 
                   var email = $("#txtemail").val();
                    $.ajax({
                        type: "POST",
                        url : "subscriber",
                        data:{
                        'email':email,
                        },
                        success : function(data){
                            if (data == 'success') {
                                addProductNotice('Thanks for subscribe with us', '', 'success');
                             }else{
                                addProductNotice('You are aleady subscribe', '', 'warning');
                             }
                        }
                    },"json");
                });
                /*remove cart*/
                $( ".removeCart" ).click(function() { 
                    var id = $(this).data('id'); 
                    $.ajax({
                        type: "POST",
                        url : "removecart",
                        data:{
                        'id':id,
                        },
                        success : function(data){
                           addProductNotice('You have remove one iteam from your cart', '', 'success');
                        }
                    },"json");
                });
            });
         // change image data
    $('.img-thumbs .pic').on('click', function(e) {
        e.preventDefault();
        /* Act on the event */
        $('.img-thumbs .item').removeClass('active');
        $(this).parents('.item').addClass('active');
        var dataLarge = $(this).attr('data-lg-img');
        $('.large-view').attr({
            'src': dataLarge
        });
       $('.fancy-view').attr({
            'href': dataLarge
        });
    });
    $(".fancy-view").fancybox();
        </script>
    </body>
</html>