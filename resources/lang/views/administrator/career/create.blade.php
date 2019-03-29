@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{!! $id?'Update Career':'Add Career' !!}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class=" form">
                        <form class="form-horizontal" id="frm-career" method="post" action="{{route('post-job',$id)}}">
                            {{csrf_field()}}
                            <div class="row">
                             <div class="form-group">
                              <label class="col-lg-2 control-label">Status</label>
                              <div class="col-lg-4">
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                              </div>
                            </div>                           
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Title</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control"  name="title" type="text" value="{{$career?$career->title:''}}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Description</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control ckeditor"  name="des">{{$career?$career->des:''}}</textarea>
                                    </div>
                                </div>   
                            </div>
                            <div class="row">
                                <div class="form-group ">
                                    <label class="control-label col-lg-2 margin-left-25">Public date</label>
                                    <div class="col-lg-4">
                                        <input class="form-control" id="public_date" name="public_date" type="text" value="{{$career?Carbon\Carbon::parse($career->public_date)->format('Y-m-d'):Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y-m-d')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group ">
                                    <label class="control-label col-lg-2 margin-left-25">Closing date</label>
                                    <div class="col-lg-4">
                                        <input class="form-control" id="closing_date"  name="closing_date" type="text" value="{{$career?Carbon\Carbon::parse($career->closing_date)->format('Y-m-d'):Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y-m-d')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group ">
                                    <label class="control-label col-lg-2 margin-left-25">Term</label>
                                    <div class="col-lg-4">
                                        <select name="term" class="form-control">
                                            <option value="Full time" {{$career?$career->term=='full_time'?'selected':'':''}}>Full Time</option>
                                            <option value="Part time" {{$career?$career->term=='part_time'?'selected':'':''}}>Part Time</option>
                                        </select>
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
            $("#closing_date").datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#public_date").datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#frm-career").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    title: "required"
                },
                // Specify validation error messages
                messages: {
                    title: "Please enter title"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

</script>
@stop