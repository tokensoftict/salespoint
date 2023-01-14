<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="ui-container">
        <div class="row">
            <div class="col-sm-12">
                <form id="validate" action="<?php echo e(route('user.group.permission',[$group->id])); ?>" method="post"
                      class='form-horizontal'>
                    <section class="panel">
                        <header class="panel-heading panel-border">
                            <?php echo e($title); ?>

                        </header>
                        <div class="panel-body">
                            <?php if(session('success')): ?>
                                <?php echo alert_success(session('success')); ?>

                            <?php elseif(session('error')): ?>
                                <?php echo alert_error(session('error')); ?>

                            <?php endif; ?>

                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="group_id" value="<?php echo e($group->id); ?>">

                            <?php $__currentLoopData = $modules->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunkModule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <?php $__currentLoopData = $chunkModule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><span
                                                                class="<?php echo e($module->icon); ?>"></span> <?php echo e($module->label); ?></h3>
                                                </div>
                                                <div class="panel-body" style="height: 150px; overflow: auto">
                                                    <div id="mCSB_4" class=""
                                                         tabindex="0">
                                                        <div id="" class=""
                                                             style="position: relative; top: 0px; left: 0px;" dir="ltr">
                                                            <div class="row">
                                                                <?php $__currentLoopData = $module->tasks->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunkTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                    <?php $__currentLoopData = $chunkTask; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="col-md-6">
                                                                            <div class="checkbox">
                                                                                <label class="i-checks">
                                                                                    <input  <?php echo e(count($task->permissions)  ? "checked" : ''); ?> name="privileges[<?php echo e($task->id); ?>]" value="" type="checkbox">
                                                                                    <i></i>
                                                                                    <?php echo e($task->name); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                        <footer class="panel-footer">
                            <a href="<?php echo e(route('user.group.index')); ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-list"></i> View all User Groups
                            </a>
                            <button type="submit" class="btn btn-info btn-sm pull-right">
                                <span class="fa fa-save"></span> Assign User Group Privileges
                            </button>
                        </footer>
                    </section>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/access-control/permission-user-group.blade.php ENDPATH**/ ?>