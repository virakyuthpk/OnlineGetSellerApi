@extends('administrator.layouts.layouts')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{$id?'Update Category':'Add New Category'}}</h3></div>
            <div class="panel-body">
                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{Session::get('message')}}</strong>
                </div>
                @endif
                <div class=" form">
                    <form class="form-horizontal" id="frm-page" method="post" action="{{route('post-category',$id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">Name Khmer</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" name="title_kh" type="text" value="{!!$cate?$cate->title_kh:''!!}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">Name English</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" name="title_en" type="text" value="{!!$cate?$cate->title_en:''!!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cname" class="control-label col-md-2">Parent category<span>*</span></label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="parent">

                                        <option value="0">No Main</option>
                                        @foreach($parent as $pa)
                                            <option value="{!!$pa->id!!}" {!!$cate?$pa->id==$cate->parent_id?'selected':'':''!!}>{!!$pa->title_en!!}</option>
                                             @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cname" class="control-label col-md-2">Sub category<span>*</span></label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="subcat">
                                            <option value="0">No Parent</option>
                                            @foreach($pa->subcate as $sub)
                                                <option value="{!!$sub->id!!}" {!!$cate?$sub->id==$cate->sub_id?'selected':'':''!!}>
                                                    {!!$sub->title_en!!}
                                                </option>
                                            @endforeach
                                        </select>
                                        
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
                                <div class="form-group">
                                    <label for="cname" class="control-label col-lg-2">Icon</label>
                                    <div class="col-lg-2">
                                        <div class="picture" >
                                            <img id="blah" src="{!!$cate?$cate->icon==''?asset('backEnd/img/no.jpg'):asset('uploads/icon/'.$cate->icon):asset('backEnd/img/no.jpg') !!}" />
                                            <input type='file' id="wizard-picture" name="image" onchange="readURL(this);">
                                            <input type="hidden" name="tmp_file" value="{!!$cate?$cate->icon:''!!}">
                                        </div>
                                        <label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
                                    </div>
                                </div>
                                <div class="row margin-top-10 margin-left-10">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-success" type="submit" id="save">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- .form -->
        </div> <!-- panel-body -->
    </div> <!-- panel -->
</div> <!-- col -->
@stop
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#wizard-picture").change(function(){
                readURL(this,'blah');
            });
            $("#frm-page").submit(function(e) {
                e.preventDefault();
                }).validate({
                    rules: {
                    title_th: "required",
                    des: "required"
                    },
                    // Specify validation error messages
                    messages: {
                    title_th: "Please enter page title",
                    des: "Please enter description"
                    },
                    submitHandler: function(form) {
                    form.submit();
                    }
            });
        });
        $('select[name="parent"]').on('change', function() {
                var cateid = $(this).val();
                if(cateid) {
                    $.ajax({
                        url: '/admin/sub-category/'+cateid,
                        type: "get",
                        dataType: "json",
                        success:function(data) {
                            console.log(data);
                            $('select[name="subcat"]').empty();
                            if(data.length > 0){
                               $.each(data, function(key, value) {
                                $('select[name="subcat"]').append('<option value="0">No Parent</option><option value="'+ value.id +'">'+ value.title_en +'</option>');
                                }); 
                            }else{
                                 $('select[name="subcat"]').append('<option value="0">No Parent</option>');
                            }
                            
                        }
                    });
                }else{
                    $('select[name="subcat"]').empty();
                }
            });
    </script>
@stop