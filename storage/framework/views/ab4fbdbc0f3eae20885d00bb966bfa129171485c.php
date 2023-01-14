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
                                    <th>Rank</th>
                                    <th>Total Allowance</th>
                                    <th>Gross Pay</th>
                                    <th>Total Deduction</th>
                                    <th>Net Pay</th>
                                    <th>Bank</th>
                                    <th>Bank Account Name</th>
                                    <th>Bank Account No</th>
                                   <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $beneficiaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $beneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($beneficiary->employee->employee_no); ?></td>
                                            <td><?php echo e($beneficiary->employee->name); ?></td>
                                            <td><?php echo e($beneficiary->rank->name ?? ""); ?></td>
                                            <td><?php echo e(number_format($beneficiary->total_allowance,2)); ?></td>
                                            <td><?php echo e(number_format($beneficiary->gross_pay,2)); ?></td>
                                            <td><?php echo e(number_format($beneficiary->total_deduction,2)); ?></td>
                                            <td><?php echo e(number_format($beneficiary->net_pay,2)); ?></td>
                                            <td><?php echo e($beneficiary->bank->name ?? ""); ?></td>
                                            <td><?php echo e($beneficiary->account_name ?? ""); ?></td>
                                            <td><?php echo e($beneficiary->account_no ?? ""); ?></td>
                                           <!-- <td>
                                                <a href="" class="btn btn-sm btn-primary">Payslip</a>
                                            </td>
                                            -->
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/payroll/periods/beneficiaries.blade.php ENDPATH**/ ?>