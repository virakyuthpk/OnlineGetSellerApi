@extends('administrator.layouts.layouts')
@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group--col-6 form-group--inline social-media-colum-3 form-inline">
                    <table id="table-visitorlog" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>IP</th>
                            <th>Browser</th>
                            <th>OS</th>
                            <th>Country Code</th>
                            <th>Country Name</th>
                            <th>Region Name</th>
                            <th>City</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$visitor->isEmpty())
                            <?php $i = 1;?>
                            @foreach($visitor as $visit)
                                <tr>
                                    <td>{!! $i !!}</td>
                                    <td>{!!$visit->ip!!}</td>
                                    <td>
                                      {!! $visit->browser !!}
                                    </td>
                                    <td>{!! $visit->os !!}</td>
                                    <td>{!! $visit->country_code !!}</td>
                                    <td>{!! $visit->country_name !!}</td>
                                    <td>{!! $visit->region_name !!}</td>
                                    <td>{!! $visit->city !!}</td>
                                    <td>{!! $visit->created_at->format('d/m/Y') !!}</td>
                                </tr>
                                <?php $i++;?>
                            @endforeach
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
            $("#table-visitorlog").dataTable();
        });
    </script>
@stop