@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{$id?'Update Discount':'Add Discount'}}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class=" form">
                        <form class="form-horizontal" id="frm-discount" method="post" action="{{route('post-discount',$id)}}">
                           {{csrf_field()}}
                            
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Percentage</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="percentage" type="text" value="{{$discount?$discount->percentage:''}}">
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
            $("#frm-discount").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    percentage: "required",
                },
                // Specify validation error messages
                messages: {
                    percentage: "Please select percentage",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop