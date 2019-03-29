@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{!! $id?'Update Address':'Add Address' !!}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class=" form">
                        <form class="form-horizontal" id="frm-address" method="post" action="{{route('post-address',$id)}}">
                            {{csrf_field()}}
                            <div class="row">                       
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Location EN</label>
                                    <div class="col-lg-4">
                                        <textarea class="form-control" name="location_en">{!! $address?$address->location_en:'' !!}</textarea>
                                    </div>
                                    <label class="control-label col-lg-2">Location Kh</label>
                                    <div class="col-lg-4">
                                        <textarea class="form-control" name="location_kh">{!! $address?$address->location_kh:'' !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Email</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control"  name="email" type="text" value="{{$address?$address->email:''}}">
                                    </div>
                                </div>  
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Phone number 1</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control"  name="phone" type="text" value="{{$address?$address->phone:''}}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Phone number 2</label>
                                    <div class="col-lg-10">
                                       <input class=" form-control"  name="phone1" type="text" value="{{$address?$address->phone1:''}}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Phone number 3</label>
                                    <div class="col-lg-10">
                                       <input class=" form-control"  name="phone2" type="text" value="{{$address?$address->phone2:''}}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Open time English</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="open_en" class="form-control" value="{!!$address?$address->open_en:''!!}">
                                       
                                    </div>
                                     <label class="control-label col-lg-2">Open time Khmer</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="open_kh" class="form-control" value="{!!$address?$address->open_kh:''!!}">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row margin-10 margin-left-10">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit" id="save">Save</button>
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
            $("#frm-address").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    location: "required"
                },
                // Specify validation error messages
                messages: {
                    location: "Please enter location"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

</script>
@stop