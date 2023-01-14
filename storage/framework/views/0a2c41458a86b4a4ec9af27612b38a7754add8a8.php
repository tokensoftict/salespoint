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

                    </header>
                    <div class="panel-body">
                        <?php if(session('success')): ?>
                            <?php echo alert_success(session('success')); ?>

                        <?php elseif(session('error')): ?>
                            <?php echo alert_error(session('error')); ?>

                        <?php endif; ?>

                        <table class="table table-bordered table-responsive table convert-data-table table-striped" style="font-size: 12px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Period</th>
                                <th>Employee Count</th>
                                <th>Gross Pay</th>
                                <th>Gross Deduction</th>
                                <th>Net Pay</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $periods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($period->period_date); ?></td>
                                    <td><?php echo e($period->payslips_count); ?></td>
                                    <td><?php echo e(number_format($period->gross_pay,2)); ?></td>
                                    <td><?php echo e(number_format($period->gross_deduction,2)); ?></td>
                                    <td><?php echo e(number_format($period->net_pay,2)); ?></td>
                                    <td><?php echo $period->status == 1 ? label("Pending","default") : ( $period->status == 2 ? label("Approved","primary") : label("Closed","success") ); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                            <ul role="menu" class="dropdown-menu">
                                                <?php if(userCanView('periods.run') && getCurrentPeriod()->id === $period->id): ?>
                                                    <li><a href="<?php echo e(route('periods.run',$period->id)); ?>">Run</a></li>
                                                <?php endif; ?>
                                                <?php if(userCanView('periods.approve') && getCurrentPeriod()->id === $period->id && $period->status == 1): ?>
                                                    <li><a class="confirm_action" data-msg="Are you sure, you want to approve this payroll this can not be reversed" href="<?php echo e(route('periods.approve',$period->id)); ?>">Approve</a></li>
                                                <?php endif; ?>
                                                    <?php if(userCanView('periods.close') && getCurrentPeriod()->id === $period->id && $period->status == 2): ?>
                                                        <li><a class="confirm_action" data-msg="Are you sure, you want to close this payroll this can not be reversed" href="<?php echo e(route('periods.close',$period->id)); ?>">Close</a></li>
                                                    <?php endif; ?>
                                                <?php if(userCanView('periods.beneficiary')): ?>
                                                    <li><a href="<?php echo e(route('periods.beneficiary',$period->id)); ?>"> Beneficiaries</a></li>
                                                <?php endif; ?>
                                                <?php if(userCanView('periods.xls')): ?>
                                                    <li><a href="<?php echo e(route('periods.xls',$period->id)); ?>">Export Excel Beneficiaries</a></li>
                                                <?php endif; ?>
                                                <?php if(userCanView('periods.pdf')): ?>
                                                    <li><a href="<?php echo e(route('periods.pdf',$period->id)); ?>">Export PDF Beneficiaries</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/payroll/periods/list-periods.blade.php ENDPATH**/ ?>