<?php $__env->startSection('content'); ?>
    <div class="">
        <br/><br/>
        <div class="clear">
            <div class="pull-left" style="width: 30%;">
                <img src="" class="pull-left" style="width: 30%"/><br/>  <br/>
                <h5>Transfer From</h5>
                <h4><?php echo e($transfer->store_from->name); ?></h4>
                <br/>
                <h5>Status</h5>
                <h4><?php echo $transfer->status == "COMPLETE" ? label( $transfer->status,'success') : label( $transfer->status,'primary'); ?></h4>
            </div>
            <div class="pull-right" style="width: 30%;">
               <br/><br/> <br/><br/>
                <h5 class="text-right" style="text-align: right">Transfer To</h5>
                <h4 class="text-right" style="text-align: right"><?php echo e($transfer->store_to->name); ?></h4>
                <br/>
                <h5 class="text-right" style="text-align: right">Date</h5>
                <h4 class="text-right" style="text-align: right"><?php echo convert_date($transfer->transfer_date); ?></h4>
                <span  style="text-align: right"><?php echo softwareStampWithDate(); ?></span>
            </div>

            <div class="clear">
                <br/>
                <br/>
                <h4>Items List</h4>

                <table style="width: 100%; font-size: 14px" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-center">Selling Price</th>
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

            <div class="row">
                <div class="clear">
                    <div class="pull-left">
                        <h4><?php echo e("Stock Transfer Print #".$transfer->id); ?></h4>
                    </div>
                    <div class="title">

                    </div>
                    <div class="pull-right">
                        <?php echo softwareStampWithDate(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('extra_js_scripts_files'); ?>
            <script>
                window.onload = function(){
                    window.print();
                    setTimeout(function(){
                        window.close();
                    },800)
                }
            </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/print/print_transfer.blade.php ENDPATH**/ ?>