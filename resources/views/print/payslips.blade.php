<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ getStoreSettings()->name }} - Payslips</title>
    <style>
        #payslip {
            font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        div.clear {
            clear: both;
            margin: 8px 0;
        }
        div.pull-left {
            float: left;
            margin-right: 15px;
        }
        p.small {
            font-size: 8px;
        }
        #payslip table {
            width: 100%;
            margin-bottom: 8px;
            font-size: 11px;
        }

        #payslip th, #payslip td {
            padding: 3px 6px
        }

        #payslip tr.heading {
            background: #e4eaf2;
        }
        #payslip tr.total {
            background: rgba(236, 151, 31, 0.25)
        }
        div.title h3 {
            font-family: Verdana, Helvetica, "Gill Sans", sans-serifr;
        }
    </style>
</head>
<body onload="window.print()">
<div class="row" id="payslip">
    <div class="clear">
        <div class="pull-left">
            <img src="{{ $payslip->employee->image }}" width="150px">

        </div>
        <div class="title">
            <h3>{{ getStoreSettings()->name }}
            </h3>
            <h4>PAYSLIP</h4>
        </div>
        <p class="small">{!! softwareStampWithDate() !!}</p>
    </div>
    <div class="clear">
        <h2>{{ $payslip->employee->full_name }}</h2>
        <table class="table">
            <tr>
                <th>Period:</th>
                <td>{{ $period->period_date }}</td>
                <th>Basic Salary:</th>
                <td>{{ number_format($payslip->employee->salary,2) }}</td>
            </tr>

            <tr>
                <th>Bank:</th>
                <td>{{ $payslip->employee->bank->name }}</td>
                <th>Designation</th>
                <td>{{ $payslip->designation->name ?? "" }}</td>
            </tr>
            <tr>
                <th>Account Number:</th>
                <td>{{ $payslip->employee->bank_account_no }}</td>
                <th>Rank:</th>
                <td>{{ $payslip->rank->name ?? "" }}</td>
            </tr>
        </table>
        <table class="table">
            <tr class="heading">
                <th colspan="3">PAY ITEMS</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Pay Item</th>
                <th style="text-align:right"> Amount (N)</th>
            </tr>
            @foreach($payslip->payslips_items as $item)
                @if( $item->item_type == "1")
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->payable->name ?? "" }} {{ $item->payable->allowance->name ?? "" }}</td>
                    <td style="text-align:right">{{ number_format($item->amount,2) }}</td>
                </tr>
                @endif
            @endforeach

            <tr class="total">
                <th style="text-align:right"></th>
                <th style="text-align: right">Gross Pay</th>
                <th style="text-align: right">{{ number_format($payslip->gross_pay,2) }}</th>
            </tr>
            <tr class="heading">
                <th colspan="3">DEDUCTIONS</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Deduction</th>
                <th style="text-align:right">Total Amount (N)</th>
            </tr>
            @foreach($payslip->payslips_items as $item)
                @if( $item->item_type == "2")
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: center">{{ $item->payable->name ?? "" }} {{ $item->payable->allowance->name ?? "" }}</td>
                        <td style="text-align:right">{{ number_format($item->amount,2) }}</td>
                    </tr>
                @endif
            @endforeach
            <tr class="total">
                <th></th>
                <th  style="text-align: right">Total Deductions</th>
                <th style="text-align: right">{{ number_format($payslip->total_deduction,2) }}</th>
            </tr>
            <tr class="heading">
                <th colspan="3">NET PAY</th>
            </tr>
            <tr class="total">
                <th style="text-align:right"></th>
                <th  style="text-align:right">Net Pay</th>
                <th style="text-align: right">{{ number_format($payslip->net_pay,2) }}</th>
            </tr>
        </table>
    </div>
</div>
</body>
</html>


