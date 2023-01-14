<?php $__env->startPush('css'); ?>
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
                    <header class="panel-heading panel-border">
                        <?php echo e($title); ?>

                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive table-striped convert-data-table" style="font-size: 12px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee No</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Total Amount</th>
                                <th>Tenure</th>
                                <th>Start Date</th>
                                <th>Stop Date</th>
                                <th>Status</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($allowance->employee->employee_no); ?></td>
                                    <td><?php echo e($allowance->employee->name); ?></td>
                                    <td><?php echo e(number_format($allowance->amount ,2)); ?></td>
                                    <td><?php echo e($allowance->tenure > 0 ? number_format($allowance->total_amount,2) : ""); ?></td>
                                    <td><?php echo e($allowance->tenure > 0 ? $allowance->tenure." Month(s)" : "Infinity"); ?> </td>
                                    <td><?php echo e(eng_str_date($allowance->start_date)); ?></td>
                                    <td><?php echo e($allowance->tenure > 0 ? eng_str_date($allowance->end_date) : ""); ?></td>
                                    <td><?php echo $allowance->status == 0 ? label("Pending","default") : ( $allowance->status == 1 ? label("Approved","primary") : label("Completed","success") ); ?></td>
                                    <td><?php echo e($allowance->comment); ?></td>
                                    <td>
                                        <?php if(userCanView('periods.stop_running_allowance') && $allowance->status == 1 ): ?>
                                            <a href="<?php echo e(route('periods.stop_running_allowance',$allowance->id)); ?>"  class="btn btn-sm btn-primary confirm_action" data-msg="Are you sure, you want stop this allowance">Stop</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables-colvis/js/dataTables.colVis.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables-responsive/js/dataTables.responsive.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('bower_components/datatables-scroller/js/dataTables.scroller.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/init-datatables.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/payroll/periods/extra_allowance_list.blade.php ENDPATH**/ ?>