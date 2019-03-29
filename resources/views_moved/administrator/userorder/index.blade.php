@extends('administrator.layouts.layouts')
@section('content')
<div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <label>List of Product order</label>
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
                                <th>Product code</th>
                                <th>Phone</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$order->isEmpty())
                                 <?php $i=1;?>
                                @foreach($order as $ord)
                                    <tr>
                                        <td>{!!$i!!}</td>
                                        <td>{!!$ord->product?$ord->product->pcode:'' !!}</td>
                                        <td>{!!$ord->phone!!}</td>
                                        <td>{!!$ord->qty!!}</td>
                                        <td>{!!$ord->product?$ord->product->sell_price:''!!}</td>
                                        <td>{!!$ord?$ord->subtotal:''!!}</td>
                                        <td>
                                            <img src="{!!asset('uploads/product/feature/'.$ord->product->image)!!}" width="100">
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