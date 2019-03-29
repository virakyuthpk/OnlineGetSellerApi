@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{!! $id?'Update Slide':'Add New Country' !!}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <form class="form-horizontal" id="frm-country" method="post" action="{{route('post-country',$id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class=" form">
                            <div class="row">
                                <div class="col-lg-12">
                                        <div class="tab-content">
                                        <div class="form-group ">
                                                    <label for="cname" class="control-label col-lg-2">Name Country</label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control"  name="name" type="text" value="{{$country?$country->name:''}}">

                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                <label for="cname" class="control-label col-lg-2">Country Code</label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control"  name="code" type="text" value="{{$country?$country->code:''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="cname" class="control-label col-lg-2">Phone_Code</label>
                                                    <div class="col-lg-10">
                                                        <input class=" form-control" id="phone_code" name="phone" type="text" value="{{$country?$country->phone_code:''}}">
                                                    </div>
                                                </div>
                                                
                                        </div>
                                   
                                </div>
                            </div>
                                <div class="row margin-top-10 margin-left-10">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit" id="save">Save</button>
                                </div>
                            </div>
                        </div> <!-- .form -->
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div> <!-- End row -->
@stop
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#phone_code").ForceNumeric();
            $("#frm-country").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    name: "required",
                    code: "required",
                    phone: "required"
                },
                // Specify validation error messages
                messages: {
                    name: "Please enter name",
                    code: "Please enter country code",
                    phone: "Please enter phone_code"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
  </script>
@stop