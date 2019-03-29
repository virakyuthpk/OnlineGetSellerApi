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
                    <div class="vendor-right">
                        <div class="col-md-2 ven-img">
                             <img id="blah" src="{!! $vendor?$vendor->pic==''?asset('backEnd/img/no.jpg'):asset('uploads/shop/'.$vendor->pic):asset('backEnd/img/no.jpg') !!}" alt="your image" />
                        </div>
                        <div class=" text-right">
                            <a href="{{route('create-vendor-product')}}" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
                        </div>      
                        <div class="col-md-10">
                            <p class="config-sh">
                                <a href="{{route('vendor-config',Auth::user()->id)}}"><i class="fa fa-cog">Config Shop</a></i>
                            </p>
                            {!!$vendor?$vendor->shop_name: ''!!}  <span style="background-color: crimson;
                                color: aliceblue;
                            border-radius: 5px;padding: 2px;" class="logo">a4</span>
                            <br><br>
                            <span style="color: darkgrey;font-size: 13px"> Your Product :</span> <i style="color: darkorange" class="fa fa-archive"></i> <span style="color: chocolate">{!!$count!!}</span>
                            &nbsp;
                            <i style="color: darkgrey;" class="fa fa-envelope"></i> <span style="color: darkgrey;font-size: 13px"> Product Orders :</span><span style="color: chocolate">{!!$countorder!!}</span>
                        </div>
                    </div>
                    <div class="form-group">
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
                                            <td>{!! $pro->name_en !!}</td>
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