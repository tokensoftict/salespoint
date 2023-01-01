<?php $__env->startSection('content'); ?>

    <div class="ui-container">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo e($title." - Transfer ".$transfer->id); ?>

                        <span class="pull-right">
                            <?php if(userCanView('stocktransfer.print_afour')): ?>
                                <a href="<?php echo e(route('stocktransfer.print_afour',$transfer->id)); ?>"  onclick="return open_print_window(this);" class="btn btn-info btn-sm" ><i class="fa fa-print"></i> Print Transfer</a>
                            <?php endif; ?>
                            <?php if(userCanView('stocktransfer.edit') && $transfer->status =="DRAFT"): ?>
                                <a  href="<?php echo e(route('stocktransfer.edit',$transfer->id)); ?>" class="btn btn-success btn-sm">Edit</a>
                            <?php endif; ?>
                            <?php if(userCanView('stocktransfer.complete') && $transfer->status =="DRAFT"): ?>
                                <a  href="<?php echo e(route('stocktransfer.complete',$transfer->id)); ?>" class="btn btn-success btn-sm">Complete</a>
                            <?php endif; ?>
                            <?php if(userCanView('stocktransfer.delete_transfer') && $transfer->status =="DRAFT"): ?>
                                <a data-msg="Are you sure, you want to delete this transfer" href="<?php echo e(route('stocktransfer.delete_transfer',$transfer->id)); ?>" class="btn btn-danger btn-sm confirm_action">Delete</a>
                            <?php endif; ?>
                        </span>
                    </header>
                    <div class="panel panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6>Transfer From</h6>
                                <h5><?php echo e($transfer->store_from->name); ?></h5>
                                <br/>
                                <h6>Status</h6>
                                <h5><?php echo $transfer->status == "COMPLETE" ? label( $transfer->status,'success') : label( $transfer->status,'primary'); ?></h5>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="text-right">Transfer To</h6>
                                <h5 class="text-right"><?php echo e($transfer->store_to->name); ?></h5>
                                <br/>
                                <h6 class="text-right">Date</h6>
                                <h5 class="text-right"><?php echo convert_date($transfer->transfer_date); ?></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br/>
                                <h4>Product Transfer List</h4>

                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-left">Name</th>
                                        <th class="text-center">Cost Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Total Selling Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $total = 0;
                                        $errors = session('errors')
                                    ?>
                                    <?php $__currentLoopData = $transfer->stock_transfer_items()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $total +=($trans->quantity * $trans->selling_price)
                                        ?>
                                        <tr>
                                            <td class="text-left"><?php echo e($trans->stock->name); ?></td>
                                            <td class="text-center"><?php echo e(number_format($trans->cost_price,2)); ?></td>
                                            <td class="text-center"><?php echo e($trans->quantity); ?></td>
                                            <td class="text-right"><?php echo e(number_format(($trans->quantity * $trans->cost_price),2)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <th class="text-right">Total</th>
                                        <th class="text-right"><?php echo e(number_format($total,2)); ?></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/stock/transfer/show.blade.php ENDPATH**/ ?>