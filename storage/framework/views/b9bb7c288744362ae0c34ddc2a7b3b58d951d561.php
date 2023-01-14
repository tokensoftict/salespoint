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
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo e($title); ?>

                        <?php if (isset($component)) { $__componentOriginald48ec9886779f5f6a3bd2dbbf2ddffa743b39bbe = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\StoreSelector::class, []); ?>
<?php $component->withName('store-selector'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald48ec9886779f5f6a3bd2dbbf2ddffa743b39bbe)): ?>
<?php $component = $__componentOriginald48ec9886779f5f6a3bd2dbbf2ddffa743b39bbe; ?>
<?php unset($__componentOriginald48ec9886779f5f6a3bd2dbbf2ddffa743b39bbe); ?>
<?php endif; ?>
                        <form action=""  class="tools pull-right" style="margin-right: 80px" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-sm-8">
                                    <label>Date</label>
                                    <input type="text" class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-dd" style="background-color: #FFF; color: #000;"  value="<?php echo e($date); ?>" name="date" placeholder="From"/>
                                </div>
                                <div class="col-sm-3"><br/>
                                    <button type="submit" style="margin-top: 5px;" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                    </header>
                    <div class="panel-body">
                        <?php
                            $all_total=0;
                            $total_credit =0;
                        ?>
                        <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <h3><?php echo e($payment_method->name); ?> PAYMENTS</h3>
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
                                <?php
                                    $total=0;
                                ?>
                                    <?php $__currentLoopData = \App\Models\PaymentMethodTable::where('payment_method_id',$payment_method->id)->where('payment_date',$date)->where('warehousestore_id',getActiveStore()->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $total+=$payment->amount;
                                            $all_total+=$payment->amount;
                                            if($payment_method->id == 4) $total_credit+=$payment->amount;
                                        ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($payment->customer->firstname); ?> <?php echo e($payment->customer->lastname); ?></td>
                                            <td><?php echo e($payment->warehousestore->name); ?></td>
                                            <td><?php echo e($payment->payment_method->name); ?></td>
                                            <td><?php echo e($payment->invoice->invoice_paper_number ?? ""); ?></td>
                                            <td><?php echo e(number_format($payment->amount,2)); ?></td>
                                            <td><?php echo e(number_format($payment->amount,2)); ?></td>
                                            <td><?php echo e(date("h:i a",strtotime($payment->payment->payment_time))); ?></td>
                                            <td><?php echo e(convert_date($payment->payment->payment_date)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <table class="table">
                            <tr>
                            <th> <h2 class="pull-right">Total Payment : <?php echo e(number_format($all_total,2)); ?></h2></th>
                            </tr>
                            <tr>
                                <th> <h2 class="pull-right">Total Credit Payment : -<?php echo e(number_format($total_credit,2)); ?></h2></th>
                            </tr>
                            <tr>
                                <th> <h2 class="pull-right">Grand Total : <?php echo e(number_format(($all_total - $total_credit),2)); ?></h2></th>
                            </tr>
                        </table>



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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/paymentreport/payment_analysis.blade.php ENDPATH**/ ?>