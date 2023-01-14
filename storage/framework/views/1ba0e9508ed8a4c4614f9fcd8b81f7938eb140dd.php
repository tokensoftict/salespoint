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
            <div class="col-md-5">
                <?php if(session('success')): ?>
                    <?php echo alert_success(session('success')); ?>

                <?php elseif(session('error')): ?>
                    <?php echo alert_error(session('error')); ?>

                <?php endif; ?>
                <section class="panel">
                    <div class="panel-heading">
                        <?php echo e($title); ?>

                    </div>
                    <div class="panel-body">
                        <form  action="" enctype="multipart/form-data" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label>Select Employee</label>
                                <select name="employee_id[]" multiple class="form-control" id="employee_id">

                                </select>
                                <?php if($errors->has('employee_id')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('employee_id')); ?></label>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label>Select Allowance</label>
                                <select required id="allowance_id" name="allowance_id" class="form-control">
                                    <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($allowance->id); ?>"><?php echo e($allowance->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>

                            <div class="form-group" >
                                <label>Select Type</label>
                                <select required id="type" name="type" class="form-control">
                                    <option value="1">Fixed</option>
                                    <option value="0">Percent Of Basic Salary</option>
                                </select>
                                <?php if($errors->has('type')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('type')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Start From</label>
                                <input class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-01" style="background-color: #FFF; color: #000;"  name="start_date" value="<?php echo e(date('Y-m-01')); ?>"/>
                                <?php if($errors->has('start_date')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('start_date')); ?></label>
                                <?php endif; ?>
                            </div>
                            <div class="form-group" >
                                <label>Tenure (In Month)</label>
                                <input type="number" name="tenure" class="form-control">
                                <?php if($errors->has('tenure')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('tenure')); ?></label>
                                <?php endif; ?>
                            </div>

                            <div class="form-group" >
                                <label>Amount</label>
                                <input type="number" step="0.000001" name="amount" class="form-control">
                                <?php if($errors->has('amount')): ?>
                                    <label for="name-error" class="error"
                                           style="display: inline-block;"><?php echo e($errors->first('amount')); ?></label>
                                <?php endif; ?>
                            </div>






                            <button class="btn btn-primary btn-sm" type="submit" name="save" value="save_and_create"><i class="fa fa-save"></i>  Add Extra Allowance</button>
                        </form>
                    </div>
                </section>
            </div>
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
    <script>
        $(document).ready(function(e){
            var path = "<?php echo e(route('findemployee')); ?>?select2=yes";
            var select =  $('#employee_id').select2({
                placeholder: 'Search & Select at least One Employee',
                ajax: {
                    url: path,
                    dataType: 'json',
                    delay: 250,
                    data: function (data) {
                        return {
                            searchTerm: data.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results:response
                        };
                    },
                }
            });


            $("#products").on('change',function(eventData){
                var data = $(this).select2('data');
                data = data[0];
            });

        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/payroll/periods/extra_allowance.blade.php ENDPATH**/ ?>