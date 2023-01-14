<?php $__env->startSection('content'); ?>
        <div class="ui-container">
                <div class="row">
                        <div class="col-sm-12">
                                <section class="panel">
                                        <header class="panel-heading panel-border">
                                                List Groups
                                                <?php if(userCanView('user.group.create')): ?>
                                                        <span class="tools pull-right">
                                                <a  href="<?php echo e(route('user.group.create')); ?>" class="btn btn-primary"> Add User Group</a>
                                        </span>
                                                <?php endif; ?>
                                        </header>
                                        <div class="panel-body">
                                                <div class="table-responsive">
                                                        <table class="table convert-data-table table-striped">
                                                                <thead>
                                                                <tr>
                                                                        <th>Name</th>
                                                                        <th>Status</th>
                                                                        <th>Details</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <tr>
                                                                                <td><?php echo e($group->name); ?></td>
                                                                                <td><?php echo $group->status == '1' ? label("Active", "success") : label("Inactive", "danger"); ?></td>
                                                                                <td>
                                                                                        <?php if(userCanView('user.group.show')): ?>
                                                                                                <a href="<?php echo e(route('user.group.show', [$group->id])); ?>"><button class='btn btn-info btn-xs'><i class='fa fa-eye'></i> Details</button></a>
                                                                                        <?php endif; ?>
                                                                                        <?php if(userCanView('user.group.permission')): ?>
                                                                                                <a href="<?php echo e(route('user.group.permission', [$group->id])); ?>"><button class='btn btn-warning btn-xs'><i class='fa fa-list'></i> Permissions</button></a>
                                                                                        <?php endif; ?>
                                                                                </td>
                                                                        </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                        </table>
                                                </div>
                                        </div>
                                </section>
                        </div>
                </div>
        </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/access-control/group-controller.blade.php ENDPATH**/ ?>