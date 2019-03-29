@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{$id?'Update Help':'Add New Help'}}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class=" form">
                        <form class="form-horizontal" id="frm-help" method="post" action="{{route('post-help',$id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">Title</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" name="title" type="text" value="{!!$help?$help->title:''!!}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="ccomment" class="control-label col-lg-2">Description</label>
                                    <div class="col-lg-10">
                                     <textarea class="form-control ckeditor" 
                                       name="des">
                                     {{$help?$help->des:''}}
                                     </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cname" class="control-label col-lg-2">Image feathure</label>
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="picture" >
                                            <img id="blah" src="{!! $help?$help->image==''?asset('backEnd/img/no.jpg'):asset('uploads/pages/'.$help->image):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                                            <input type='file' id="wizard-picture" name="image" onchange="readURL(this);">
                                            <input type="hidden" name="tmp_file" value="{!!$help?$help->image:''!!}">
                                        </div>
                                        <label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2 margin-left-25">Status</label>
                                    <div class="col-lg-4">
                                        <select name="status" class="form-control">
                                            <option value="1" {!!$help?$help->status=='1'?'selected':'':''!!}>Active</option>
                                            <option value="0" {!!$help?$help->status=='0'?'selected':'':''!!}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row margin-top-10 margin-left-10">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-success" type="submit" id="save">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>         
                        </form>
                    </div> <!-- .form -->
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
            $("#frm-help").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    title: "required",
                    des: "required"
                },
                // Specify validation error messages
                messages: {
                    title: "Please enter page title",
                    des: "Please enter description"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop