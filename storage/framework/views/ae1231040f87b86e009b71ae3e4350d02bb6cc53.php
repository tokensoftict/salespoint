<?php $__env->startSection('content'); ?>

    <div class="ui-container">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo e($title."- Invoice ".$invoice->id); ?>

                        <span class="pull-right">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$invoice)): ?>
                                <a href="<?php echo e(route('invoiceandsales.edit',$invoice->id)); ?>"  class="btn btn-success btn-sm" ><i class="fa fa-pencil"></i> Edit Invoice</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('approve',$invoice)): ?>
                                <a  data-msg="Are you sure, you want to approve this Invoice, the is can not be reversed ?" href="<?php echo e(route('invoiceandsales.approve',$invoice->id)); ?>"  class="confirm_action btn btn-primary btn-sm" ><i class="fa fa-check"></i> Approve Invoice</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('decline',$invoice)): ?>
                                <a  data-msg="Are you sure, you want to decline this Invoice, the is can not be reversed ?" href="<?php echo e(route('invoiceandsales.decline',$invoice->id)); ?>"  class="confirm_action btn btn-danger btn-sm" ><i class="fa fa-trash"></i> Decline Invoice</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('draftInvoice',$invoice)): ?>
                                <a  data-msg="Are you sure, you want to change the status of this invoice to draft, the is can not be reversed ?" href="<?php echo e(route('invoiceandsales.send_draft_invoice',$invoice->id)); ?>"  class="confirm_action btn btn-danger btn-sm" ><i class="fa fa-trash"></i> Send Back To Draft</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print',$invoice)): ?>
                                <a href="<?php echo e(route('invoiceandsales.pos_print',$invoice->id)); ?>" onclick="return open_print_window(this);" class="btn btn-success btn-sm" ><i class="fa fa-file"></i> Print POS</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print',$invoice)): ?>
                                <a href="<?php echo e(route('invoiceandsales.print_afour',$invoice->id)); ?>"  onclick="return open_print_window(this);" class="btn btn-info btn-sm" ><i class="fa fa-print"></i> Print A4</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print',$invoice)): ?>
                                <a  href="<?php echo e(route('invoiceandsales.print_way_bill',$invoice->id)); ?>"  onclick="return open_print_window(this);" class="btn btn-primary btn-sm" ><i class="fa fa-print"></i> Print Waybill</a>
                            <?php endif; ?>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <?php if(session('success')): ?>
                                <?php echo alert_success(session('success')); ?>

                            <?php elseif(session('error')): ?>
                                <?php echo alert_error(session('error')); ?>

                            <?php endif; ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h2>Bill To</h2>
                                    <div class="form-group">
                                        <strong>Customer Information:</strong><br>
                                        <div id="customer_info">
                                            <address>
                                                <?php echo e($invoice->customer->firstname); ?> <?php echo e($invoice->customer->lastname); ?><br>
                                                <?php if(!empty($invoice->customer->address)): ?>
                                                    <?php echo e($invoice->customer->address); ?><br>
                                                <?php endif; ?>
                                                <?php if(!empty($invoice->customer->email)): ?>
                                                    <?php echo e($invoice->customer->email); ?><br>
                                                <?php endif; ?>
                                                <?php echo e($invoice->customer->phone_number); ?>

                                            </address>
                                        </div>
                                    </div>
                                    <h2>Invoice Property</h2>
                                    <div class="form-group">
                                        <label style="font-size: 12px">Invoice / Receipt Number</label><br/>
                                        <label style="font-size: 15px"><?php echo e($invoice->invoice_paper_number); ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 12px">Status</label><br/>
                                        <label style="font-size: 15px"><?php echo invoice_status($invoice->status); ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 12px">Invoice Date</label><br/>
                                        <label style="font-size: 15px"> <?php echo e(convert_date($invoice->invoice_date)); ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 12px">Time</label><br/>
                                        <label style="font-size: 15px"> <?php echo e(date("h:i a",strtotime($invoice->sales_time))); ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 12px">Sales Representative</label><br/>
                                        <label style="font-size: 15px"><?php echo e($invoice->created_user->name); ?></label>
                                    </div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pay',$invoice)): ?>
                                        <hr/>
                                        <h3>Complete Invoice</h3>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Payment Method</label>
                                            <select class="form-control" name="payment_method_id" required id="payment_method">
                                                <option value="">Select Payment Method</option>
                                                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($invoice->customer_id ==1 && strtolower( $payment->name)=="credit"): ?>
                                                        <?php continue; ?>
                                                    <?php endif; ?>
                                                    <option  data-label="<?php echo e(strtolower( $payment->name)); ?>"  value="<?php echo e($payment->id); ?>"><?php echo e($payment->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <option  data-label="split_method"  value="split_method">MULTIPLE PAYMENT METHOD</option>
                                            </select>
                                        </div>
                                        <div id="more_info_appender">
                                        </div>
                                        <form action="<?php echo e(route('invoiceandsales.complete_invoice_no_edit',$invoice->id)); ?>" method="post" id="complete_payment">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="payment" id="payment_holder">
                                            <input type="hidden" name="payment" value="<?php echo e($invoice->customer_id); ?>" id="customer_id">
                                            <button type="submit" id="payment_btn"  class="btn btn-primary text-center"><i class="fa fa-save"></i> Complete Invoice</button>
                                        </form>

                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <br/>
                                            <h2>Invoice Item(s)</h2>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td align="left"><b>Name</b></td>
                                                        <td align="center"><b>Quantity</b></td>
                                                        <td align="center"><b>Cost Price</b></td>
                                                        <td align="center"><b>Price</b></td>
                                                        <td align="right"><b>Total Selling</b></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $invoice->invoice_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($loop->iteration); ?></td>
                                                            <td align="left" class="text-left"><?php echo e($item->stock->name); ?></td>
                                                            <td align="center" class="text-center"><?php echo e($item->quantity); ?></td>
                                                            <td align="center" class="text-center"><?php echo e(number_format($item->stock->cost_price,2)); ?></td>
                                                            <td align="center" class="text-center"><?php echo e(number_format($item->selling_price,2)); ?></td>
                                                            <td align="right" class="text-right"><?php echo e(number_format(($item->total_selling_price),2)); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td  align="right" class="text-right">Sub Total</td>
                                                        <td  align="right" class="text-right"><?php echo e(number_format($invoice->sub_total,2)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td  align="right" class="text-right">Total</td>
                                                        <td  align="right" class="text-right"><b><?php echo e(number_format(($invoice->sub_total -$invoice->discount_amount),2)); ?></b></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
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

            }else if($('#payment_method').val() === "3"){
                if( $('#bank').val() === ""){
                    alert("Please select bank");
                    return false;
                }
                return {
                    'payment_method_id' : 3,
                    'bank_id' : $('#bank').val(),
                }

            }else if($('#payment_method').val() === "5"){

                if($('#customer_id').val() === "1")
                {
                    alert("Deposit and Credit Payment is not available for Generic Customer");
                    return false;
                }
                else {
                    return {
                        'payment_method_id' : 5,
                    }
                }

            }else if($('#payment_method').val() === "split_method"){
                let data = [];
                let payment_info_data = [];
                let total = 0;
                let error = false;
                $('.split_control').each(function(){

                    <?php if(config('app.store') == "hotel"): ?>

                    if($(this).attr('data-key') == "4" &&  parseFloat($(this).val()) > 0 && $('#customer_id').val() === "1"){
                        alert("Deposit and Credit Payment is not available for Generic Customer");
                        error = true;
                        return false;
                    }

                    <?php elseif(config('app.store') == "inventory"): ?>

                    if(getTotalSplitPayemnt() !== calculateTotal() && $('#customer_id').val() === "1")
                    {
                        alert("Deposit and Credit Payment is not available for Generic Customer");
                        error = true;
                        return false;
                    }

                    <?php endif; ?>


                        data[$(this).attr('data-key')] = $(this).val();

                    payment_info_data[$(this).attr('data-key')] = {};

                    if($(this).attr('data-key') == "3"){
                        if( $('#bank_id_3').val() === "" &&  parseFloat($(this).val()) > 0){
                            alert("Please select Transfer Bank");
                            $('#bank_id_3').focus();
                            error = true;
                            return false;
                        }
                        payment_info_data[$(this).attr('data-key')] = {
                            'payment_method_id' : 3,
                            'bank_id' : $('#bank_id_3').val(),
                        }
                    }else if($(this).attr('data-key') == "2"){
                        if( $('#bank_id_2').val() === "" &&  parseFloat($(this).val()) > 0){
                            alert("Please select POS Bank");
                            $('#bank_id_2').focus();
                            error = true;
                            return false;
                        }
                        payment_info_data[$(this).attr('data-key')] = {
                            'payment_method_id' : 3,
                            'bank_id' : $('#bank_id_2').val(),
                        }
                    }else if($(this).attr('data-key') == "1"){
                        payment_info_data[$(this).attr('data-key')] = {
                            'payment_method_id' : 1,
                            'method' : "cash",
                        }
                    }else if($(this).attr('data-key') == "4"){
                        payment_info_data[$(this).attr('data-key')] = {
                            'payment_method_id' : 4,
                            'credit' : "credit"
                        }
                    }
                    else if($(this).attr('data-key') == "5" &&  parseFloat($(this).val()) > 0 && $('#customer_id').val() === "1"){

                        if($('#customer_id').val() === "1")
                        {
                            alert("Deposit and Credit Payment is not available for Generic Customer");
                            error = true;
                            return false;
                        }
                        else
                        {
                            payment_info_data[$(this).attr('data-key')] = {
                                'payment_method_id' : 5,
                            }
                        }
                    }

                    total+=parseFloat($(this).val());
                });
                if( error === true){
                    return false;
                }

                if(total > calculateTotal()){
                    alert("Total Invoice Payment can not be greater than invoice total, please check");
                    return false;
                }

                return {
                    'split_method':data,
                    'payment_method_id':$('#payment_method').val(),
                    'payment_info_data' : payment_info_data
                };

            }else if($('#payment_method').val() ==="4")
            {
                if($('#customer_id').val() === "1"){
                    alert("Deposit and Credit Payment is not available for Generic Customer");
                    return false;
                }

                return {
                    'payment_method_id' : 4,
                    'credit' : "credit"
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
                        $("#more_info_appender").html('<div id="transfer"><div class="form-group"> <label>Bank</label> <select class="form-control" required id="bank" name="bank"><option value="">-Select Bank-</option> <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($bank->id); ?>"><?php echo e($bank->account_number); ?> - <?php echo e($bank->bank->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></div></div>')
                    } else if (selected === "cash") {
                        $("#more_info_appender").html('<div id="cash"> <br/><div class="form-group"> <label>Cash Tendered</label> <input class="form-control" type="number" step="0.00001" id="cash_tendered" name="cash_tendered" required placeholder="Cash Tendered"/></div><div class="form-group well"><center>Customer Change</center><h1 align="center" style="font-size: 55px; margin: 0; padding: 0 font-weight: bold;" id="customer_change">0.00</h1></div></div>')
                        handle_cash();
                    } else if (selected === "pos") {
                        $("#more_info_appender").html('<div class="form-group"> <label>Bank</label> <select class="form-control" required id="bank" name="bank"><option value="">-Select POS Bank-</option> <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($bank->id); ?>"><?php echo e($bank->account_number); ?> - <?php echo e($bank->bank->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></div>')
                    } else if (selected === "split_method") {
                        $("#more_info_appender").html('<div id="split_method"> <br/><h5>MULTIPLE PAYMENT METHOD</h5><table class="table table-striped"> <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmthod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($pmthod->id==4 && config('app.store') == "inventory"): ?> <?php continue; ?> <?php endif; ?> <tr><td style="font-size: 15px;"><?php echo e(ucwords($pmthod->name)); ?></td><td class="text-right" align="right"><input value="0" step="0.00001" required class="form-control pull-right split_control" style="width: 100px;" type="number" data-key="<?php echo e($pmthod->id); ?>" name="split_method[<?php echo e($pmthod->id); ?>]"</td><td><?php if($pmthod->id != 4 && $pmthod->id!=1 && $pmthod->id!=5): ?><select class="form-control" id="bank_id_<?php echo e($pmthod->id); ?>"><option value="">Select Bank</option> <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($bank->id); ?>"><?php echo e($bank->account_number); ?> - <?php echo e($bank->bank->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select><?php endif; ?></td></tr> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><tr><th style="font-size: 15px;" colspan="2">Total</th><th class="text-right" id="total_split" style="font-size: 26px;">0.00</th></tr></table></div>')
                        handle_split_method();
                    }else{
                        $("#more_info_appender").html('')
                    }
                }else{
                    $("#more_info_appender").html("");
                }
            });

            function handle_cash(){
                $("#cash_tendered").on("keyup",function(){
                    if($(this).val() !="") {
                        var val = parseFloat($(this).val());
                        if (val > 0) {
                            var change = val - calculateTotal() ;
                            $("#customer_change").html(formatMoney(change));
                        }
                    }else{
                        $("#customer_change").html("<?php echo e(number_format(0,2)); ?>");
                    }
                })
            }

            function handle_split_method(){
                $('.split_control').on("keyup",function(){
                    var total = 0;
                    $('.split_control').each(function(index,elem){
                        if($(elem).val() !="") {
                            total += parseFloat($(elem).val());
                        }
                    });
                    $("#total_split").html(formatMoney(total));
                    if(total == calculateTotal()){
                        $("#payment_btn").removeAttr("disabled");
                    }else{
                        $("#payment_btn").removeAttr("disabled");
                    }
                })

            }

            $("#complete_payment").on("submit",function(e){
                e.preventDefault();

                const payment = getPaymentInfo();

                if(payment === false) return "Unknown error occurred, please reload the page";

                showMask('Completing Invoice, Please wait...');

                var timeout = setTimeout(function(){
                    hideMask();
                    alert('error - request timeout, please refresh and try again');
                    $('.submit_btn').removeAttr('disabled');
                },61000);

                $.ajax({
                    url: $(this).attr("action"),
                    method : 'POST',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "payment":payment
                    },
                    success: function(returnData){
                        hideMask();
                        clearTimeout(timeout);
                        if(returnData.status == true)
                        {
                            window.location.reload();
                            alert("Invoice completed successful");
                        }
                        else
                        {
                            alert(returnData.error);
                        }
                    },
                    error: function(xhr, status, error){
                        hideMask();
                        clearTimeout(timeout);
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                        hideMask();
                    }
                });

            });

        });


        function getTotalSplitPayemnt(){
            let total =0;
            $('.split_control').each(function(){
                total+= parseFloat($(this).val());
            })
            return total;
        }

        function calculateTotal(){
            return <?php echo e($invoice->sub_total); ?>

        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/invoice/view.blade.php ENDPATH**/ ?>