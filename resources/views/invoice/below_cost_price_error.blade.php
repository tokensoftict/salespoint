<div class="col-sm-12">
    <br/>
    <h3 class="text-muted text-primary text-center">Some Item price in the invoice are below/equal to the cost price !</h3>
    <br/>
    <table class="table table-hover table-bordered">
        <thead>
            <th>#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Selling Price</th>
            <th class="text-center">Current Cost Price</th>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td >{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $report['name'] }}</td>
                    <td class="text-center">{{ number_format($report['selling_price'],2) }}</td>
                    <td class="text-center">{{ number_format($report['cost_price'],2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
            <div class="col-md-6">
                <a href="#" onclick="submitInvoiceForApproval(this)" class="btn btn-success btn-lg btn-block">Submit Invoice for Approval <i class="fa fa-check"></i> </a>
            </div>
            <div class="col-md-6">
                <a href="#" onclick="return adjustInvoice();" class="btn btn-primary btn-lg btn-block">Cancel & Adjust Invoice <i class="fa fa-cancel"></i></a>
            </div>

    </div>

    <br/>
</div>

