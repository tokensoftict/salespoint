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
                                    <th>Scale</th>
                                    <th>Gross Pay</th>
                                    <th>Total Deduction</th>
                                    <th>Net Pay</th>
                                    <th>Bank</th>
                                    <th>Bank Account Name</th>
                                    <th>Bank Account No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($beneficiaries as $beneficiary)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $beneficiary->employee->employee_no }}</td>
                                            <td>{{ $beneficiary->employee->name }}</td>
                                            <td>{{ $beneficiary->scale->name }}</td>
                                            <td>{{ number_format($beneficiary->gross_pay,2) }}</td>
                                            <td>{{ number_format($beneficiary->total_deduction,2) }}</td>
                                            <td>{{ number_format($beneficiary->net_pay,2) }}</td>
                                            <td>{{ $beneficiary->bank->name }}</td>
                                            <td>{{ $beneficiary->account_name }}</td>
                                            <td>{{ $beneficiary->account_no }}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-primary">Payslip</a>
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
