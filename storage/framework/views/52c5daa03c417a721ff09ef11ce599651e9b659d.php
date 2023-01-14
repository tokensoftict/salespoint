<div class="col-sm-12">
    <br/>
    <h3 class="text-muted text-primary text-center">Some Item price in the invoice are below/equal to the cost price !</h3>
    <br/>
    <table class="table table-hover table-bordered">
        <thead>
            <th>#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Selling Price</th>
            <th class="text-center">Current Cost Price</th>
        </thead>
        <tbody>
            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td ><?php echo e($loop->iteration); ?></td>
                    <td class="text-center"><?php echo e($report['name']); ?></td>
                    <td class="text-center"><?php echo e(number_format($report['selling_price'],2)); ?></td>
                    <td class="text-center"><?php echo e(number_format($report['cost_price'],2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="row">
            <div class="col-md-6">
                <a href="#" onclick="submitInvoiceForApproval(this)" class="btn btn-success btn-lg btn-block">Submit Invoice for Approval <i class="fa fa-check"></i> </a>
            </div>
            <div class="col-md-6">
                <a href="#" onclick="return adjustInvoice();" class="btn btn-primary btn-lg btn-block">Cancel & Adjust Invoice <i class="fa fa-cancel"></i></a>
            </div>

    </div>

    <br/>
</div>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/invoice/below_cost_price_error.blade.php ENDPATH**/ ?>