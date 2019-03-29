<!DOCTYPE html>
<html lang="en">
   <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" type="image/png" href="{!!asset('front/image/favicon-32x32.png') !!}"/>
        <title>Onlineget</title>
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
           {!! Html::style('backEnd/assets/form-wizard/jquery.steps.css') !!}
            <!-- Custom styles for this template -->
           {!! Html::style('backEnd/css/style.css') !!}
           {!! Html::style('backEnd/css/helper.css') !!}
           {!! Html::style('backEnd/css/style-responsive.css') !!}
           {!! Html::style('plugin/sweetalert/dist/sweetalert.css') !!}
           {!! Html::style('plugin/datatables/media/css/dataTables.bootstrap.min.css') !!}
           {!! Html::style('plugin/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}
           {!! Html::style('backEnd/css/custom.css') !!}
           {!! Html::style('backEnd/assets/select2/select2.css') !!}
           <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
   <body>
        <!-- left-penal -->
        <aside class="left-panel">
            @include('administrator.layouts.left_slidebar')
        </aside>
        <!-- end -->
        <!--Main Content Start -->
        <section class="content">
            <!-- Header -->
            @include('administrator.layouts.header_menu')
            <!-- Header Ends -->

            <div class="wraper container-fluid">
                @yield('content')
            </div>
            <!-- Footer -->
            <footer class="footer">
                @include('administrator.layouts.footer')
            </footer>
        </section>

       <!-- js placed at the end of the document so the pages load faster -->
      {!! Html::script('backEnd/assets/select2/select2.min.js') !!}
      {!! Html::script('backEnd/js/jquery.js') !!}
      {!! Html::script('backEnd/js/bootstrap.min.js') !!}
      {!! Html::script('backEnd/js/wow.min.js') !!}
      {!! Html::script('backEnd/js/jquery.scrollTo.min.js') !!}
      {!! Html::script('backEnd/js/jquery.nicescroll.js') !!}
      {!! Html::script('backEnd/js/jquery.app.js') !!}
      {!! Html::script('plugin/jquery-validation/dist/jquery.validate.min.js') !!}
      {!! Html::script('plugin/jquery-validation/dist/additional-methods.min.js') !!}
      {!! Html::script('plugin/sweetalert/dist/sweetalert.min.js') !!}
      {!! Html::script('plugin/datatables/media/js/jquery.dataTables.min.js') !!}
      {!! Html::script('plugin/datatables/media/js/dataTables.bootstrap.min.js') !!}
      {!! Html::script('backEnd/assets/form-wizard/bootstrap-validator.min.js') !!}
      {!! Html::script('backEnd/assets/form-wizard/jquery.steps.min.js') !!}
      {!! Html::script('backEnd/assets/form-wizard/wizard-init.js') !!}
        <!-- {!! Html::script('plugin/chart.js/dist/Chart.min.js') !!} -->
      {!! Html::script('plugin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
      {!! Html::script('js/numberic.js') !!}
      {!! Html::script('js/custom.js') !!}
      <script type="text/javascript" src="http://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
      {!! Html::script('js/editor.js') !!}
      {!! Html::script('js/image.js') !!}
      @yield('scripts')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      <script type="text/javascript">
         $('.number').ForceNumeric(); 
      </script>
    </body>
</html>
