<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="ui-container">
        <?php if(isset($employee->id)): ?>
            <form role="form"  action="<?php echo e(route('employee.update',$employee->id)); ?>" enctype="multipart/form-data" method="post">
                <?php echo e(method_field('PUT')); ?>

        <?php else: ?>
           <form role="form"  action="<?php echo e(route('employee.store')); ?>" enctype="multipart/form-data" method="post">
       <?php endif; ?>
               <?php echo e(csrf_field()); ?>


               <div class="row">
                   <div class="col-md-4">
                       <?php if(session('success')): ?>
                           <?php echo alert_success(session('success')); ?>

                       <?php elseif(session('error')): ?>
                           <?php echo alert_error(session('error')); ?>

                       <?php endif; ?>
                       <section class="panel">
                           <header class="panel-heading panel-border">
                               Basic Information
                           </header>
                           <div class="panel-body" >

                               <div class="form-group">
                                   <label>Surname <span  style="color:red;">*</span></label>
                                   <div class="input-group col-md-12">
                                       <input type="text" value="<?php echo e(old('surname', $employee->surname)); ?>" required  class="form-control" id="surname" name="surname" placeholder="Surname"/>
                                   </div>
                                   <?php if($errors->has('surname')): ?>
                                       <label for="name-error" class="error"
                                              style="display: inline-block;"><?php echo e($errors->first('surname')); ?></label>
                                   <?php endif; ?>
                               </div>

                               <div class="form-group">
                                   <label>Other names <span  style="color:red;">*</span></label>
                                   <div class="input-group col-md-12">
                                       <input type="text" value="<?php echo e(old('other_names', $employee->other_names)); ?>" required  class="form-control" id="other_names" name="other_names" placeholder="Other names"/>
                                   </div>
                                   <?php if($errors->has('other_names')): ?>
                                       <label for="name-error" class="error"
                                              style="display: inline-block;"><?php echo e($errors->first('other_names')); ?></label>
                                   <?php endif; ?>
                               </div>

                               <div class="form-group">
                                   <label>Gender  <span style="color:red;">*</span></label>
                                   <select class="form-control" required name="gender">
                                       <option <?php echo e(old("gender",$employee->gender) == "Male" ? "selected" : ""); ?> value="Male">Male</option>
                                       <option <?php echo e(old("gender",$employee->gender) == "Female" ? "selected" : ""); ?> value="Female">Female</option>
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Date Of Birth</label>
                                   <div class="input-group col-md-12">
                                       <input type="text" value="<?php echo e(old('dob', $employee->dob)); ?>" required  class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-dd" id="dob" name="dob" placeholder="Date Of Birth"/>
                                   </div>
                                   <?php if($errors->has('dob')): ?>
                                       <label for="name-error" class="error"
                                              style="display: inline-block;"><?php echo e($errors->first('dob')); ?></label>
                                   <?php endif; ?>
                               </div>


                               <div class="form-group">
                                   <label>Email Address</label>
                                   <input placeholder="Email Address" value="<?php echo e(old("email",$employee->email)); ?>" type="email" name="email" class="form-control">
                               </div>


                               <div class="form-group">
                                   <label>Phone Number</label>
                                   <input placeholder="Phone Number" value="<?php echo e(old("phone",$employee->phone)); ?>" type="text" name="phone" class="form-control">
                               </div>

                               <div class="form-group">
                                   <label>Address</label>
                                   <textarea placeholder="Address"  name="address" class="form-control"><?php echo e(old("address",$employee->address)); ?></textarea>
                               </div>


                               <div class="form-group">
                                   <label>Marital Status</label>
                                   <select class="form-control" required name="marital_status">
                                       <option <?php echo e(old("marital_status",$employee->marital_status) == "Single" ? "selected" : ""); ?> value="Single">Single</option>
                                       <option <?php echo e(old("marital_status",$employee->marital_status) == "Married" ? "selected" : ""); ?> value="Married">Married</option>
                                       <option <?php echo e(old("marital_status",$employee->marital_status) == "Divorced" ? "selected" : ""); ?> value="Divorced">Divorced</option>
                                       <option <?php echo e(old("marital_status",$employee->marital_status) == "Widowed" ? "selected" : ""); ?> value="Widowed">Widowed</option>
                                   </select>
                               </div>

                           </div>
                       </section>
                   </div>
                   <div class="col-md-4">
                       <section class="panel">
                           <header class="panel-heading panel-border">
                               Official Information
                           </header>

                           <div class="panel-body" >
                               <div class="form-group">
                                   <label>Employee Status </label>
                                   <select class="form-control" required name="status">
                                       <option <?php echo e(old('status', $employee->status) == "1" ? "selected" : ""); ?> value="1">Enabled</option>
                                       <option <?php echo e(old('status', $employee->status) == "0" ? "selected" : ""); ?> value="0">Disabled</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Scale</label>
                                   <select class="form-control" name="scale_id">
                                       <option value="">-Select Scale-</option>
                                       <?php $__currentLoopData = $scales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option <?php echo e(old('scale_id', $employee->scale_id) == $scale->id ? "selected" : ""); ?> value="<?php echo e($scale->id); ?>"><?php echo e($scale->name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Rank </label>
                                   <select class="form-control" name="rank_id">
                                       <option value="">-Select Rank-</option>
                                       <?php $__currentLoopData = $ranks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option <?php echo e(old('rank_id', $employee->rank_id) == $rank->id ? "selected" : ""); ?> value="<?php echo e($rank->id); ?>"><?php echo e($rank->name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Designation </label>
                                   <select class="form-control" name="designation_id">
                                       <option value="">-Select Designation-</option>
                                       <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option <?php echo e(old('designation_id', $employee->designation_id) == $designation->id ? "selected" : ""); ?> value="<?php echo e($designation->id); ?>"><?php echo e($designation->name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Salary</label>
                                   <input type="number" step="0.00001"  value="<?php echo e(old('salary',$employee->salary)); ?>"  class="form-control" name="salary" placeholder="Salary"/>
                               </div>

                               <input type="hidden" name="permanent" value="1">
                           </div>
                       </section>

                       <section class="panel">
                           <header class="panel-heading panel-border">
                               Bank Account Information
                           </header>
                           <div class="panel-body">
                               <div class="form-group">
                                   <label>Bank </label>
                                   <select class="form-control" name="bank_id">
                                       <option value="">-Select Bank-</option>
                                       <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option <?php echo e(old('bank_id', $employee->bank_id) == $bank->id ? "selected" : ""); ?> value="<?php echo e($bank->id); ?>"><?php echo e($bank->name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Bank Account Number</label>
                                   <input type="text"  value="<?php echo e(old('bank_account_no',$employee->bank_account_no)); ?>"   class="form-control" name="bank_account_no" placeholder="Bank Account Number"/>
                               </div>


                               <div class="form-group">
                                   <label>Bank Account Name</label>
                                   <input type="text"  value="<?php echo e(old('bank_account_name',$employee->bank_account_name)); ?>"   class="form-control" name="bank_account_name" placeholder="Bank Account Name"/>
                               </div>

                           </div>
                       </section>
                   </div>
                   <div class="col-md-4">
                       <section class="panel">
                           <header class="panel-heading panel-border">
                              Passport
                           </header>
                           <div class="panel-body" >
                           <?php if(isset($employee->photo)): ?>
                               <img src="<?php echo e($employee->image); ?>" id="product_image" class="img-thumbnail"/>
                               <br/>
                           <?php else: ?>
                               <img src="<?php echo e(asset('assets/products.jpg')); ?>" id="product_image" class="img-thumbnail"/>
                               <br/>
                           <?php endif; ?>
                           <br>
                           <input type="file" class="form-control" name="photo">
                           </div>

                       </section>
                       <section class="panel">

                           <div class="panel-body" >
                               <input class="btn btn-info btn-block btn-lg" type="submit" name="save" value="Save Employee">
                           </div>
                       </section>
                   </div>
               </div>

           </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('assets/js/init-datepicker.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/hr/employee/form.blade.php ENDPATH**/ ?>