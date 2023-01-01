<?php $__env->startSection('content'); ?>
    <style>
        input,select {
            margin-bottom: 20px !important;
        }
    </style>
    <div class="ui-container">
        <div class="row">
            <div class="col-sm-12">
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
                        <?php if(isset($user->id)): ?>
                            <form  action="<?php echo e(route('user.update',$user->id)); ?>" enctype="multipart/form-data" method="post">
                                <?php echo e(method_field('PUT')); ?>

                                <?php else: ?>
                                    <form  action="<?php echo e(route('user.store')); ?>" enctype="multipart/form-data" method="post">
                                        <?php endif; ?>
                                        <div class="panel-body">
                                            <div class="col-sm-7 col-lg-offset-2">
                                                <?php echo e(csrf_field()); ?>

                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">Full Name<span class="star">*</span>:</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <input type="text" value="<?php echo e(old('name',$user->name)); ?>" required  class="form-control" name="name" placeholder="Full Name"/>
                                                        <?php if($errors->has('name')): ?>
                                                            <label for="name-error" class="error"
                                                                   style="display: inline-block;"><?php echo e($errors->first('name')); ?></label>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <?php if(config('app.store')  == "hotel"): ?>
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-xs-12 control-label">Department <span  style="color:red;">*</span></label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <select class="form-control" name="department">
                                                                <?php $__currentLoopData = $depts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option <?php echo e(old('amount',$user->department) ? "selected" : ""); ?>  value="<?php echo e($dept); ?>"><?php echo e($dept); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php if($errors->has('department')): ?>
                                                                <label for="name-error" class="error"
                                                                       style="display: inline-block;"><?php echo e($errors->first('department')); ?></label>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <input type="hidden" name="department" value="STORE"/>
                                                <?php endif; ?>

                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">Store <span  style="color:red;">*</span></label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <select class="form-control" name="warehousestore_id">
                                                            <option <?php echo e($user->warehousestore_id == NULL ? "selected" : ""); ?> value="0">Select Store</option>
                                                            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php echo e(old('warehousestore_id',$user->warehousestore_id) ? "selected" : ""); ?>  value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php if($errors->has('warehousestore_id')): ?>
                                                            <label for="name-error" class="error"
                                                                   style="display: inline-block;"><?php echo e($errors->first('warehousestore_id')); ?></label>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">Username<span class="star">*</span>:</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <input type="text" value="<?php echo e(old('username',$user->username)); ?>" required  class="form-control" name="username" placeholder="Username"/>
                                                        <?php if($errors->has('username')): ?>
                                                            <label for="name-error" class="error"
                                                                   style="display: inline-block;"><?php echo e($errors->first('username')); ?></label>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">Email address<span class="star">*</span>:</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <input type="text" value="<?php echo e(old('email',$user->email)); ?>" required  class="form-control" name="email" placeholder="Email Address"/>
                                                        <?php if($errors->has('email')): ?>
                                                            <label for="name-error" class="error"
                                                                   style="display: inline-block;"><?php echo e($errors->first('email')); ?></label>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">Password<span class="star">*</span>:</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <input type="password" value="<?php echo e(old('password')); ?>" <?php echo e(!isset($user->id) ? "required" : ""); ?>  class="form-control" name="password" placeholder="Password"/>
                                                        <?php if($errors->has('password')): ?>
                                                            <label for="name-error" class="error"
                                                                   style="display: inline-block;"><?php echo e($errors->first('password')); ?></label>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 col-xs-12 control-label">User Group<span class="star">*</span>:</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <select class="form-control" name="group_id" required>
                                                            <option value="">-Select Group-</option>
                                                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php echo e((old('group_id',$user->group_id) == $group->id ) ? 'selected' : ""); ?> value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php if($errors->has('group_id')): ?>
                                                            <label for="name-error" class="error"
                                                                   style="display: inline-block;"><?php echo e($errors->first('group_id')); ?></label>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <br/>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <center>
                                                <?php if(!isset($user->id)): ?>
                                                    <button class="btn btn-info btn-lg" type="submit"><i class="fa fa-save"></i> Add User</button>
                                                <?php else: ?>
                                                    <button class="btn btn-info btn-lg" type="submit"><i class="fa fa-save"></i> Update User</button>
                                                <?php endif; ?>
                                            </center>
                                        </div>
                                    </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/user/add-user.blade.php ENDPATH**/ ?>