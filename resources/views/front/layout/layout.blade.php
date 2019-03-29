

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Onlineget</title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content="html5 template, best html5 template, best html template, html5 basic template, multipurpose html5 template, multipurpose html template, creative html templates, creative html5 templates" />
        <meta name="description" content="Online shop in cambodia" />
        <meta name="author" content="Phsar tech">
        <meta name="robots" content="index, follow" />
        <meta property="og:image" content="{!!asset('front/image/logo.jpg') !!}" />
        <meta name="google-site-verification" content="cMboETNaErswhSTXbcm2bRl6VljYKh1Z3aNB4JaztEA" />
        <!-- Mobile specific metas
        ============================================ -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Favicon
        ============================================ -->
        <link rel="shortcut icon" type="image/png" href="{!!asset('front/image/favicon.png') !!}"/>
        <link href="https://fonts.googleapis.com/css?family=Battambang" rel="stylesheet">
        <!-- Libs CSS
        ============================================ -->
        {!! Html::style('front/css/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('front/css/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('front/js/datetimepicker/bootstrap-datetimepicker.min.css') !!}
        {!! Html::style('front/js/owl-carousel/owl.carousel.css') !!}
        {!! Html::style('front/css/themecss/lib.css') !!}
        {!! Html::style('front/js/jquery-ui/jquery-ui.min.css') !!}
        {!! Html::style('front/js/minicolors/miniColors.css') !!}
        {!! Html::style('front/css/custom.css') !!}
         @if(App::isLocale('kh'))
             {!! Html::style('front/css/customkh.css') !!}
        @endif
        <!-- Theme CSS
        ============================================ -->
        {!! Html::style('front/css/themecss/so_searchpro.css') !!}
        {!! Html::style('front/css/themecss/so_megamenu.css') !!}
        {!! Html::style('front/css/themecss/so-categories.css') !!}
        {!! Html::style('front/css/themecss/so-listing-tabs.css') !!}
        <!--{!! Html::style('front/css/themecss/so-newletter-popup.css') !!}
        -->
        {!! Html::style('front/css/footer/footer1.css') !!}
        {!! Html::style('front/css/header/header1.css') !!}
        {!! Html::style('front/css/theme.css') !!}
        {!! Html::style('front/css/responsive.css') !!}
         {!! Html::style('backEnd/assets/select2/select2.css') !!}
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
                @include('front.layout.top')
                @include('front.layout.menu')
            </header>
            <!-- Main Container  -->
            <div class="main-container container">
                <div id="content">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 main-left sidebar-offcanvas">
                            @include('front.layout.left')
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 main-right">
                            @yield('slide')  
                            @yield('content')
                           
                        </div>
                    </div>
                </div>
                <!-- //end Footer Container -->
            </div>
            <!-- <div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 @yield('partner')  
                
            </div> -->
            <footer class="footer-container typefooter-1">
                @yield('subscribe') 
                <!-- /Footer Top Container -->
                @include('front.layout.footer') 
                <!-- Footer Bottom Container -->
                @include('front.layout.copyright') 
            </footer>
        </div>
        {!! Html::script('backEnd/assets/select2/select2.min.js') !!}
        {!! Html::script('backEnd/js/jquery.js') !!}
        {!! Html::script('plugin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
        {!! Html::script('plugin/jquery-validation/dist/jquery.validate.min.js') !!}
        {!! Html::script('plugin/jquery-validation/dist/additional-methods.min.js') !!}
        {!! Html::script('backEnd/assets/form-wizard/bootstrap-validator.min.js') !!}
        {!! Html::script('backEnd/assets/form-wizard/wizard-init.js') !!}
        {!! Html::script('front/js/bootstrap.min.js') !!}
        {!! Html::script('front/js/owl-carousel/owl.carousel.js') !!}
        {!! Html::script('front/js/themejs/libs.js') !!}
        {!! Html::script('front/js/unveil/jquery.unveil.js') !!}
        {!! Html::script('front/js/countdown/jquery.countdown.min.js') !!}
        {!! Html::script('front/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js') !!}
        {!! Html::script('front/js/datetimepicker/moment.js') !!}
        {!! Html::script('front/js/datetimepicker/bootstrap-datetimepicker.min.js') !!}
        {!! Html::script('front/js/jquery-ui/jquery-ui.min.js') !!}
        {!! Html::script('front/js/modernizr/modernizr-2.6.2.min.js') !!}
        {!! Html::script('front/js/minicolors/jquery.miniColors.min.js') !!}
        {!! Html::script('plugin/sweetalert/dist/sweetalert.min.js') !!}
        {!! Html::script('front/js/themejs/application.js') !!}
        {!! Html::script('front/js/themejs/homepage.js') !!}
        {!! Html::script('front/js/themejs/toppanel.js') !!}
        {!! Html::script('front/js/themejs/so_megamenu.js') !!}
        {!! Html::script('front/js/themejs/addtocart.js') !!}
        {!! Html::script('front/js/themejs/cpanel.js') !!}
        {!! Html::script('js/image.js') !!}
           @yield('scripts')
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
                    var path = "{{asset('uploads/product/feature/')}}";
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