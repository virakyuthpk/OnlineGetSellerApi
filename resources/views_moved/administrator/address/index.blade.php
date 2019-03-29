@extends('administrator.layouts.layouts')
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{Session::get('message')}}
        </div>
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Submited failed! Please try again.</strong>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-3">
                    <label>Address</label>
                </div>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
                    <table id="table-address" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>email</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$address->isEmpty())
                            <?php $i=1;?>
                            @foreach($address as $add)
                                <tr>
                                    <td>{!! $i !!}</td>
                                    <td>{!! $add->email !!}</td>
                                    <td>{!! $add->location !!}</td>
                                    <td>{!! $add->phone !!} , {!! $add->phone1 !!},{!! $add->phone2 !!}</td>
                                    <td>
                                        <a href="{{route('edit-address',$add->id)}}"  class="btn btn-icon btn-success m-b-5" ><i class="fa fa-edit"></i> </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Data Available.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(function () {
            $("#table-address").dataTable();
        });
    </script>
@stop