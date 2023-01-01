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
    <?php
        $tt_payment =0;
        $tt_expenses = 0;
    ?>
    <div class="ui-container">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo e($title); ?>

                        <form action=""  class="tools pull-right" style="margin-right: 80px" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label>From</label>
                                    <input type="text" class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-dd" style="background-color: #FFF; color: #000;"  value="<?php echo e($from); ?>" name="from" placeholder="From"/>
                                </div>
                                <div class="col-sm-4">
                                    <label>To</label>
                                    <input type="text" class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-dd" style="background-color: #FFF; color: #000;"  value="<?php echo e($to); ?>" name="to" placeholder="TO"/>
                                </div>
                                <div class="col-sm-2"><br/>
                                    <button type="submit" style="margin-top: 5px;" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                    </header>
                    <div class="panel-body">
                        <?php if(session('success')): ?>
                            <?php echo alert_success(session('success')); ?>

                        <?php elseif(session('error')): ?>
                            <?php echo alert_error(session('error')); ?>

                        <?php endif; ?>
                        <br/> <br/> <br/>
                        <div class="col-sm-6">
                            <h3>Payment Report</h3>
                            <table class="table table-bordered table-responsive table convert-data-table table-striped" id="invoice-list" style="font-size: 12px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Invoice / Receipt Number</th>
                                    <th>Sub Total</th>
                                    <th>Total Paid</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total_=0;
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $total_+=$payment->amount;
                                        $tt_payment+=$payment->amount;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($payment->customer->firstname); ?> <?php echo e($payment->customer->lastname); ?></td>
                                        <td><?php echo e($payment->invoice->invoice_paper_number  ?? ""); ?></td>
                                        <td><?php echo e(number_format($payment->amount,2)); ?></td>
                                        <td><?php echo e(number_format($payment->amount,2)); ?></td>
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <?php endif; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th><?php echo e(number_format($total_,2)); ?></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <h3>Expenses Report</h3>
                            <table class="table table-bordered table-responsive table convert-data-table table-striped" style="font-size: 12px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>By</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Department</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total =0;
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $total +=$expense->amount;
                                        $tt_expenses+=$expense->amount;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($expense->user->name); ?></td>
                                        <td><?php echo e($expense->expenses_type->name); ?></td>
                                        <td><?php echo e(number_format($expense->amount,2)); ?></td>
                                        <td><?php echo e($expense->department); ?></td>
                                        <td><?php echo e(convert_date($expense->expense_date)); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <?php endif; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th><?php echo e(number_format($total,2)); ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-sm-6 col-sm-offset-6">
                            <h3>Analysis</h3>
                            <table class="table table-striped table-bordered dataTable" id="DataTables_Table_3">
                                <tbody><tr>
                                    <td>Total Sales</td>
                                    <th><?php echo e(number_format($tt_payment,2)); ?></th>
                                </tr>
                                <tr>
                                    <td>Total Expenses</td>
                                    <th> <?php echo e(number_format($tt_expenses,2)); ?></th>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <th style="font-size: 16px;"><?php echo e(number_format($tt_payment - $tt_expenses,2)); ?></th>
                                </tr>
                                </tbody></table>
                        </div>
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
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/paymentreport/income_analysis.blade.php ENDPATH**/ ?>