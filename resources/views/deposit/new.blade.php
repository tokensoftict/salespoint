@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}">
    <link href="{{ asset('bower_components/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
    <style>
        input {
            margin-bottom: 0 !important;
        }
    </style>
@endpush

@section('content')

    <div class="ui-container">
        <div class="row">
            <div class="col-md-6 col-lg-offset-3">
                <section class="panel">
                    @if(session('success'))
                        {!! alert_success(session('success')) !!}
                    @elseif(session('error'))
                        {!! alert_error(session('error')) !!}
                    @endif
                    <div class="panel-heading">
                        {{ $title }}
                    </div>
                    <div class="panel-body">
                        @if(isset($deposit->id))
                            <form  action="{{ route('deposits.update',$deposit->id) }}" enctype="multipart/form-data" method="post">
                                {{ method_field('PUT') }}
                                @else
                                    <form  action="{{ route('deposits.store') }}" enctype="multipart/form-data" method="post">
                                        @endif
                                        <div class="panel-body">
                                            {{ csrf_field() }}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Select Customer <span  style="color:red;">*</span></label>
                                                    <select class="form-control  select-customer"  name="customer_id" id="customer_id">
                                                        @foreach($customers as $customer)
                                                            <option {{ (isset($deposit->customer_id) && $deposit->customer_id == $customer->id) ? "selected" : ""  }} value="{{ $customer->id }}">{{ $customer->firstname }} {{ $customer->lastname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label>Date <span  style="color:red;">*</span></label>
                                                    <input type="text" value="{{ old('deposit_date', (isset($deposit->deposit_date) ? date('Y-m-d',strtotime($deposit->deposit_date)) : date('Y-m-d'))) }}" required  value="{{ date('Y-m-d') }}" data-min-view="2" data-date-format="yyyy-mm-dd" class="form-control datepicker js-datepicker" id="invoice_date" name="deposit_date" placeholder="Date"/>
                                                    @if ($errors->has('deposit_date'))
                                                        <label for="name-error" class="error"
                                                               style="display: inline-block;">{{ $errors->first('deposit_date') }}</label>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Amount <span  style="color:red;">*</span></label>
                                                    <input type="text" id="total_amount_paid" value="{{ old('amount',$deposit->amount) }}" required  class="form-control" name="amount" placeholder="Amount"/>
                                                    @if ($errors->has('amount'))
                                                        <label for="name-error" class="error"
                                                               style="display: inline-block;">{{ $errors->first('amount') }}</label>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label>Description / Purpose <span  style="color:red;">*</span></label>
                                                    <textarea class="form-control" style="height: 100px" required name="description">{{ old('purpose',$deposit->description) }}</textarea>
                                                    @if ($errors->has('description'))
                                                        <label for="name-error" class="error"
                                                               style="display: inline-block;">{{ $errors->first('description') }}</label>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Payment Method</label>
                                                    <select class="form-control" name="payment_method_id" id="payment_method">
                                                        <option value="">Select Payment Method</option>
                                                        @foreach($payments as $payment)
                                                            <option  {{ (isset($deposit->payment_method_id) && $deposit->payment_method_id == $payment->id) ? "selected" : ""  }}  data-label="{{ strtolower( $payment->name) }}"  value="{{  $payment->id }}">{{  $payment->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div id="more_info_appender">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <center> <input class="btn btn-info btn-sm" type="submit" name="save" value="Save Deposit"></center>
                                        </div>
                                    </form>
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
    <script>

        function getPaymentInfo(){
            if($('#payment_method').val() === ""){
                alert("Please enter payment Information to complete invoice");
                return false;
            }

            if($('#payment_method').val() == "1"){
                if($('#cash_tendered').val() == ""){
                    alert("Please enter cash tendered by customer");
                    return false;
                }
                return {
                    'cash_tendered':$('#cash_tendered').val(),
                    'customer_change':$('#customer_change').html(),
                    'payment_method_id' : 1
                };
            }else if($('#payment_method').val() == "2"){
                if( $('#bank').val() === ""){
                    alert("Please select bank");
                    return false;
                }
                return {
                    'payment_method_id' : 2,
                    'bank_id' : $('#bank').val(),
                }

            }else if($('#payment_method').val() == "3"){
                if( $('#bank').val() === ""){
                    alert("Please select bank");
                    return false;
                }
                return {
                    'payment_method_id' : 3,
                    'bank_id' : $('#bank').val(),
                }

            }


            return false;
        }

        $(document).ready(function(){
            $("#payment_method").on("change",function () {
                if($(this).val() !=="") {
                    var selected = $("#payment_method option:selected").attr("data-label");
                    selected = selected.toLowerCase();
                    if (selected === "transfer") {
                        $("#payment_btn").removeAttr("disabled");
                        $("#more_info_appender").html('<div id="transfer"><div class="form-group"> <label>Bank</label> <select class="form-control" required id="bank" name="payment_info[bank]"><option value="">-Select Bank-</option> @foreach($banks as $bank)<option value="{{ $bank->id }}">{{ $bank->account_number }} - {{ $bank->bank->name }}</option> @endforeach </select></div></div>')
                    } else if (selected === "cash") {
                        $("#payment_btn").removeAttr("disabled");
                        $("#more_info_appender").html('<div id="cash"> <br/><div class="form-group"> <label>Cash Tendered</label> <input class="form-control" type="number" step="0.00001" id="cash_tendered" name="payment_info[cash_tendered]" required placeholder="Cash Tendered"/></div><div class="form-group well"><center>Customer Change</center><h1 align="center" style="font-size: 55px; margin: 0; padding: 0 font-weight: bold;" id="customer_change">0.00</h1></div></div>')
                        handle_cash();
                    } else if (selected === "pos") {
                        $("#payment_btn").removeAttr("disabled");
                        $("#more_info_appender").html('<div class="form-group"> <label>Bank</label> <select class="form-control" required id="bank" name="payment_info[bank]"><option value="">-Select POS Bank-</option> @foreach($banks as $bank)<option value="{{ $bank->id }}">{{ $bank->account_number }} - {{ $bank->bank->name }}</option> @endforeach </select></div>')
                    } else if (selected === "split_method") {
                        $("#more_info_appender").html('<div id="split_method"> <br/><h5>MULTIPLE PAYMENT METHOD</h5><table class="table table-striped"> @foreach($payments as $pmthod) @if($pmthod->id==4 && config('app.store') == "inventory") @continue @endif<tr><td style="font-size: 15px;">{{ ucwords($pmthod->name) }}</td><td class="text-right" align="right"><input value="0" step="0.00001" required class="form-control pull-right split_control" style="width: 100px;" type="number" data-key="{{ $pmthod->id }}" name="split_method[{{ $pmthod->id }}]"</td><td>@if($pmthod->id != 4 && $pmthod->id!=1)<select class="form-control" name="payment_info_data[{{ $pmthod->id }}]" id="bank_id_{{ $pmthod->id }}"><option value="">Select Bank</option> @foreach($banks as $bank)<option value="{{ $bank->id }}">{{ $bank->account_number }} - {{ $bank->bank->name }}</option> @endforeach </select>@endif @if($pmthod->id==1) <input type="hidden" value="CASH" name="payment_info_data[{{ $pmthod->id }}]"/> @endif</td></tr> @endforeach<tr><th style="font-size: 15px;" colspan="2">Total</th><th class="text-right" id="total_split" style="font-size: 26px;">0.00</th></tr></table></div>')
                        handle_split_method();
                    }else{
                        $("#payment_btn").removeAttr("disabled");
                        $("#more_info_appender").html('')
                    }
                }else{
                    $("#payment_btn").removeAttr("disabled");
                    $("#more_info_appender").html("");
                }
            });

            function handle_cash(){
                $("#payment_btn").removeAttr("disabled");
                $("#cash_tendered").on("keyup",function(){
                    if($(this).val() !="") {
                        var val = parseFloat($(this).val());
                        if (val > 0) {
                            var change = val - parseInt($('#total_amount_paid').val());
                            $("#customer_change").html(formatMoney(change));
                        }
                    }else{
                        $("#customer_change").html("{{ number_format(0,2) }}");
                    }
                })
            }




        });
    </script>
@endpush

