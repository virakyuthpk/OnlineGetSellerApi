@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{!! $id?'Update Slide':'Add New Slide' !!} </h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <form class="form-horizontal" id="frm-payment" method="post" action="{{route('post-payment',$id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class=" form">
                            <div class="row">
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">Name English</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control"  name="name_en" type="text" value="{!!$payment?$payment->name_en:''!!}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="ccomment" class="control-label col-lg-2">Name Khmer</label>
                                    <div class="col-lg-10">
                                       <input class=" form-control"  name="name_kh" type="text" value="{!!$payment?$payment->name_kh:''!!}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-offset-2 col-lg-2">
                                    <div class="picture" >
                                        <img id="blah" src="{!! $payment?$payment->image==''?asset('backEnd/img/no.jpg'):asset('uploads/payment/'.$payment->image):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                                        <input type='file' id="wizard-picture" name="image" onchange="readURL(this);">
                                        <input type="hidden" name="tmp_file" value="{!!$payment?$payment->image:''!!}">
                                    </div>
                                   <!--  1349 × 550 pixels -->
                                    <label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
                                </div>
                            </div>
                            <div class="row margin-top-10 margin-left-10">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit" id="save">Save</button>
                                </div>
                            </div>
                        </div> <!-- .form -->
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div> <!-- End row -->
@stop
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#wizard-picture").change(function(){
                readURL(this,'blah');
            });
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0}');
            $("#frm-payment").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    name_en: "required",
                    image: {
                        extension: "jpg,jpeg,png,gif",
                    }
                },
                // Specify validation error messages
                messages: {
                    name_en: "Please enter payment name",
                    image: {
                        extension: "File must be types: JPG/GIF/PNG/PDF",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
  </script>
@stop