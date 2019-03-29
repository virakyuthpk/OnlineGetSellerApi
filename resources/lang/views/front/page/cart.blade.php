@extends('front.joinus.layout')
@section('content')
<div class="row">
  <div id="content" class="col-sm-12">
    <h2 class="title">Shopping Cart</h2>
    <div class="table-responsive form-group">
      <table class="table table-bordered">
        <thead>
          <tr>
            <td class="text-center">Image</td>
            <td class="text-left">Product Name</td>
            <td class="text-left">Quantity</td>
            <td class="text-right">Unit Price</td>
            <td class="text-right">Total</td>
          </tr>
        </thead>
        <tbody>
           <?php foreach(Cart::content() as $row) :?>
              <tr>
                <td class="text-center"><a href=""><img width="70px" src="{!! $row?$row->id==''?asset('front/image/no1.png'):asset('uploads/product/'.$row->id):asset('front/image/no1.png') !!}" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-thumbnail" /></a></td>
                <td class="text-left"><a href="product.html"><?php echo $row->name; ?></a><br />
                </td>
              
              <td class="text-left" width="200px">
                <div class="input-group btn-block quantity">
                  <input type="text" name="quantity" value="<?php echo $row->qty; ?>" size="1" class="form-control" />
                  <span class="input-group-btn">
                    <button type="submit" data-toggle="tooltip" title="Update" class="btn btn-primary"><i class="fa fa-clone"></i></button>
                    <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" onClick=""><i class="fa fa-times-circle"></i></button>
                  </span>
                </div>
              </td>
              <td> <input type="text" name="" value="{!!$row->img!!}"></td>
              <td class="text-right">$<?php echo $row->price; ?></td>
              <td class="text-right">$<?php echo $row->total; ?></td>
              </tr>
            <?php endforeach;?>
        </tbody>
      </table>
    </div>
    <div class="buttons">
      <div class="pull-right">
        <a href="#" class="btn btn-primary">Checkout</a>
      </div>
    </div>
  </div>
</div>
@stop