<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Invoice #{{ $invoice->id }}</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-size: 8pt;
            background-color: #fff;
        }

        #products {
            width: 100%;
        }

        #products tr td {
            font-size: 7pt;
        }

        #printbox {
            width: 80mm;
            margin: 5pt;
            padding: 5px;
            text-align: justify;
        }

        .inv_info tr td {
            padding-right: 14pt;
        }

        .product_row {
            margin: 13pt;
        }

        .stamp {
            margin: 5pt;
            padding: 3pt;
            border: 3pt solid #111;
            text-align: center;
            font-size: 20pt;
            color:#000;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<h3 id="logo" class="text-center"><br><img style="max-height:30px;" src="{{ public_path("img/". $store->logo) }}" alt='Logo'></h3>
<div id="printbox">
    <h2 style="margin:-2px;padding: 0px" class="text-center">{{ $store->name}}</h2>
    <div align="center" >
        {{ $store->first_address }}
        @if(!empty($store->second_address))
            <br/>
            {{ $store->second_address }}
        @endif
        @if(!empty($store->contact_number))
            <br/>
            {{ $store->contact_number }}
        @endif
    </div>
    <table class="inv_info">
        <tr>
            <td>Invoice / Receipt No</td>
            <td>{{ $invoice->invoice_paper_number }}</td>
        </tr>
        <tr>
            <td>Invoice Number</td>
            <td>{{ $invoice->invoice_number }}</td>
        </tr>
        <tr>
            <td>Store</td>
            <td>{{ $invoice->warehousestore->name }}</td>
        </tr>
        <tr>
            <td>Invoice Date</td>
            <td>{{ convert_date2($invoice->invoice_date)  }}</td>
        </tr>
        <tr>
            <td>Customer</td>
            <td>{{ $invoice->customer->firstname }} {{ $invoice->customer->lastname }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>{{ $invoice->status }}</td>
        </tr>
        @if($invoice->status === "COMPLETE")
        <tr>
            <td>Mode of Payment</td>
            <td>
                @if($invoice->paymentMethodTable->count() > 1)
                    @php
                        $methods = [];
                    @endphp

                    @foreach($invoice->paymentMethodTable as $meth)
                        @php
                            echo  $meth->payment_method->name." : ". number_format( $meth->amount,2)."<br/>";
                        @endphp
                    @endforeach


                @else
                   {{ $invoice->paymentMethodTable->first()->payment_method->name  }} : {{ number_format($invoice->paymentMethodTable->first()->amount,2) }}
                @endif
            </td>
        </tr>
        @endif
        <tr>
            <td>Credit Balance</td>
            <td>{{ number_format($invoice->customer->credit_balance,2) }}</td>
        </tr>
    </table>
    <hr>
    <table id="products">
        <tr class="product_row">
            <td>#</td>
            <td align="left"><b>Name</b></td>
            <td align="center"><b>Quantity</b></td>
            <td align="center"><b>Price</b></td>
            <td align="right"><b>Total</b></td>
        </tr>
        <tr>
            <td colspan="5">
                <hr>
            </td>
        </tr>
        <tbody id="appender">
        @foreach($invoice->invoice_items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td align="left" class="text-left">{{ $item->stock->name }}</td>
                <td align="center" class="text-center">{{ $item->quantity }}</td>
                <td align="center" class="text-center">{{ number_format($item->selling_price,2) }}</td>
                <td align="right" class="text-right">{{ number_format(($item->total_selling_price),2) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">Sub Total</td>
            <td class="text-right">{{ number_format($invoice->sub_total,2) }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td  align="right" class="text-right">Total</td>
            <td  align="right" class="text-right"><b>{{ number_format(($invoice->sub_total),2) }}</b></td>
        </tr>
        @if(isset($invoice->paymentMethodTable->first()->payment_method_id) && $invoice->paymentMethodTable->first()->payment_method_id == "1")
            @php
                $method = json_decode($invoice->paymentMethodTable->first()->payment_info);
            @endphp

            @if(isset( $method-> customer_change))
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td  align="right" class="text-right">Change</td>
            <td  align="right" class="text-right"><b>{{ number_format(($method-> customer_change),2) }}</b></td>
        </tr>
        @endif
        @endif
        </tfoot>
    </table>
    <hr>
    <div class="text-center">  {{ $store->footer_notes }}</div>
    <div class="text-center"> {!! softwareStampWithDate() !!}</div>
</div>
</body>
</html>

