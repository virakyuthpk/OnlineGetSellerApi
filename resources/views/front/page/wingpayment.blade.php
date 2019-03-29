<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
    	body .container {
    		margin-top: 15px;
    	}
    	h6.title {
    		text-align: center;
    	}
    </style>
</head>
<body>

<div class="container">
	<div class="row  justify-content-md-center">
    	<div class="col col-md-2">
    	</div>
    	<div class="col-md-auto">
      		<h6 class="title">You pay through Wing:</h6>
    	</div>
    	<div class="col col-md-2">
    	</div>
  	</div>
  	<div class="row justify-content-md-center">
  		 <div class="col col-md-2">
	    </div>
  		<div class="col-md-auto">
			<form class="form-horizontal" method="post" action="https://wingsdk.wingmoney.com:334">
		        <input hidden="" name="ask_remember" type="text" value="0"/>
		        <input hidden="" name="sandbox" type="text" value="1"/>
		        <input hidden="" name="username" type="text" value="online.bungech"/>
		        <input hidden="" name="rest_api_key" type="text" value="c97ef9524653ae24a660b3910f7f8de98addc6470aa3ddaa4e5253b3c8707c52"/>
		        <input hidden="" name="return_url" type="hidden" value="https://www.onlineget.com/api/app-payment-return"/>
		        <input hidden="" name="bill_till_rbtn" type="text" value="0"/>
		       <input hidden="" name="bill_till_number" type="text" value="5102"/>
		       <input hidden="" name="remark" type="text" id="user_id" value=""/>
		        <div class="form-group">
		            <label for="phone" class="control-label">Your Phone</label>
		            <input class="form-control" id="phone" name="phone" type="text" value="" readonly=""/>
		        </div>  
		        <div class="form-group">
		            <label for="amount" class="control-label">Amount</label>
		            <input class="form-control" id="total_amount" name="amount" type="text" value="" readonly=""/>
		        </div>
		        
		        <input name="pay" type="submit" value="Pay" class="btn btn-primary"/>  
		    </form>
	    </div>
	    <div class="col col-md-2">
	    </div>
 	</div>
</div>
</body>
</html>