<?php $__env->startSection('content'); ?>
    <div class="ui-container">
        <div class="row">
            <div class="col-lg-7 col-lg-offset-3">
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
                        <form id="validate" action="<?php echo e(route('store_settings.update')); ?>" enctype="multipart/form-data" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PUT')); ?>

                            <div class="form-group">
                                <label>Store Name</label>
                                <input type="text" value="<?php echo e(old('name',@$store->name)); ?>"  required class="form-control" name="name" placeholder="Store Name"/>
                                <?php if($errors->has('name')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('name')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input  type="text"  value="<?php echo e(old('branch_name',@$store->branch_name)); ?>" required class="form-control" name="branch_name" placeholder="Branch Name"/>
                                <?php if($errors->has('branch_name')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('branch_name')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>VAT</label>
                                <input  type="text"  value="<?php echo e(old('tax',@$store->tax)); ?>"  class="form-control" name="tax" placeholder="VAT"/>
                            </div>
                            <div class="form-group">
                                <label>Employee Number Prefix</label>
                                <input  type="text"  value="<?php echo e(old('tax',@$store->emp_number_prefix)); ?>"  class="form-control" name="emp_number_prefix" placeholder="Employee Number Prefix"/>
                            </div>
                            <div class="form-group">
                                <label>Near Expiry Days</label>
                                <input  type="number" value="<?php echo e(old('near_expiry_days',@$store->near_expiry_days)); ?>" required class="form-control" name="near_expiry_days" placeholder="Near Expiry Days"/>
                                <?php if($errors->has('near_expiry_days')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('near_expiry_days')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Store Address Line</label>
                                <textarea name="first_address"  required class="form-control" placeholder="Store Address"><?php echo e(old('first_address',@$store->first_address)); ?></textarea>
                                <?php if($errors->has('first_address')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('first_address')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Store Address Line 2</label>
                                <textarea name="second_address" class="form-control" placeholder="Store Address Line 2"><?php echo e(old('second_address',@$store->second_address)); ?></textarea>
                                <?php if($errors->has('second_address')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('second_address')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Store Contact Numbers</label>
                                <textarea name="contact_number" required class="form-control" placeholder="Store Contact Numbers"><?php echo e(old('contact_number',@$store->contact_number)); ?></textarea>
                                <?php if($errors->has('contact_number')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('contact_number')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Store Logo</label>
                                <input type="file"  name="logo" class="form-control">
                                <?php if($errors->has('logo')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('logo')); ?></label>
                                <?php endif; ?>
                            </div>
                            <?php if(!empty($store->logo)): ?>
                            <img src="<?php echo e(asset('img/'.$store->logo)); ?>"  class="img-responsive" style="width:30%; margin: auto; display: block;"/>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Footer Receipt Notes</label>
                                <textarea name="footer_notes" class="form-control" placeholder="Footer Receipt Notes"><?php echo e(old('footer_notes',@$store->footer_notes)); ?></textarea>
                                <?php if($errors->has('footer_notes')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('footer_notes')); ?></label>
                                <?php endif; ?>
                            </div>
                            <?php if(userCanView("store_settings.update")): ?>
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save Changes</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/settings/storesettings/settings.blade.php ENDPATH**/ ?>