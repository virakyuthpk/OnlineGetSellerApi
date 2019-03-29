@extends('front.layout.layout')
@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="breadcrumb clearfix">
            <a class="home" href="{{route('home')}}" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Product list</span>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="col-md-2 col-sm-4 col-xs-4 left_lay">
                    @include('front.layout.left-vendor')
                </div>
                <div class="col-md-10">
                <form class="form-horizontal" id="frm-prouduct" method="post" action="{{route('post-product-vendor',$id)}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <input name="id" type="hidden" value="{!!$product?$product->id : ''!!}">
    <input type="hidden" name="p_id[]"  value="{!!$product?$product->id: ''!!}">
    <div class="col-md-12">
        <div class="panel">
            Product ID : <input type="text" name="pcode" class="form-control" value="{!!$product?$product->pcode: ''!!}" required="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel-default">
            <div class="panel-heading"><h3 class="panel-title">English</h3></div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" name="product_name" value="{!!$product?$product->name_en : ''!!}" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Detail</label>
                    <textarea class="form-control" name="detail_en">{!!$product?$product->detail_en: ''!!}</textarea>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control ckeditor" name="des_en">{!!$product?$product->des_en: ''!!}</textarea>
                </div>
            </div><!-- panel-body -->
        </div> <!-- panel -->
    </div>
    <div class="col-md-6">
        <div class="panel-default">
            <div class="panel-heading"><h3 class="panel-title">Khmer</h3></div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name </label>
                        <input type="text" name="product_kh" value="{!!$product?$product->name_kh : ''!!}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Detail</label>
                    <textarea class="form-control" name="detail_kh">{!!$product?$product->detail_kh: ''!!}</textarea>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control ckeditor" name="des_kh">{!!$product?$product->des_kh: ''!!}</textarea>
                </div>
            </div><!-- panel-body -->
        </div> <!-- panel -->
    </div>
    <div class="col-md-4">
        <div class="panel-default">
            <div class="panel-heading"><h3 class="panel-title">Item Information </h3></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category">
                        @if(!$category->isEmpty())
                            <option value="">Select category</option>
                            @foreach($category as $cate)
                                <option value="{!!$cate->id!!}" {!!$product?$cate->id==$product->parent_category ?'selected':'':''!!}>{!!$cate->title_en!!}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Sub Category</label>
                    <select class="form-control" name="subcat">
                        @if($id != null)
                            @foreach($subcate as $sub)
                                <option value="{!!$sub->id!!}" {!!$sub?$sub->id==$product->category_id?'selected':'':''!!}>
                                {!!$sub->title_en!!}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Unit</label>
                    <select class="form-control" name="unit">
                        @if(!$unit->isEmpty())
                            @foreach($unit as $un)
                                <option value="{!!$un->id!!}" {!!$product?$un->id==$product->unit_id?'selected':'':''!!}>{!!$un->name_en!!}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Variant</label>
                    <select class="form-control" id="varian" name="variant[]" multiple="multiple" required="">
                        @if(!$variant->isEmpty())
                            @foreach($variant as $var)
                                <option value="{!!$var->id!!}" 
                                    @foreach($product_varaint as $p_varian)
                                        {!!$var?$var->id==$p_varian->varaint_id?'selected':'':''!!}
                                    @endforeach
                                >{!!$var->name_en!!}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control" name="brand">
                        @if(!$brand->isEmpty())
                            @foreach($brand as $br)
                                <option value="{!!$br->id!!}" {!!$product?$br->id==$product->braind_id?'selected':'':''!!}>{!!$br->name_en!!}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label >Model</label>
                    <input type="text" name="model" value="{!!$product?$product->model: ''!!}" class="form-control number">
                </div>
            </div><!-- panel-body -->
        </div> <!-- panel -->
    </div>
    <div class="col-md-4">
        <div class="panel-default">
            <div class="panel-heading"><h3 class="panel-title">Price</h3></div>
            <div class="panel-body"> 
                <div class="form-group">
                    <label>Supplier</label>
                    <select class="form-control" name="supplier" required="">
                        @if(!$supplier->isEmpty())
                            @foreach($supplier as $sup)
                                <option value="{!!$sup->id!!}" {!!$product?$sup->id==$product->supplier_id?'selected':'':''!!}>{!!$sup->name_en!!}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label >Discount</label>
                    <select class="form-control" name="discount">
                        <option value="0">Select Discount</option>
                        @if(!$discount->isEmpty())
                            @foreach($discount as $dis)
                                <option value="{!!$dis->id!!}" {!!$dis?$dis->id==$procut_dis?'selected':'':''!!}>{!!$dis->percentage!!} %</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Seling Price</label>
                    <input class=" form-control number" name="sell_price" type="text" value="{!!$product?$product->sell_price: ''!!}">
                </div>
                <div class="form-group">
                    <label >Special</label>
                    <select class="form-control" name="special">
                        <option value="no" {!!$product?$product->special=='no'?'selected':'':''!!}>Normal</option>
                        <option value="yes" {!!$product?$product->special=='yes'?'selected':'':''!!}>Left Slide</option>
                    </select>
                </div>
                <div class="form-group">
                    <label >Max Order</label>
                    <input type="text" name="max_order" value="{!!$product?$product->max_order: '0'!!}" class="form-control number" placeholder="0">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel-default">
            <div class="panel-heading"><h3 class="panel-title">Image feature</h3></div>
            <div class="panel-body">
                <div class="picture" >
                    <img id="blah" src="{!! $product?$product->image==''?asset('backEnd/img/no.jpg'):asset('uploads/product/feature/'.$product->image):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                    <input type='file' id="wizard-picture" name="image" onchange="readURL(this);">
                    <input type="hidden" name="tmp_file" value="{!!$product?$product->image:''!!}">
                </div>
                <label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel-default">
            <button class="btn btn-success" type="submit" value="submit">Submit</button>
        </div>
    </div>
