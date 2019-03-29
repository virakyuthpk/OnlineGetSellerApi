@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{$id?'Update Campaign':'Add Campaign'}}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class=" form">
                        <form class="form-horizontal" id="frm-campaign" method="post" action="{{route('post-campaign',$id)}}">
                           {{csrf_field()}}
                           <div class="form-group">
                                <label for="cname" class="control-label col-lg-2">Start date</label>
                                <div class="col-lg-4">
                                   <input class="form-control datetime" name="start_date" type="text" value="{!!$campaign?Carbon\Carbon::parse($campaign->start_date)->format('Y-m-d'):Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y-m-d')!!}">
                                </div>
                           </div>
                            <div class="form-group">
                                <label for="cname" class="control-label col-lg-2">End date</label>
                                <div class="col-lg-4">
                                   <input class="form-control datetime" name="end_date" type="text" value="{!!$campaign?Carbon\Carbon::parse($campaign->end_date)->format('Y-m-d'):Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y-m-d')!!}">
                                </div>
                           </div>
                            <div class="form-group">
                                <label for="cname" class="control-label col-lg-2">Category</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="category_id">
                                       @if(!$category->isEmpty())
                                            @foreach($category as $cate)
                                                <option value="{!!$cate->id!!}" {!!$campaign?$cate->id==$campaign->category_id?'selected':'':''!!}>{!!$cate->title_en!!}</option>
                                            @endforeach
                                       @endif
                                    </select>
                                </div>
                           </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Discount</label>
                                <div class="col-lg-4">
                                   <select class="form-control" name="discount_id">
                                        @if(!$discount->isEmpty())
                                            @foreach($discount as $dis)
                                                <option value="{!!$dis->id!!}" {!!$campaign?$dis->id==$campaign->discount_id?'selected':'':''!!}>{!!$dis->percentage!!} %</option>
                                            @endforeach
                                       @endif
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div> <!-- End row -->
@stop
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".datetime").datepicker({
                format: 'yyyy-mm-dd'
            });

            $("#frm-campaign").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    discount_id: "required",
                },
                // Specify validation error messages
                messages: {
                    discount_id: "Please select percentage",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop