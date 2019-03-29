<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ECOMMERCE</title>
        <!-- Google-Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>
        <!-- Bootstrap core CSS -->
        {!! Html::style('backEnd/css/bootstrap.min.css') !!}
        {!! Html::style('backEnd/css/bootstrap-reset.css') !!}

        <!--Animation css-->
        {!! Html::style('backEnd/css/animate.css') !!}

        <!--Icon-fonts css-->
        {!! Html::style('backEnd/assets/font-awesome/css/font-awesome.css') !!}
        {!! Html::style('backEnd/assets/ionicon/css/ionicons.min.css') !!}

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/morris/morris.css">


        <!-- Custom styles for this template -->
        {!! Html::style('backEnd/css/style.css') !!}
        {!! Html::style('backEnd/css/helper.css') !!}
        {!! Html::style('backEnd/css/style-responsive.css') !!}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>


    <body>

        <div class="wrapper-page animated fadeInDown">
            @yield('content')
        </div>

    


        <!-- js placed at the end of the document so the pages load faster -->
        {!! Html::script('backEnd/js/jquery.js') !!}
        {!! Html::script('backEnd/js/bootstrap.min.js') !!}
        {!! Html::script('backEnd/js/pace.min.js') !!}
        {!! Html::script('backEnd/js/wow.min.js') !!}
        {!! Html::script('backEnd/js/jquery.nicescroll.js') !!}
            

        <!--common script for all pages-->
        {!! Html::script('backEnd/js/jquery.app.js') !!}
        {!! Html::script('plugin/jquery-validation/dist/jquery.validate.min.js') !!}
        @yield('scripts')
    
    </body>
</html>
