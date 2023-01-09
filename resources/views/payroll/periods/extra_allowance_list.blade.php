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
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive table-striped convert-data-table" style="font-size: 12px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee No</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Total Amount</th>
                                <th>Tenure</th>
                                <th>Start Date</th>
                                <th>Stop Date</th>
                                <th>Status</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allowances as $allowance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $allowance->employee->employee_no }}</td>
                                    <td>{{ $allowance->employee->name }}</td>
                                    <td>{{ number_format($allowance->amount ,2) }}</td>
                                    <td>{{ $allowance->tenure > 0 ? number_format($allowance->total_amount,2) : "" }}</td>
                                    <td>{{ $allowance->tenure > 0 ? $allowance->tenure." Month(s)" : "Infinity" }} </td>
                                    <td>{{ eng_str_date($allowance->start_date) }}</td>
                                    <td>{{ $allowance->tenure > 0 ? eng_str_date($allowance->end_date) : "" }}</td>
                                    <td>{!! $allowance->status == 0 ? label("Pending","default") : ( $allowance->status == 1 ? label("Approved","primary") : label("Completed","success") ) !!}</td>
                                    <td>{{ $allowance->comment }}</td>
                                    <td>
                                        @if(userCanView('periods.stop_running_allowance') && $allowance->status == 1 )
                                            <a href="{{ route('periods.stop_running_allowance',$allowance->id) }}"  class="btn btn-sm btn-primary confirm_action" data-msg="Are you sure, you want stop this allowance">Stop</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
@endpush
