@extends('administrator.layouts.layouts')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{!! $id?'Update Supplier':'Add New Supplier' !!}</h3>
            </div>
            <div class="panel-body">
                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{Session::get('message')}}</strong>
                </div>
                @endif
                <div class="form">
                    <form class="form-horizontal" id="for_job" method="post" action="{{route('post-supplier',$id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="cname" class="control-label col-md-2">Name English <span>*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" name="name_en" type="text" value="{!!$supplier?$supplier->name_en:''!!}" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cname" class="control-label col-md-2">Name Khmer <span>*</span></label>
                            <div class="col-md-10">
                                <input class="form-control" name="name_kh" type="text" value="{!!$supplier?$supplier->name_kh:''!!}" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cname" class="control-label col-md-2">Mobile<span></span></label>
                            <div class="col-md-10">
                                <input class="form-control number" name="mobile" type="text" value="{!!$supplier?$supplier->mobile:''!!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cname" class="control-label col-md-2">Email<span></span></label>
                            <div class="col-md-10">
                                <input class="form-control" name="email" type="email" value="{!!$supplier?$supplier->email:''!!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cname" class="control-label col-md-2">Address<span></span></label>
                            <div class="col-md-10">
                                <input class="form-control" name="address" type="text" value="{!!$supplier?$supplier->address:''!!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cname" class="control-label col-md-2">Detail<span></span></label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="detail">{!! $supplier?$supplier->detail:''!!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-md-10">
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