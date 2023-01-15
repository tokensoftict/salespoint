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

                        <?php if(userCanView('employee.create')): ?>
                            <span class="tools pull-right">
                                            <a  href="<?php echo e(route('employee.create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New Employee</a>
                            </span>
                        <?php endif; ?>
                    </header>
                    <div class="panel-body">
                        <?php if(session('success')): ?>
                            <?php echo alert_success(session('success')); ?>

                        <?php elseif(session('error')): ?>
                            <?php echo alert_error(session('error')); ?>

                        <?php endif; ?>

                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-lg-4 col-lg-offset-7">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <div class="form-group">
                                                    <input type="text" name="search" value="<?php echo e($s ?? ""); ?>" id="search" class="form-control" placeholder="Search for employee e.g surname othername employee number">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button class="btn btn-primary btn-sm">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="stock_holder">
                                <table class="table <?php echo e(config('app.store') == "inventory" ? "" : 'convert-data-table'); ?> table-bordered table-responsive table-striped" style="font-size: 12px">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee No.</th>
                                        <th>Surname</th>
                                        <th>Other Names</th>
                                        <th>Phone Number</th>
                                        <th>Marital Status</th>
                                        <th>Scale</th>
                                        <th>Designation</th>
                                        <th>Rank</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($employee->employee_no); ?></td>
                                            <td><?php echo e(strtoupper($employee->surname)); ?></td>
                                            <td><?php echo e(ucwords(strtolower($employee->other_names))); ?></td>
                                            <td><?php echo e($employee->phone); ?></td>
                                            <td><?php echo e($employee->marital_status); ?></td>
                                            <td><?php echo e($employee->scale_id ? $employee->scale->name : ""); ?></td>
                                            <td><?php echo e($employee->designation_id ? $employee->designation->name : ""); ?></td>
                                            <td><?php echo e($employee->rank_id ? $employee->rank->name : ""); ?></td>
                                            <td><?php echo ($employee->status == 1 ? label("Active","success") : label("Inactive","danger")); ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <?php if(userCanView('employee.edit')): ?>
                                                            <li><a href="<?php echo e(route('employee.edit',$employee->id)); ?>">Edit</a></li>
                                                        <?php endif; ?>
                                                        <?php if(userCanView('employee.toggle')): ?>
                                                            <li><a href="<?php echo e(route('employee.toggle',$employee->id)); ?>"><?php echo e($employee->status == 0 ? 'Enabled' : 'Disabled'); ?></a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php if(config('app.store') == "inventory"): ?>
                                    <?php echo $employees->links(); ?>

                                <?php endif; ?>
                            </div>
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
    <script>
        /*
        var cache = $('#stock_holder').html();
        $(document).ready(function(){
            $('#search').on("keyup",function(e){
                $.get('?search=' + encodeURI($(this).val()), function (response) {
                    $('#stock_holder').html(response);
                });
            });
        });
        */
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/hr/employee/list-employee.blade.php ENDPATH**/ ?>