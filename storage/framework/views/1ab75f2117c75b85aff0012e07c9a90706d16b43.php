<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>">
    <link href="<?php echo e(asset('bower_components/datatables/media/css/jquery.dataTables.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/datatables-colvis/css/dataTables.colVis.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/datatables-responsive/css/responsive.dataTables.scss')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/datatables-scroller/css/scroller.dataTables.scss')); ?>" rel="stylesheet">
    <style>
        input {
            margin-bottom: 0 !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="ui-container">
        <div class="row">
            <div class="col-md-6 col-lg-offset-3">
                <section class="panel">
                    <?php if(session('success')): ?>
                        <?php echo alert_success(session('success')); ?>

                    <?php elseif(session('error')): ?>
                        <?php echo alert_error(session('error')); ?>

                    <?php endif; ?>
                    <div class="panel-heading">
                        <?php echo e($title); ?>

                    </div>
                    <div class="panel-body">
                        <?php if(isset($deposit->id)): ?>
                            <form  action="<?php echo e(route('deposits.update',$deposit->id)); ?>" enctype="multipart/form-data" method="post">
                                <?php echo e(method_field('PUT')); ?>

                                <?php else: ?>
                                    <form  action="<?php echo e(route('deposits.store')); ?>" enctype="multipart/form-data" method="post">
                                        <?php endif; ?>
                                        <div class="panel-body">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Select Customer <span  style="color:red;">*</span></label>
                                                    <select class="form-control  select-customer"  name="customer_id" id="customer_id">
                                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php echo e((isset($deposit->customer_id) && $deposit->customer_id == $customer->id) ? "selected" : ""); ?> value="<?php echo e($customer->id); ?>"><?php echo e($customer->firstname); ?> <?php echo e($customer->lastname); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label>Date <span  style="color:red;">*</span></label>
                                                    <input type="text" value="<?php echo e(old('deposit_date', (isset($deposit->deposit_date) ? date('Y-m-d',strtotime($deposit->deposit_date)) : date('Y-m-d')))); ?>" required  value="<?php echo e(date('Y-m-d')); ?>" data-min-view="2" data-date-format="yyyy-mm-dd" class="form-control datepicker js-datepicker" id="invoice_date" name="deposit_date" placeholder="Date"/>
                                                    <?php if($errors->has('deposit_date')): ?>
                                                        <label for="name-error" class="error"
                                                               style="display: inline-block;"><?php echo e($errors->first('deposit_date')); ?></label>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="form-group">
                                                    <label>Amount <span  style="color:red;">*</span></label>
                                                    <input type="text" id="total_amount_paid" value="<?php echo e(old('amount',$deposit->amount)); ?>" required  class="form-control" name="amount" placeholder="Amount"/>
                                                    <?php if($errors->has('amount')): ?>
                                                        <label for="name-error" class="error"
                                                               style="display: inline-block;"><?php echo e($errors->first('amount')); ?></label>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="form-group">
                                                    <label>Description / Purpose <span  style="color:red;">*</span></label>
                                                    <textarea class="form-control" style="height: 100px" required name="description"><?php echo e(old('purpose',$deposit->description)); ?></textarea>
                                                    <?php if($errors->has('description')): ?>
                                                        <label for="name-error" class="error"
                                                               style="display: inline-block;"><?php echo e($errors->first('description')); ?></label>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Payment Method</label>
                                                    <select class="form-control" required name="payment_info[payment_method_id]" id="payment_method">
                                                        <option value="">Select Payment Method</option>
                                                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option  <?php echo e((isset($deposit->payment_method_id) && $deposit->payment_method_id == $payment->id) ? "selected" : ""); ?>  data-label="<?php echo e(strtolower( $payment->name)); ?>"  value="<?php echo e($payment->id); ?>"><?php echo e($payment->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/select2/dist/js/select2.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('assets/js/init-select2.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables-colvis/js/dataTables.colVis.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables-responsive/js/dataTables.responsive.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables-scroller/js/dataTables.scroller.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/init-datatables.js')); ?>"></script>
    <script  src="<?php echo e(asset('assets/js/init-datepicker.js')); ?>"></script>
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
                        $("#more_info_appender").html('<div id="transfer"><div class="form-group"> <label>Bank</label> <select class="form-control" required id="bank" name="payment_info[bank_id]"><option value="">-Select Bank-</option> <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($bank->id); ?>"><?php echo e($bank->account_number); ?> - <?php echo e($bank->bank->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></div></div>')
                    } else if (selected === "cash") {
                        $("#payment_btn").removeAttr("disabled");
                        $("#more_info_appender").html('<div id="cash"> <br/><div class="form-group"> <label>Cash Tendered</label> <input class="form-control" type="number" step="0.00001" id="cash_tendered" name="payment_info[cash_tendered]" required placeholder="Cash Tendered"/></div><div class="form-group well"><center>Customer Change</center><h1 align="center" style="font-size: 55px; margin: 0; padding: 0 font-weight: bold;" id="customer_change">0.00</h1></div></div>')
                        handle_cash();
                    } else if (selected === "pos") {
                        $("#payment_btn").removeAttr("disabled");
                        $("#more_info_appender").html('<div class="form-group"> <label>Bank</label> <select class="form-control" required id="bank" name="payment_info[bank_id]"><option value="">-Select POS Bank-</option> <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($bank->id); ?>"><?php echo e($bank->account_number); ?> - <?php echo e($bank->bank->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></div>')
                    } else if (selected === "split_method") {
                        $("#more_info_appender").html('<div id="split_method"> <br/><h5>MULTIPLE PAYMENT METHOD</h5><table class="table table-striped"> <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmthod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($pmthod->id==4 && config('app.store') == "inventory"): ?> <?php continue; ?> <?php endif; ?><tr><td style="font-size: 15px;"><?php echo e(ucwords($pmthod->name)); ?></td><td class="text-right" align="right"><input value="0" step="0.00001" required class="form-control pull-right split_control" style="width: 100px;" type="number" data-key="<?php echo e($pmthod->id); ?>" name="split_method[<?php echo e($pmthod->id); ?>]"</td><td><?php if($pmthod->id != 4 && $pmthod->id!=1): ?><select class="form-control" name="payment_info_data[<?php echo e($pmthod->id); ?>]" id="bank_id_<?php echo e($pmthod->id); ?>"><option value="">Select Bank</option> <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($bank->id); ?>"><?php echo e($bank->account_number); ?> - <?php echo e($bank->bank->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select><?php endif; ?> <?php if($pmthod->id==1): ?> <input type="hidden" value="CASH" name="payment_info_data[<?php echo e($pmthod->id); ?>]"/> <?php endif; ?></td></tr> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><tr><th style="font-size: 15px;" colspan="2">Total</th><th class="text-right" id="total_split" style="font-size: 26px;">0.00</th></tr></table></div>')
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
                        $("#customer_change").html("<?php echo e(number_format(0,2)); ?>");
                    }
                })
            }




        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/deposit/new.blade.php ENDPATH**/ ?>