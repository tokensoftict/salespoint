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
                    <?php if(session('success')): ?>
                        <?php echo alert_success(session('success')); ?>

                    <?php elseif(session('error')): ?>
                        <?php echo alert_error(session('error')); ?>

                    <?php endif; ?>
                    <div class="panel-heading">
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
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive table convert-data-table table-striped" style="font-size: 10px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Product Type</th>
                                <th>Total Cost Price</th>
                                <th>By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($transfer->store_from->name); ?></td>
                                    <td><?php echo e($transfer->store_to->name); ?></td>
                                    <td><?php echo $transfer->status == "COMPLETE" ? label( $transfer->status,'success') : label( $transfer->status,'primary'); ?></td>
                                    <td><?php echo e(convert_date($transfer->transfer_date)); ?></td>
                                    <td><?php echo e(convert_date($transfer->product_type)); ?></td>
                                    <td><?php echo e(number_format($transfer->total_price,2)); ?></td>
                                    <td><?php echo e($transfer->user->name); ?></td>
                                    <td>
                                        <?php if(userCanView('stocktransfer.delete_transfer') && $transfer->status =="DRAFT"): ?>
                                            <a data-msg="Are you sure, you want to delete this transfer" href="<?php echo e(route('stocktransfer.delete_transfer',$transfer->id)); ?>" class="btn btn-danger btn-sm confirm_action">Delete</a>
                                        <?php endif; ?>
                                        <?php if(userCanView('stocktransfer.edit') && $transfer->status =="DRAFT"): ?>
                                            <a  href="<?php echo e(route('stocktransfer.edit',$transfer->id)); ?>" class="btn btn-success btn-sm">Edit</a>
                                        <?php endif; ?>
                                        <?php if(userCanView('stocktransfer.complete') && $transfer->status =="DRAFT"): ?>
                                            <a  href="<?php echo e(route('stocktransfer.complete',$transfer->id)); ?>" class="btn btn-success btn-sm">Complete</a>
                                        <?php endif; ?>
                                        <?php if(userCanView('stocktransfer.show')): ?>
                                            <a  href="<?php echo e(route('stocktransfer.show',$transfer->id)); ?>" class="btn btn-primary btn-sm">View</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <?php endif; ?>
                            </tbody>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/stock/transfer/report.blade.php ENDPATH**/ ?>