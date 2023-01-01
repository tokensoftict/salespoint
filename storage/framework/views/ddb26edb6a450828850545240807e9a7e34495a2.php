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

                        <form  action="" enctype="multipart/form-data" method="post">

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
                                            <small class="text-danger">Leave Blank, if you dont want to change your password</small>
                                        </div>
                                    </div>

                                    <br/>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <center>
                                    <button class="btn btn-info btn-lg" type="submit"><i class="fa fa-save"></i> Update Profile</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/myprofile.blade.php ENDPATH**/ ?>