</form>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Gallery</h3></div>
        <div class="panel-body">
            @include('front.vendor.product.tab.gallery')
        </div>
    </div>
</div>
                </div>
            </div> 
             </div>    
    </div>            
</div>

@stop
@section('scripts')
    <script type="text/javascript">
       $(document).ready(function(){
            $('.js-example-basic-multiple').select2(); 
            $('#varian').select2(); 
            $("#wizard-picture").change(function(){
                readURL(this,'blah');
            });
             $(".date").datepicker({
                format: 'yyyy-mm-dd'
            });
            $('select[name="category"]').on('change', function() {
                var cateid = $(this).val();
                if(cateid) {
                    $.ajax({
                        url: '/saller/vendor-sub-category/'+cateid,
                        type: "get",
                        dataType: "json",
                        success:function(data) {
                            console.log(data);
                            $('select[name="subcat"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcat"]').append('<option value="'+ value.id +'">'+ value.title_en +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="subcat"]').empty();
                }
            });
           /* $('select[name="pro_id"]').on('change', function() {
                var proid = $(this).val();
                if(proid) {
                    $.ajax({
                        url: '/admin/province-distric/'+proid,
                        type: "get",
                        dataType: "json",
                        success:function(data) {
                            console.log(data);
                            $('select[name="destric"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="destric"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="subcat"]').empty();
                }
            });*/
            // store the currently selected tab in the hash value
            $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
                var id = $(e.target).attr("href").substr(1);
                window.location.hash = id;
            });
            // on load of the page: switch to the currently selected tab
            var hash = window.location.hash;
            $('#campaign-tab a[href="' + hash + '"]').tab('show');
            
            $("#wizard-picture").change(function(){
                readURL(this,'blah');
            });
            $("#frm-prouduct").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    product_name: "required",
                    variant:'required',
                    pcode:'required',
                    supplier:'required',
                    image: {
                        extension: "jpg,jpeg,png,gif",
                    },
                },
                // Specify validation error messages
                messages: {
                    product_name: "Please enter title",
                    variant:'Please Select product variant',
                    pcode:'Please Select Product Code',
                    supplier:'Please Select Product Supplier',
                    image: {
                    extension: "File must be types: JPG/GIF/PNG/PDF",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        $(".drag-img").click(function(){
            $("#file-image").trigger('click');
        });
        function filePreview(input,changeImage) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#'+changeImage).attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("body").on("click",".remove-pic",function(){
            $(this).parents('#table-image tr td').remove();
        });
        $(".drag-img").on('dragenter', function (e){
            e.preventDefault();
        });
        $(".drag-img").on('dragover', function (e){
            e.preventDefault();
        });
        $(".drag-img").on('drop', function (e){
            e.preventDefault();
            var image = e.originalEvent.dataTransfer.files;
            var formData = new FormData($('#photos-uploader')[0]);
            var token = "{{csrf_token()}}";
            var row_count = $("#table-image tr td").length;
            var url_img = "{{asset('/uploads/product/photoalbum/')}}";
            for(var i = 0; i<image.length;i++){
                var check = checkIsImage(image[i]);
                if(check){
                 formData.append('image[]',image[i]);
                }else{
                    alert('Please select image file.');
                return false;
                }
            }
            if(image.length > 10 ){
                alert('Upload Maximum 10 photos!');
                return false;
            }else {
            if ((parseInt(row_count) + parseInt(image.length)) > 10) {
                alert('Upload Maximum 10 photos!');
                return false;
            }
            $.ajax({
                url: "{{route('saller-photos-product')}}",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        $("#table-image tr").prepend(
                            "<td><div class='img-show'>" +
                            "<input type='hidden' name='image_name[]' id='image_name' value='" + data[i] + "'>" +
                             "<img src='"+url_img+'/'+data[i]+"' class='image-drop'>" +
                            "<i class='fa fa-remove fa-absolute remove-pic'></i></div></td>"
                        );
                    }
                }
            });
        }
    });
    $("#file-image").change(function(){
        var formData = new FormData($('#photos-uploader')[0]);
        var count = $(this)[0].files.length;
        var token = "{{csrf_token()}}";
        var row_count = $("#table-image tr td").length;
        var image = this.files[0];
        var check = checkIsImage(image);
        var url_img = "{{asset('/uploads/product/photoalbum/')}}"; 
        if(!check){
            alert('Please select image file.');
            return false;
        }
        if(count > 10 ){
            alert('Upload Maximum 10 photos!');
            return false;
        }else{
        if((parseInt(row_count)+parseInt(count))>10){
            alert('Upload Maximum 10 photos!');
            return false;
        }
        $.ajax({
            url: "{{route('saller-photos-product')}}",
            headers: {
                'X-CSRF-TOKEN' : token},
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                console.log(data);
                for(var i = 0; i<data.length;i++){
                    $("#table-image tr").prepend(
                        "<td><div class='img-show'>" +
                        "<input type='hidden' name='image_name[]' id='image_name' value='"+data[i]+"'>"+
                        "<img src='"+url_img+'/'+data[i]+"' class='image-drop'>" +
                        "<i class='fa fa-remove fa-absolute remove-pic'></i></div></td>"
                    );
                }
            }
        });
    }
});
$("#save-image").click(function(){
    var formData = new FormData($('#photos-uploader')[0]);
    var token = "{{csrf_token()}}";
    $.ajax({
        url: "{{route('vendor/photos/products')}}",
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (image_name) {
            if (image_name == 'successfully') {
                swal({
                    title: "Done!",
                    text: "You have success to create Past Events!!",
                    type: "success"
                    }, function() {
                        location.reload();
                });
            }
            $("#table-image tr").html('');
        }
    });
});
$("#delete_selectd").click(function(){
    var check_select = $(".listing__list input:checkbox:checked").map(function(){
        return $(this).val();
    }).get();
    if(check_select==''){
        alert('Please select picture!');
        return false;
    }
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        }, function (isConfirm) {
            if (!isConfirm) return;
                $.ajax({
                    url: "{{route('vendor-remove-photo-pro')}}",
                    type: "GET",
                    data: {id:check_select},
                    success: function () {
                        swal("Done!", "It was succesfully deleted!", "success");
                        location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    }
                });
            });
        });
        function checkIsImage(file, callback){
            var image_match = ["image/jpeg", "image/png", "image/jpg"];
            var imagefile = file.type;
                // console.log(imagefile);
            imagefile = imagefile.toLowerCase();
            if(imagefile == image_match[0] || imagefile == image_match[1] || imagefile == image_match[2]){
                return true;
            }else{
                return false;
            }
        }
    </script>
@stop