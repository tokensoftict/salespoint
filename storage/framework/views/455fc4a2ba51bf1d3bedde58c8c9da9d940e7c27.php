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
                                    <th>Bank Name</th>
                                    <th>Account Number</th>
                                    <th>Account Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($account->bank->name); ?></td>
                                        <td><?php echo e($account->account_number); ?></td>
                                        <td><?php echo e($account->account_name); ?></td>
                                        <td><?php echo $account->status == 1 ? label("Active","success") : label("Inactive","danger"); ?></td>
                                        <td>
                                            <?php if(userCanView('bank.toggle')): ?>
                                                <?php if($account->status == 1): ?>
                                                    <a href="<?php echo e(route('bank.toggle',$account->id)); ?>" class="btn btn-danger btn-sm">Disable</a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('bank.toggle',$account->id)); ?>" class="btn btn-success btn-sm">Enable</a>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                                <?php if(userCanView('bank.edit')): ?>
                                                    <a href="<?php echo e(route('bank.edit',$account->id)); ?>" class="btn btn-success btn-sm">Edit</a>
                                                <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                    </div>
                </section>
            </div>
            <?php if(userCanView('bank.create')): ?>
                <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo e($title2); ?>

                    </header>
                    <div class="panel-body">
                        <form id="validate" action="<?php echo e(route('bank.store')); ?>" enctype="multipart/form-data" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>Bank</label>
                                <select class="form-control" name="bank_id">
                                    <option value="">Select Bank</option>
                                    <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($bank->id); ?>"><?php echo e($bank->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($errors->has('bank_id')): ?>
                                        <label for="name-error" class="error"
                                               style="display: inline-block;"><?php echo e($errors->first('bank_id')); ?></label>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Bank Account Name</label>
                                <input type="text" value="<?php echo e(old('account_name')); ?>" required  class="form-control" name="account_name" placeholder="Bank Account Name"/>
                                <?php if($errors->has('account_name')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('account_name')); ?></label>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" value="<?php echo e(old('account_number')); ?>" required  class="form-control" name="account_number" placeholder="Bank Account Number"/>
                                <?php if($errors->has('account_number')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('account_number')); ?></label>
                                <?php endif; ?>
                            </div>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/settings/bank/list-bank.blade.php ENDPATH**/ ?>