@extends('front.layout.layout')
@section('content')
<div class="columns-container">
    <div class="container" id="columns">
        <div class="breadcrumb clearfix">
            <a class="home" href="{{route('home')}}" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">Product Order</span>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="col-md-2 col-sm-4 col-xs-4 left_lay">
                    @include('front.layout.left-vendor')
                </div>
                <div class="col-md-10 col-sm-8 col-xs-8 frm-mid">
                    <div class="page-content">
                        <div class="row">
                            <table class="table table-bordered table-responsive cart_summary">
                                <thead>
                                    <tr>
                                        <th class="cart_product">Product</th>
                                        <th>Customer</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Number phone</th>
                                        <th class="action"><i class="fa fa-trash-o"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(!$order_history->isEmpty())    
                                @foreach($order_history as $pro)
                                    <tr>
                                    <td>
                                        {!!$pro->f_name!!}{!!$pro->l_name!!}
                                    </td>
                                        <td class="cart_product">
                                            <a href="#"><img src="{!!asset('front/data/product-100x122.jpg') !!}" alt="Product"></a>
                                        </td>
                                        <td class="cart_description">
                                            <p class="product-name"><a href="#">{!!$pro->product->name_en!!} </a></p>
                                            <small class="cart_ref">SKU : #123654999</small><br>
                                            <small><a href="#">Color : Beige</a></small><br>   
                                            <small><a href="#">Size : S</a></small>
                                        </td>
                                        <td class="qty">
                                           {!!$pro->qty!!}
                                            
                                        </td>
                                        <td class="price">
                                            <span>${!!$pro->amout!!}</span>
                                        </td>
                                        <td>
                                            {!!$pro->phone!!}
                                        </td>
                                        <td class="action">
                                            <a href="#" onclick="removeData({{$pro->id}})" >Delete item</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop