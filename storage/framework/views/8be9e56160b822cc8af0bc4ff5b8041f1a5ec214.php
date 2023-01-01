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
                        <table class="table table-bordered table-responsive table convert-data-table table-striped" id="invoice-list" style="font-size: 12px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Full name</th>
                                <th>Email Address</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Credit Balance</th>
                                <th>Deposit Balance</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $total = 0;
                            ?>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $total += $customer->credit_balance;
                                ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($customer->firstname); ?> <?php echo e($customer->lastname); ?></td>
                                    <td><?php echo e($customer->email); ?></td>
                                    <td><?php echo e($customer->address); ?></td>
                                    <td><?php echo e($customer->phone_number); ?></td>
                                    <td><?php echo e(number_format($customer->credit_balance,2)); ?></td>
                                    <td><?php echo e(number_format($customer->deposit_balance,2)); ?></td>
                                    <td><?php echo e($customer->created_at); ?></td>
                                    <td>

                                        <?php if(userCanView('customer.edit')): ?>
                                            <a href="<?php echo e(route('customer.edit',$customer->id)); ?>" class="btn btn-success btn-sm">Edit</a>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th><?php echo e(number_format($total,2)); ?></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </section>
            </div>
        <!--
                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php echo e($title2); ?>

                </header>
                <div class="panel-body">
                    <form id="validate" action="<?php echo e(route('customer.store')); ?>" enctype="multipart/form-data" method="post">
                                <?php echo e(csrf_field()); ?>


        <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" value="<?php echo e(old('firstname')); ?>" required  class="form-control" name="firstname" placeholder="First Name"/>
                                        <?php if($errors->has('firstname')): ?>
            <label for="name-error" class="error"
                   style="display: inline-block;"><?php echo e($errors->first('firstname')); ?></label>
                                        <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" value="<?php echo e(old('lastname')); ?>" required  class="form-control" name="lastname" placeholder="Last Name"/>
                                        <?php if($errors->has('lastname')): ?>
            <label for="name-error" class="error"
                   style="display: inline-block;"><?php echo e($errors->first('lastname')); ?></label>
                                        <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" value="<?php echo e(old('email')); ?>"   class="form-control" name="email" placeholder="Email Address"/>
                                        <?php if($errors->has('email')): ?>
            <label for="name-error" class="error"
                   style="display: inline-block;"><?php echo e($errors->first('email')); ?></label>
                                        <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" value="<?php echo e(old('phone_number')); ?>" required  class="form-control" name="phone_number" placeholder="Phone Number"/>
                                        <?php if($errors->has('phone_number')): ?>
            <label for="name-error" class="error"
                   style="display: inline-block;"><?php echo e($errors->first('phone_number')); ?></label>
                                        <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address"><?php echo e(old('phone_number')); ?></textarea>
                                    </div>
                                    <div class="pull-left">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Add</button>
                                    </div>

                                </form>


                                <br/>

                        </div>
                    </section>
                </div>
                -->
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/customermanager/list-customer.blade.php ENDPATH**/ ?>