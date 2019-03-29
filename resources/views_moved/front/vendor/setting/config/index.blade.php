@extends('front.layout.layout')
@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="breadcrumb clearfix">
            <a class="home" href="{{route('home')}}" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Shop Setting</span>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="col-md-2 col-sm-4 col-xs-4 left_lay">
                    @include('front.layout.left-vendor')
                </div>
                <div class="col-md-10 col-sm-8 col-xs-8 frm-mid">
                	<form class="form-horizontal" id="frm-prouduct" method="post" action="{{route('post-vendor-config',$id)}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="col-md-12">
							<div class="form-group">
								<label for="usr">Shop Name:</label>
								<input type="hidden" name="p_id[]"  value="{!!$vendor?$vendor->id: ''!!}">
								<input name="id" type="hidden" value="{!!$vendor?$vendor->id : ''!!}">
								<input type="text" class="form-control" value="{!!$vendor?$vendor->shop_name : ''!!}" name="shop_name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ">
								<label>Proince Name</label>
								<select class="form-control" name="pro_id">
									<option value="">Select Province</option>
									@if(!$province->isEmpty())
									@foreach($province as $pro)
									<option value="{!!$pro->id!!}" {!!$village?$pro->id==$village->province_id?'selected':'':''!!}>{!!$pro->name_en!!}</option>
									@endforeach
									@endif
								</select>
							</div>
							<div class="form-group ">
								<label>District Name</label>
								<select class="form-control" name="destrict">
									<option value="">Select District</option>
									
								</select>
							</div>
							<div class="form-group ">
								<label>Commune Name</label>
								<select class="form-control" name="commune">
									<option value="">Select communce</option>
								</select>
							</div>
							<div class="form-group">
								<label for="cname" class="control-label col-md-4">Profile-Image: <span>*</span></label>
								<div class="col-md-2">
                                	<div class="picture" >
                                     	<img id="blah" src="{!! $vendor?$vendor->pic==''?asset('backEnd/img/no.jpg'):asset('uploads/shop/'.$vendor->pic):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                    					<input type='file' id="wizard-picture" name="image" onchange="readURL(this);">
                    					<input type="hidden" name="tmp_file" value="{!!$vendor?$vendor->pic:''!!}">
                                	</div>
                                	<label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="pwd">Store_Url:</label>
								<input type="text" class="form-control" value="{!!$vendor?$vendor->store_url: ''!!}" name="url" >
							</div>
							<div class="form-group">
								<label for="pwd">ID-Card:</label>
								<input type="text" class="form-control" value="{!!$vendor?$vendor->idcard: ''!!}" name="idcard" >
							</div>
							<div class="form-group">
								<label for="pwd">Detail:</label>
								<textarea rows="10" cols="53" name="des">{!!$vendor?$vendor->detail: ''!!}</textarea>
							</div>
						</div>
						<div class="col-md-12 pull-right">
							<button class="btn btn-success">Save</button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$("#wizard-picture").change(function(){
			readURL(this,'blah');
		});
		$("#frm-village").submit(function(e) {
		e.preventDefault();
		}).validate({
			rules: {
				province: "required",
				name: "required"
			},
			// Specify validation error messages
			messages: {
				province: "Please select province",
				name: "Please enter name"
			},
			submitHandler: function(form) {
			form.submit();
			}
		});
	});
	$('select[name="pro_id"]').on('change', function() {
		var proid = $(this).val();
		if(proid) {
			$.ajax({
				url: '/province-distric/'+proid,
				type: "get",
				dataType: "json",
				success:function(data) {
		console.log(data);
		$('select[name="destrict"]').empty();
		$.each(data, function(key, value) {
		$('select[name="destrict"]').append('<option value="'+ value.id +'">'+ value.name_en +'</option>');
		});
		}
		});
		}else{
		$('select[name="destrict"]').empty();
		}
	});
$('select[name="destrict"]').on('change', function() {
var disid = $(this).val();
if(disid) {
$.ajax({
url: '/district-commune/'+disid,
type: "get",
dataType: "json",
success:function(data) {
console.log(data);
$('select[name="commune"]').empty();
$.each(data, function(key, value) {
$('select[name="commune"]').append('<option value="'+ value.id +'">'+ value.name_en +'</option>');
});
}
});
}else{
$('select[name="commune"]').empty();
}
});
</script>
@stop