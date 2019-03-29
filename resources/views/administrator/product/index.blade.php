@extends('administrator.layouts.layouts')
@section('content')
<div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <label>List of Product</label>
                <div class=" text-right">
                    <a href="{{route('create-product')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
                    <table id="table-property" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Supplier</th>
                                <th>Category</th>
                                <th>Unit</th>
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
                                        <td>{!! $pro->name_en !!}</td>
                                        <td>{!!$pro->supplier?$pro->supplier->name_en:''!!}</td>
                                        <td>{!!$pro->category?$pro->category->title_en:''!!}</td>
                                        <td>{!!$pro->unit?$pro->unit->name_en:''!!}</td>
                                        <td>$ {!! $pro->sell_price !!}</td>
                                        <td><img src="{{asset('uploads/product/feature/'.$pro->image)}}" width="100"> </td>
                                        <td>
                                            <a href="{{route('edit-product',$pro->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i> </a>
                                            <a onclick="removePastEvent({{$pro->id}})" class="btn btn-icon btn-danger m-b-5"><i class="fa fa-remove"></i> </a>
                                        
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
@stop
@section('scripts')
<script type="text/javascript">
     $("#table-property").dataTable();
    function removePastEvent(id){
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
                 url: "{{route('delete/photo/pro')}}",
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
        route = "active-product";
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
                    url: "{{route('active-product')}}",
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