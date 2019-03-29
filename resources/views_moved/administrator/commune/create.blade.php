@extends('administrator.layouts.layouts')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{$id?'Update Commune':'Add Commune'}}</h3></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif
                    <div class=" form">
                        <form class="form-horizontal" id="frm-commune" method="post" action="{{route('post-commune',$id)}}">
                           {{csrf_field()}}
                            <div class="form-group ">
                                <label class="control-label col-lg-2">Province Name</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="pro_id" >
                                        <option value="">Select Province</option>
                                         @if(!$province->isEmpty())
                                            @foreach($province as $pro)
                                               <option value="{!!$pro->id!!}" {!!$commune?$pro->id==$commune->province_id?'selected':'':''!!}>{!!$pro->name_en!!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-lg-2">District Name</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="destric">
                                         <option value="">Select District</option>
                                         
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Name English</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="name_en" type="text" value="{!!$commune?$commune->name_en:''!!}">
                                </div>
                            </div>
                             <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">Name Khmer</label>
                                <div class="col-lg-4">
                                    <input class="form-control" name="name_kh" type="text" value="{!!$commune?$commune->name_kh:''!!}">
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
            $("#frm-commune").submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    province: "required",
                    name: "required"
                },
                // Specify validation error messages
                messages: {
                    province: "Please select country",
                    name: "Please enter name"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        $('select[name="pro_id"]').on('change', function() {
        var proid = $(this).val();
        if(proid) {
            $.ajax({
                url: '/province-distric/'+proid,
                type: "get",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    $('select[name="destric"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="destric"]').append('<option value="'+ value.id +'">'+ value.name_en +'</option>');
                    });

                }
            });
        }else{
            $('select[name="destric"]').empty();
        }
    });
    </script>
@stop