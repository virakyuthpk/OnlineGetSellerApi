<form class="form-horizontal" id="frm-properties" method="post" action="{{route('post-property',$id)}}" enctype="multipart/form-data">
	{{csrf_field()}}
	<?php $lastId = "KR-01"; $new_id = explode('KR-',$lastId);$ID = $new_id[1]+1 ; $Id =  "KR_".$ID;?>
	<input name="id" type="hidden" value="{!!$product?$product->id : ''!!}">
	<input type="hidden" name="Id" value="{!!$product?$product->pcode :$Id!!}">
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Product Name </label>
		<div class="col-md-9">
			<input type="text" name="product_kh" value="{!!$product?$product->name_kh : ''!!}" class="form-control">
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Category *</label>
		<div class="col-md-9">
			<select class="form-control" name="category">
				<option value="0">Select Category</option>
				@if(!$category->isEmpty())
				@foreach($category as $cate)
				<option value="{{$cate->id}}" {{$product?$cate->id==$product->category_id?'selected':'':''}}>{{($cate->title_kh)}}</option>
				@endforeach
				@endif
			</select>

		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Unit</label>
		<div class="col-md-9">
			<select class="form-control" name="unit">
				@if(!$unit->isEmpty())
				@foreach($unit as $un)
				<option value="{{$un->id}}" {{$product?$un->id==$product->unit_id?'selected':'':''}}>{{$un->name_kh}}</option>
				@endforeach
				@endif
			</select>
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Brand</label>
		<div class="col-md-9">
			<select class="form-control" name="brand">
				@if(!$brand->isEmpty())
				@foreach($brand as $br)
				<option value="{{$br->id}}" {{$product?$br->id==$product->braind_id?'selected':'':''}}>{{$br->name_kh}}</option>
				@endforeach
				@endif
			</select>
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Offer :</label>
		<div class="col-md-9">
			<select class="form-control" id="sel_offer" name="type">
				<option>No</option>
                <option value="show">Yes</option>
			</select>
		</div>
	</div>
	<div class="form-group col-md-6"  id="offer_pr">
		<label for="cname" class="control-label col-md-3">Offer *</label>
		<div class="col-md-9">
			<input type="text" name="offer_price" value="{!!$product?$product->offer_price: ''!!}" class="form-control number">
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Supplier</label>
		<div class="col-md-9">
			<select class="form-control" name="supplier">
				@if(!$supplier->isEmpty())
				@foreach($supplier as $sup)
				<option value="{{$sup->id}}" {{$product?$sup->id==$product->supplier_id?'selected':'':''}}>{{$sup->name_kh}}</option>
				@endforeach
				@endif
			</select>
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Model *</label>
		<div class="col-md-9">
			<input type="text" name="model" value="{!!$product?$product->model: ''!!}" class="form-control number">
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Seling Price</label>
		<div class="col-md-9">
			<input class=" form-control number" name="sell_price" type="text" value="{!!$product?$product->sell_price: ''!!}">
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Special *</label>
		<div class="col-md-9">
			<input class=" form-control number" name="special" type="text" value="{!!$product?$product->special: ''!!}">
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-md-3">Variant *</label>
		<div class="col-md-9">
		<input type="hidden" name="p_id[]"  value="{!!$product?$product->id: ''!!}">
			<select class="form-control" id="variankh" name="variant[]" multiple="multiple">
  @if(!$variant->isEmpty())
				@foreach($variant as $var)
				<option value="{{$var->id}}" {{$product?$var->id==$product->supplier_id?'selected':'':''}}>{{$var->name_kh}}</option>
				@endforeach
				@endif
</select>
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-lg-3">Status</label>
		<div class="col-lg-9">
			<select name="status" class="form-control">
				<option value="1">Active</option>
				<option value="0">Inactive</option>
			</select>
		</div>
	</div>
	<div class="form-group col-md-12">
		<label for="cname" class="control-label col-lg-2">Detail</label>
		<div class="col-lg-10">
			<textarea class="form-control ckeditor" name="detail_kh">{!!$product?$product->detail_kh: ''!!}
			</textarea>
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-lg-2">Review</label>
		<div class="col-lg-10">
			<textarea class="form-control ckeditor" name="review_kh">{!!$product?$product->review_kh: ''!!}
			</textarea>
		</div>
	</div>
	<div class="form-group col-md-6">
		<label for="cname" class="control-label col-lg-2">Description</label>
		<div class="col-lg-10">
			<textarea class="form-control ckeditor" name="des_kh">{!!$product?$product->des_kh: ''!!}
			</textarea>
		</div>
	</div>
	<div class="row form-group col-md-12">
		<label for="cname" class="control-label col-lg-2">Featur Image</label>
		<div class="picture col-md-10" >
			<img id="blah" src="{!! $product?$product->image==''?asset('backEnd/img/no.jpg'):asset('uploads/product/'.$product->image):asset('backEnd/img/no.jpg') !!}" alt="your image" />
			<input type='file' id="wizard-picture" name="image" onchange="readURL(this);">
			<input type="hidden" name="tmp_file" value="{{$product?$product->image:''}}">
		</div>
		<label id="wizard-picture-error" class="error margin-left-10" for="wizard-picture"></label>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
			<button class="btn btn-success" type="submit" value="submit">Submit</button>
		</div>
	</div>
</form>