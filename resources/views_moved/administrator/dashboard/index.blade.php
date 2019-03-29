@extends('administrator.layouts.layouts')
@section('content')

<div class="page-title"> 
    <h3 class="title">Welcome ! To Onlineget.com</h3>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-3">
                <label>Today Visitor</label>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-info">
                        <i class="ion-android-contacts"></i> 
                        <h2 class="m-0 counter">{!!$count_ad?$count_ad:'0'!!}</h2>
                        <div>Addroid</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-success">
                        <i class="ion-android-contacts"></i> 
                        <h2 class="m-0 counter">{!!$count_iphone?$count_iphone:'0'!!}</h2>
                        <div>iPhone</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-purple">
                        <i class="ion-android-contacts"></i> 
                        <h2 class="m-0 counter">{!!$count_computer?$count_computer:'0'!!}</h2>
                        <div>Computer</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-pink">
                        <i class="ion-eye"></i> 
                        <h2 class="m-0 counter">{!!$total_today?$total_today:''!!}</h2>
                        <div>Total</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-3">
                <label>All Visitor</label>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-info">
                        <i class="ion-android-contacts"></i> 
                        <h2 class="m-0 counter">{!!$count_ad_total?$count_ad_total:'0'!!}</h2>
                        <div>Addroid</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-success">
                        <i class="ion-android-contacts"></i> 
                        <h2 class="m-0 counter">{!!$count_iphone_total?$count_iphone_total:'0'!!}</h2>
                        <div>iPhone</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-purple">
                        <i class="ion-android-contacts"></i> 
                        <h2 class="m-0 counter">{!!$count_computer_total?$count_computer_total:'0'!!}</h2>
                        <div>Computer</div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-pink">
                        <i class="ion-eye"></i> 
                        <h2 class="m-0 counter">{!!$total?$total:''!!}</h2>
                        <div>Total</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
