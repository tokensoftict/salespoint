@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}">

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
                    <header class="panel-heading">
                        {{ $title }}
                    </header>
                    <div class="panel-body">
                        @if(session('success'))
                            {!! alert_success(session('success')) !!}
                        @elseif(session('error'))
                            {!! alert_error(session('error')) !!}
                        @endif

                        <table class="table table-bordered table-responsive table convert-data-table table-striped" style="font-size: 12px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Period</th>
                                <th>Employee Count</th>
                                <th>Gross Pay</th>
                                <th>Gross Deduction</th>
                                <th>Net Pay</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($periods as $period)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $period->period_date }}</td>
                                    <td>{{ $period->payslips_count }}</td>
                                    <td>{{ number_format($period->gross_pay,2) }}</td>
                                    <td>{{ number_format($period->gross_deduction,2) }}</td>
                                    <td>{{ number_format($period->net_pay,2) }}</td>
                                    <td>{!! $period->status == 1 ? label("Pending","default") : ( $period->status == 2 ? label("Approved","primary") : label("Closed","success") ) !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                            <ul role="menu" class="dropdown-menu">
                                                @if(userCanView('periods.run') && getCurrentPeriod()->id === $period->id)
                                                    <li><a href="{{ route('periods.run',$period->id) }}">Run</a></li>
                                                @endif
                                                @if(userCanView('periods.approve') && getCurrentPeriod()->id === $period->id && $period->status == 1)
                                                    <li><a class="confirm_action" data-msg="Are you sure, you want to approve this payroll this can not be reversed" href="{{ route('periods.approve',$period->id) }}">Approve</a></li>
                                                @endif
                                                    @if(userCanView('periods.close') && getCurrentPeriod()->id === $period->id && $period->status == 2)
                                                        <li><a class="confirm_action" data-msg="Are you sure, you want to close this payroll this can not be reversed" href="{{ route('periods.close',$period->id) }}">Close</a></li>
                                                    @endif
                                                @if(userCanView('periods.beneficiary'))
                                                    <li><a href="{{ route('periods.beneficiary',$period->id) }}"> Beneficiaries</a></li>
                                                @endif
                                                @if(userCanView('periods.xls'))
                                                    <li><a href="{{ route('periods.xls',$period->id) }}">Export Excel Beneficiaries</a></li>
                                                @endif
                                                @if(userCanView('periods.pdf'))
                                                    <li><a href="{{ route('periods.pdf',$period->id) }}">Export PDF Beneficiaries</a></li>
                                                @endif
                                            </ul>
                                        </div>
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
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('assets/js/init-select2.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
    <script src="{{ asset('assets/js/init-datatables.js') }}"></script>
    <script  src="{{ asset('assets/js/init-datepicker.js') }}"></script>
@endpush
