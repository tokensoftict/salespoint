<table class="table table-bordered table-responsive table convert-data-table table-striped" style="font-size: 12px">
    <thead>
    <tr>
        <th>#</th>
        <th>Invoice/Receipt No</th>
        <th>Customer</th>
        <th>Status</th>
        <th>Sub Total</th>
        <th>Total Paid</th>
        <th>Date</th>
        <th>Time</th>
        <th>By</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @php
        $total = 0;
    @endphp
    @foreach($invoices as $invoice)
        @php
            $total += $invoice->total_amount_paid;
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $invoice->invoice_paper_number }}</td>
            <td>{{ $invoice->customer->firstname }} {{ $invoice->customer->lastname }}</td>
            <td>{!! invoice_status($invoice->status) !!}</td>
            <td>{{ number_format($invoice->sub_total,2) }}</td>
            <td>{{ number_format($invoice->total_amount_paid,2) }}</td>
            <td>{{ convert_date2($invoice->invoice_date) }}</td>
            <td>{{ $invoice->sales_time }}</td>
            <td>{{ $invoice->created_user->name }}</td>
            <td>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu">

                        @can('view', $invoice)
                            <li><a href="{{ route('invoiceandsales.view',$invoice->id) }}">View Invoice</a></li>
                        @endcan

                        @can('update',$invoice)
                            <li><a href="{{ route('invoiceandsales.edit',$invoice->id) }}">Edit Invoice</a></li>
                        @endcan

                        @can('delete',$invoice)
                            <li><a href="{{ route('invoiceandsales.destroy',$invoice->id) }}">Delete Invoice</a></li>
                        @endcan

                        @can('approve',$invoice)
                            <li><a class="confirm_action" data-msg="Are you sure, you want to approve this Invoice, the is can not be reversed ?" href="{{ route('invoiceandsales.approve',$invoice->id) }}">Approve Invoice</a></li>
                        @endcan

                        @can('decline',$invoice)
                            <li><a class="confirm_action" data-msg="Are you sure, you want to decline this Invoice, the is can not be reversed ?" href="{{ route('invoiceandsales.approve',$invoice->id) }}">Decline Invoice</a></li>
                        @endcan
                        @can('draftInvoice',$invoice)
                            <li><a class="confirm_action" data-msg="Are you sure, you want to decline this Invoice, the is can not be reversed ?" href="{{ route('invoiceandsales.send_draft_invoice',$invoice->id) }}">Send Back To Draft</a></li>
                        @endcan

                        @can('print',$invoice)
                            <li><a onclick="open_print_window(this); return false" href="{{ route('invoiceandsales.pos_print',$invoice->id) }}">Print Invoice Pos</a></li>
                        @endcan

                        @can('print',$invoice)
                            <li><a onclick="open_print_window(this); return false" href="{{ route('invoiceandsales.print_afour',$invoice->id) }}">Print Invoice A4</a></li>
                        @endcan

                        @can('print',$invoice)
                            <li><a onclick="open_print_window(this); return false" href="{{ route('invoiceandsales.print_way_bill',$invoice->id) }}">Print Waybill</a></li>
                        @endcan
                    </ul>
                </div>
            </td>
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
        <th></th>
    </tr>
    </tfoot>
</table>
