@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{$id?'Update Province':'Add Province'}}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class=" form">
                        <form class="form-horizontal" id="frm-province" method="post" action="{{route('post-province',$id)}}">
                           {{csrf_field()}}
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2"> Name English</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="name_en" type="text" value="{!!$province?$province->name_en:''!!}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Name Khmer</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="name_kh" type="text" value="{!!$province?$province->name_kh:''!!}">
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
            $("#frm-province").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    country: "required",
                    name: "required"
                },
                // Specify validation error messages
                messages: {
                    country: "Please select country",
                    name: "Please enter name"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop