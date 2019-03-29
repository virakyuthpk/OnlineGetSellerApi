@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{!! $id?'Update Partner':'Add New Partner' !!}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <form class="form-horizontal" id="frm-partner" method="post" action="{{route('post-partner',$id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                         <div class="form-group">
                              <label class="col-lg-2 control-label">Status</label>
                              <div class="col-lg-4">
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Title</label>
                                <div class="col-lg-10">
                                    <input class=" form-control"  name="name" type="text" value="{{$partner?$partner->name:''}}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2">Url</label>
                                <div class="col-lg-10">
                                    <input class=" form-control"  name="url" type="url" value="{{$partner?$partner->url:''}}">
                                </div>
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="picture" >
                                    <img id="blah" src="{!! $partner?$partner->image==''?asset('backEnd/img/no.jpg'):asset('uploads/partner/'.$partner->image):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                                    <input type='file' id="wizard-picture" name="image" onchange="readURL(this);">
                                    <input type="hidden" name="tmp_file" value="{{$partner?$partner->image:''}}">
                                </div>
                                <label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
                            </div>
                        </div>
                        <div class="row margin-top-10 margin-left-10">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-success" type="submit" id="save">Save</button>
                            </div>
                        </div>
                     <!-- .form -->
                    </form>
                    </div>
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
            $("#frm-partner").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    name: "required",
                    logo: {
                        extension: "jpg,jpeg,png,gif",
                    }
                },
                // Specify validation error messages
                messages: {
                    name: "Please enter title",
                    logo: {
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