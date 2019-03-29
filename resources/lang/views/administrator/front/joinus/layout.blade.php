
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Onlineget</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="html5 template, best html5 template, best html template, html5 basic template, multipurpose html5 template, multipurpose html template, creative html templates, creative html5 templates" />
    <meta name="description" content="eMarket is a powerful Multi-purpose HTML5 Template with clean and user friendly design. It is definite a great starter for any eCommerce web project." />
    <meta name="author" content="Phsar tech">
    <meta name="robots" content="index, follow" />
    <meta name="google-site-verification" content="cMboETNaErswhSTXbcm2bRl6VljYKh1Z3aNB4JaztEA" />
    <!-- Mobile specific metas
    ============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon
    ============================================ -->
     <link rel="shortcut icon" type="image/png" href="{!!asset('front/image/favicon-32x32.png') !!}"/>
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
    {!! Html::style('front/css/themecss/so-newletter-popup.css') !!}
    
    {!! Html::style('front/css/footer/footer1.css') !!}
    {!! Html::style('front/css/header/header1.css') !!}
    {!! Html::style('front/css/theme.css') !!}
    {!! Html::style('front/css/responsive.css') !!}
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
<body class="res layout-1 layout-subpage">
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
    <!-- Header Container  -->
    <header id="header" class=" typeheader-1">
       @include('front.layout.top')
       @include('front.layout.menu')
        <!--  -->
    </header>
    <!-- //Header Container  -->
    <div class="main-container container">
        <ul class="breadcrumb">
             @if(Auth()->user() != null)
                @if(Auth()->user()->role == 'member')
                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Account</a></li>
                @if(Auth()->check())
                    <li class="curent"><a href="#">My account</a></li>
                @else
                    <li><a href="#">Login/Register</a></li>
                @endif
                <li><a href="{{route('order-history')}}">Order History</a></li>
                <li><a href="#">Newsletter</a></li>
                <li><a href="{{route('member-logout')}}">Logout</a></li>
                <li><a href="">Order</a></li>
                @else
                 <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Page</a></li>
                <li>
                    <a href="#">
                        @if($page_title != null)
                            @if(App::isLocale('kh'))
                               {!!$page_title?$page_title->title_kh:''!!}
                            @else
                               {!!$page_title?$page_title->title_en:''!!}
                            @endif
                        @endif
                    </a>
                </li>
                @endif
            @else
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Page</a></li>
                <li>
                    <a href="#">
                        @if($page_title != null)
                            @if(App::isLocale('kh'))
                               {!!$page_title?$page_title->title_kh:''!!}
                            @else
                               {!!$page_title?$page_title->title_en:''!!}
                            @endif
                        @endif
                    </a>
                </li>
            @endif
        </ul>
        <div class="row">
            <div id="content" class="col-sm-12">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Footer Container -->
    <footer class="footer-container typefooter-1">
        @include('front.layout.subscribe') 
        <!-- /Footer Top Container -->
        @include('front.layout.footer') 
        <!-- Footer Bottom Container -->
        @include('front.layout.copyright') 
    </footer>
    </div>
        {!! Html::script('front/js/jquery-2.2.4.min.js') !!}
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

        {!! Html::script('front/js/themejs/application.js') !!}
        {!! Html::script('front/js/themejs/homepage.js') !!}
        {!! Html::script('front/js/themejs/toppanel.js') !!}
        {!! Html::script('front/js/themejs/so_megamenu.js') !!}
        {!! Html::script('front/js/themejs/addtocart.js') !!}
        {!! Html::script('front/js/themejs/cpanel.js') !!}
      
 <script src='https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
 {!! Html::script('js/numberic.js') !!}
<script type="text/javascript">

$(document).ready(function(){

            $(".checkout").on("keyup", ".quantity", function(){
        var price = +$(".price").data("price");
        var quantity = +$(this).val();
        var dis = +$(".discount").data("discount");
        var sub = price * quantity * dis / 100;
        var amount = price * quantity - sub;
        var totaler = price * quantity;
        $("#total").text("$" + price * quantity);
        $("#sub_total").text("$" + price * quantity);
        $("#amout").text("$" + amount);
         $("#totaler").val(totaler);
        $("#tol").val(amount);
        $("#dis_count").val(sub);

        // $("#tol").val(this.value ? this.value : "Video title");
         
    });
    $('.number').ForceNumeric();
    $('select[name="provice"]').on('change', function() {
        var proid = $(this).val();
        if(proid) {
            $.ajax({
                url: '/province-distric/'+proid,
                type: "get",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    $('select[name="destric"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="destric"]').append('<option value="'+ value.id +'">'+ value.name_en +'</option>');
                    });
                }
            });
        }else{
            $('select[name="destric"]').empty();
        }
    });

    $(function() {
  $("form[name='order']").validate({
   
    rules: {
       provice:  "required" ,
       destric:  "required" ,
       phone: "required",
       address:'required',
       option: "required",
    },
    messages: {
        destric: "Please select your district",
        provice: "Please select your provice",
        option: "Please select your option",
        phone: "Please enter your phone number",
        address: "Please enter your address",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
  });
   function show() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("eye").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);
     var password = document.getElementById("pwd")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
    </script>
    </body>
</html>