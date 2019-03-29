@extends('administrator.layouts.layouts')
@section('content')
@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{!! $id?'Update Departement':'Add New Departement' !!}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <form class="form-horizontal" id="frm-departement" method="post" 
                action="{{route('post-departement',$id)}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Name
                                </label>
                                <div class="col-lg-10">
                                    <input class=" form-control" name="title" type="text" value="{{$departement?$departement->name:''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-10 margin-left-10">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-success" type="submit" id="save">Save</button>
                            </div>
                        </div>
                     <!-- .form -->
                    </form>
                    </div>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div> <!-- End row -->
@stop
@section('scripts')
   <script type="text/javascript">
        $(document).ready(function(){
            $("#wizard-picture").change(function(){
                readURL(this,'blah');
            });
            $("#frm-departement").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    name: "required"
                },
                // Specify validation error messages
                messages: {
                    name: "Please enter departement name",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@stop
@stop