<?php $__env->startSection('content'); ?>
    <div class="ui-container">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo e($title); ?>

                        <span class="pull-right">
                            <a class="btn btn-info btn-sm" href="<?php echo e(route('user.create')); ?>"><i class="fa fa-user-md"></i> Add User</a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="user-list">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <?php if(config('app.store')  == "hotel"): ?>
                                    <th>Department</th>
                                    <?php endif; ?>
                                    <th>Username</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $num = 1;
                                ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($num); ?></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->email); ?></td>
                                            <?php if(config('app.store')  == "hotel"): ?>
                                            <td><?php echo e($user->department); ?></td>
                                            <?php endif; ?>
                                            <td><?php echo e($user->username); ?></td>
                                            <td><?php echo e($user->group->name); ?></td>
                                            <td><?php echo $user->status == 1 ? label("Active","success") : label("Inactive","danger"); ?></td>
                                            <td>
                                                <?php if(userCanView('user.edit')): ?>
                                                    <a href="<?php echo e(route('user.edit',$user->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <?php endif; ?>
                                                    <?php if(userCanView('user.toggle') && auth()->id() !=$user->id): ?>
                                                        <a href="<?php echo e(route('user.toggle',$user->id)); ?>" class="btn btn-success btn-sm">Toggle</a>
                                                    <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $num++;
                                    ?>
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/user/list-users.blade.php ENDPATH**/ ?>