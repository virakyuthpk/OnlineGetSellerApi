 <!--<form action="{{action('PaymentController@store')}}" method='POST'> -->

<!--<form action="https://wingsdk.wingmoney.com:334" method="POST">-->
<!--            <input name="ask_remember" type="text" value="0">-->
<!--            <input name="sandbox" type="text" value="1">-->
<!--            <input name="amount" type="text" id="amount">-->
<!--            <input name="username" type="text" value="online.bungech">-->
<!--            <input name="rest_api_key" type="text" value="c97ef9524653ae24a660b3910f7f8de98addc6470aa3ddaa4e5253b3c8707c52">-->
<!--            <input name="return_url" type="hidden" value="https://www.onlineget.com/api/form">-->
<!--            <input name="bill_till_rbtn" type="text" value="0">-->
<!--            <input name="bill_till_number" type="text" value="5102">-->
<!--            <input name="pay" type="submit" value="Pay">          -->
<!--</form>-->

@extends('front.joinus.layout')
@section('content')
	<div class="row">
		<div class="col-sm-offset-4 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-book"></i>You pay through Wing:</h4>
                </div>
                <div class="panel-body">
                    <fieldset>
                        <form   class="form-horizontal" method="post" action="https://wingsdk.wingmoney.com:334">
                            <input hidden name="ask_remember" type="text" value="0">
                            <input hidden name="sandbox" type="text" value="0">
                            <input hidden name="amount" type="text" id="amount">
                            <input hidden name="username" type="text" value="online.bungech">
                            <input hidden name="rest_api_key" type="text" value="c1232c6f48c8478a5e3e57faef4fb57d46ae2810b6251091cac4e6d3545b422c">
                            <input hidden name="return_url" type="hidden" value="https://www.onlineget.com/api/after_pay">
                            <input hidden name="bill_till_rbtn" type="text" value="0">
                           <input hidden name="bill_till_number" type="text" value="5102">
                           <input name="remark" type="text" value="{{Auth::user()->id}}" />
                            <div class="form-group">
                                <label for="phone" class="control-label">Your Phone</label>
                                <input class="form-control" name="phone" type="text" value="{{$data['phone']}}" readonly>
                            </div>  
                            <div class="form-group">
                                <label for="amount" class="control-label">Amount</label>
                                <input class="form-control" name="amount" type="text" value="{{$data['subtotal']}}" readonly>
                            </div>
                            
                            <input name="pay" type="submit" value="Pay" class="btn btn-primary">  
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>      
@endsection