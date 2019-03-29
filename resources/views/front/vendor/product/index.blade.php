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
                <div class="col-md-10 col-sm-8 col-xs-8 frm-mid">
                    <div class=" text-right">
                        <a href="{{route('create-vendor-product')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
                    </div>
                    <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
                        <table id="table-property" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Sell Price</th>
                                    <th>Image</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$product->isEmpty())
                                     <?php $i=1;?>
                                    @foreach($product as $pro)
                                        <tr>
                                            <td>{!!$i!!}</td>
                                            <td>{!! $pro?$pro->name_en: '' !!}</td>
                                            <td>{!!$pro->category->title_en!!}</td>
                                            <td>$ {!! $pro->sell_price !!}</td>
                                            <td><img src="{{asset('uploads/product/feature/'.$pro->image)}}" width="100"> </td>
                                            <td>
                                                <a href="{{route('edit-vendor-product',$pro->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i> </a>
                                                <a onclick="removeData({{$pro->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
                                            
                                            @if($pro->status == 1)
                                                <a onclick="activeDatas({{$pro->id}})" class="btn btn-icon btn-warning m-b-5" title="Click here to disable"><i class="fa fa-unlock"></i></a>
                                                @else
                                                <a onclick="activeDatas({{$pro->id}})" class="btn btn-icon btn-warning m-b-5" title="Click here to endable"><i class="fa fa-lock"></i></a>
                                            @endif
                                            </td>
                                        </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No Data Available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    $("#table-property").dataTable();
    function removeData(id){
        swal({
            title: "Are you sure?",
            text: "Are you sure that you want to delete this user?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
             url: "{{route('delete/vendor/photo/pro')}}",
                type: "GET",
                data: {id: id},
                success:function(data){
              
                        swal({
                            title: "Done!",
                            text: "It was succesfully deleted!",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
               
                }
            });
        });
    }
    function activeDatas(id){
        swal({
            title: "Are you sure?",
            text: "Are you sure that you want to active this?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, active it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "{{route('active-vendor-product')}}",
                type: "GET",
                data: {id: id},
                success:function(data){
                    if(data == 'success'){
                        swal({
                            title: "Done!",
                            text: "It was succesfully active!",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    }
                }
            });
        });
    }
</script>
@stop