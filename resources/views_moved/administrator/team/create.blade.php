@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{!! $id?'Update Team':'Add Team' !!}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class=" form">
                        <form class="form-horizontal" id="frm-team" method="post" action="{{route('post-team',$id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row"> 
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#english" data-toggle="tab" aria-expanded="false">
                                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                <span class="hidden-xs">English</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#khmer" data-toggle="tab" aria-expanded="true">
                                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                                <span class="hidden-xs">Khmer</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="panel panel-default">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="english">
                                                 <div class="form-group">
                                                    <label class="control-label col-lg-2">Name</label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control"  name="name_en" type="text" value="{{$team?$team->name_en:''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2">Title</label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control"  name="title_en" type="text" value="{{$team?$team->title_en:''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-2">Description</label>
                                                    <div class="col-lg-10">
                                                        <textarea class="form-control ckeditor"  name="des_en">{{$team?$team->des_en:''}}</textarea>
                                                    </div>
                                                </div>   
                                            </div>
                                            <div class="tab-pane" id="khmer">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2">Name</label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control"  name="name_kh" type="text" value="{{$team?$team->name_kh:''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2">Title</label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control"  name="title_kh" type="text" value="{{$team?$team->title_kh:''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-2">Description</label>
                                                    <div class="col-lg-10">
                                                        <textarea class="form-control ckeditor"  name="des_kh">{{$team?$team->des_kh:''}}</textarea>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Status</label>
                                   <div class="col-lg-4">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>                
                            </div>
                             <div class="row">
                                <label for="cname" class="control-label col-lg-2">Pictur</label>
                                <div class="col-lg-offset-2 col-lg-10">
                                    <div class="picture" >
                                        <img id="blah" src="{!! $team?$team->image==''?asset('backEnd/img/no.jpg'):asset('uploads/teams/'.$team->image):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                                        <input type='file' id="wizard-picture" name="image" onchange="readURL(this);">
                                        <input type="hidden" name="tmp_file" value="{{$team?$team->image:''}}">
                                    </div>
                                    <label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
                                </div>
                            </div>
                            <div class="row margin-10 margin-left-10">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit" id="save">Save</button>
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
            $("#frm-team").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    name: "required",
                    title: "required"
                },
                // Specify validation error messages
                messages: {
                     name: "please input name",
                     title: "please input name"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop