<?php $__env->startSection('content'); ?>
    <div class="ui-container">
        <div class="row">
            <div class="col-md-8">
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

                        <table class="table table-hover table-hover">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Default</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($allowance->name); ?></td>
                                    <td><?php echo $allowance->default == 1 ? label("Yes","success") : label("No","danger"); ?></td>
                                    <td><?php echo $allowance->enabled == 1 ? label("Active","success") : label("Inactive","danger"); ?></td>
                                    <td>
                                        <?php if(userCanView('allowance.toggle') && $allowance->default != 1): ?>
                                            <?php if($allowance->enabled == 1): ?>
                                                <a href="<?php echo e(route('allowance.toggle',$allowance->id)); ?>" class="btn btn-danger btn-sm">Disable</a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('allowance.toggle',$allowance->id)); ?>" class="btn btn-success btn-sm">Enable</a>
                                            <?php endif; ?>
                                    <?php endif; ?>
                                     <?php if(userCanView('allowance.edit') && $allowance->default != 1): ?>
                                                <a href="<?php echo e(route('allowance.edit',$allowance->id)); ?>" class="btn btn-success btn-sm">Edit</a>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>

                    </div>
                </section>
            </div>
            <?php if(userCanView('category.create')): ?>
                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php echo e($title2); ?>

                        </header>
                        <div class="panel-body">
                            <form id="validate" action="<?php echo e(route('allowance.store')); ?>" enctype="multipart/form-data" method="post">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="<?php echo e(old('name')); ?>" required  class="form-control" name="name" placeholder="Allowance Name"/>
                                    <?php if($errors->has('name')): ?>
                                        <label for="name-error" class="error"
                                               style="display: inline-block;"><?php echo e($errors->first('name')); ?></label>
                                    <?php endif; ?>
                                </div>

                                <!--
                                <div class="form-group">
                                    <label>Default</label>
                                    <select class="form-control" name="default">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                -->
                                <input type="hidden" value="0" name="default"/>
                                <div class="pull-left">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                </div>
                                <br/> <br/>
                            </form>
                        </div>
                    </section>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/payroll/allowance/list-Allowance.blade.php ENDPATH**/ ?>