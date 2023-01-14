<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>">

    <link href="<?php echo e(asset('bower_components/datatables/media/css/jquery.dataTables.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/datatables-colvis/css/dataTables.colVis.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/datatables-responsive/css/responsive.dataTables.scss')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('bower_components/datatables-scroller/css/scroller.dataTables.scss')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui-container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo e($title); ?>

                    </header>
                    <div class="panel-body">
                        <?php if(session('success')): ?>
                            <?php echo alert_success(session('success')); ?>

                        <?php elseif(session('error')): ?>
                            <?php echo alert_error(session('error')); ?>

                        <?php endif; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Customer</label>
                                <select class="form-control select-customer" required name="customer_id">
                                    <option value="">Select Customer</option>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->firstname); ?> <?php echo e($customer->lastname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Payment Method</label>
                                <select class="form-control" required name="payment_method" id="payment_method">
                                    <option value="">Select Payment Method</option>
                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option  data-label="<?php echo e(strtolower( $payment->name)); ?>"  value="<?php echo e($payment->id); ?>"><?php echo e($payment->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <!--<option data-label="split_method" value="split_method">Multiple Payment Method</option>-->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Amount Paid</label>
                                <input type="number" required id="total_paid" placeholder="Amount Paid" class="form-control" name="amount"/>
                            </div>

                            <div class="form-group">
                                <label>Payment Date</label>
                                <input type="text"  required class="form-control datepicker js-datepicker" value="<?php echo e(date('Y-m-d',strtotime(date('Y-m-d')))); ?>" data-min-view="2" data-date-format="yyyy-mm-dd" style="background-color: #FFF; color: #000;"   name="payment_date" placeholder="Payment Date"/>
                            </div>

                            <div id="more_info_appender">
                            </div>

                            <button type="submit" class="btn btn-primary text-center"><i class="fa fa-save"></i> Add Payment</button>

                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>
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
                        $("#more_info_appender").html('<div id="split_method"> <br/><h5>MULTIPLE PAYMENT METHOD</h5><table class="table table-striped"> <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmthod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <tr><td style="font-size: 15px;"><?php echo e(ucwords($pmthod->name)); ?></td><td class="text-right" align="right"><input value="0" step="0.00001" required class="form-control pull-right split_control" style="width: 100px;" type="number" data-key="<?php echo e($pmthod->id); ?>" name="split_method[<?php echo e($pmthod->id); ?>]"</td><td><?php if($pmthod->id != 4 && $pmthod->id!=1): ?><select class="form-control" id="bank_id_<?php echo e($pmthod->id); ?>"><option value="">Select Bank</option> <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($bank->id); ?>"><?php echo e($bank->account_number); ?> - <?php echo e($bank->bank->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select><?php endif; ?></td></tr> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><tr><th style="font-size: 15px;" colspan="2">Total</th><th class="text-right" id="total_split" style="font-size: 26px;">0.00</th></tr></table></div>')
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
                            var change = val - (parseFloat($('#total_paid').val()));
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


        });
    </script>
<?php $__env->stopPush(); ?>


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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/customermanager/add_payment.blade.php ENDPATH**/ ?>