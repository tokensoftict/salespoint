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
                        <x-store-selector/>
                        <form action=""  class="tools pull-right" style="margin-right: 80px" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>Date</label>
                                    <input type="text" class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-dd" style="background-color: #FFF; color: #000;"  value="{{ $date }}" name="date" placeholder="Date"/>
                                </div>
                                <div class="col-sm-5">
                                    <label>Select User</label>
                                    <select class="form-control" name="customer">
                                        @foreach($customers as $cus)
                                            <option {{ $customer == $cus->id ? "selected" : "" }} value="{{ $cus->id }}">{{ $cus->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2"><br/>
                                    <button type="submit" style="margin-top: 5px;" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                    </header>
                    <div class="panel-body">
                        @php
                            $all_total=0;
                            $total_credit =0;
                        @endphp
                        @foreach($payment_methods as $payment_method)

                            <h3>{{ $payment_method->name }} PAYMENTS</h3>
                            <table class="table table-bordered table-responsive table convert-data-table table-striped" id="invoice-list" style="font-size: 12px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Store</th>
                                    <th>Method</th>
                                    <th>Invoice / Receipt Number</th>
                                    <th>Sub Total</th>
                                    <th>Total Paid</th>
                                    <th>Payment Time</th>
                                    <th>Payment Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total=0;
                                @endphp
                                @foreach(\App\Models\PaymentMethodTable::where('payment_method_id',$payment_method->id)->where('user_id',$customer)->where('payment_date',$date)->where('warehousestore_id',getActiveStore()->id)->get() as $payment)
                                    @php
                                        $total+=$payment->amount;
                                        $all_total+=$payment->amount;
                                        if($payment_method->id == 4) $total_credit+=$payment->amount;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->customer->firstname }} {{ $payment->customer->lastname }}</td>
                                        <td>{{ $payment->warehousestore->name }}</td>
                                        <td>{{ $payment->payment_method->name }}</td>
                                        <td>{{ $payment->invoice->invoice_paper_number ?? "" }}</td>
                                        <td>{{ number_format($payment->amount,2) }}</td>
                                        <td>{{ number_format($payment->amount,2) }}</td>
                                        <td>{{ date("h:i a",strtotime($payment->payment->payment_time)) }}</td>
                                        <td>{{ convert_date($payment->payment->payment_date) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th>{{ number_format($total,2) }}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        @endforeach
                        <table class="table">
                            <tr>
                                <th> <h2 class="pull-right">Total Payment : {{ number_format($all_total,2) }}</h2></th>
                            </tr>
                            <tr>
                                <th> <h2 class="pull-right">Total Credit Payment : -{{ number_format($total_credit,2) }}</h2></th>
                            </tr>
                            <tr>
                                <th> <h2 class="pull-right">Grand Total : {{number_format(($all_total - $total_credit),2) }}</h2></th>
                            </tr>
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
