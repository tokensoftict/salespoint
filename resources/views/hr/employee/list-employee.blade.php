@extends('layouts.app')

@push('css')
    <link href="{{ asset('bower_components/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
@endpush


@section('content')

    <div class="ui-container">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading panel-border">
                        {{ $title }}
                        @if(userCanView('employee.create'))
                            <span class="tools pull-right">
                                            <a  href="{{ route('employee.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New Employee</a>
                            </span>
                        @endif
                    </header>
                    <div class="panel-body">
                        @if(session('success'))
                            {!! alert_success(session('success')) !!}
                        @elseif(session('error'))
                            {!! alert_error(session('error')) !!}
                        @endif

                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-lg-4 col-lg-offset-7">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <div class="form-group">
                                                    <input type="text" name="search" value="{{  $s ?? ""  }}" id="search" class="form-control" placeholder="Search for employee e.g surname othername employee number">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button class="btn btn-primary btn-sm">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="stock_holder">
                                <table class="table {{ config('app.store') == "inventory" ? "" : 'convert-data-table' }} table-bordered table-responsive table-striped" style="font-size: 12px">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee No.</th>
                                        <th>Surname</th>
                                        <th>Other Names</th>
                                        <th>Phone Number</th>
                                        <th>Marital Status</th>
                                        <th>Scale</th>
                                        <th>Designation</th>
                                        <th>Rank</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $employee->employee_no }}</td>
                                            <td>{{ strtoupper($employee->surname) }}</td>
                                            <td>{{ ucwords(strtolower($employee->other_names)) }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>{{ $employee->marital_status }}</td>
                                            <td>{{ $employee->scale_id ? $employee->scale->name : "" }}</td>
                                            <td>{{ $employee->designation_id ? $employee->designation->name : "" }}</td>
                                            <td>{{ $employee->rank_id ? $employee->rank->name : "" }}</td>
                                            <td>{!! ($employee->status == 1 ? label("Active","success") : label("Inactive","danger")) !!}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        @if(userCanView('employee.edit'))
                                                            <li><a href="{{ route('employee.edit',$employee->id) }}">Edit</a></li>
                                                        @endif
                                                        @if(userCanView('employee.toggle'))
                                                            <li><a href="{{ route('employee.toggle',$employee->id) }}">{{ $employee->status == 0 ? 'Enabled' : 'Disabled' }}</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if(config('app.store') == "inventory")
                                    {!! $employees->links() !!}
                                @endif
                            </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

                        @endsection

@push('js')
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
    <script src="{{ asset('assets/js/init-datatables.js') }}"></script>
    <script>
        /*
        var cache = $('#stock_holder').html();
        $(document).ready(function(){
            $('#search').on("keyup",function(e){
                $.get('?search=' + encodeURI($(this).val()), function (response) {
                    $('#stock_holder').html(response);
                });
            });
        });
        */
    </script>
@endpush
