<div class="col-sm-12">
    <br/>
    <?php if($invoice->status === "PENDING-APPROVAL"): ?>
        <h3 class="text-muted text-success text-center">Invoice Has Been Sent for Approval Successfully!</h3>
    <?php else: ?>
    <h3 class="text-muted text-success text-center">Invoice Has Been Updated Successfully!</h3>

    <div class="row">
        <?php if(userCanView('invoiceandsales.pos_print')): ?>
            <div class="col-md-6">
                <a href="<?php echo e(route('invoiceandsales.pos_print',$invoice->id)); ?>" onclick="open_print_window(this); return false" class="btn btn-success btn-lg btn-block">Print Invoice Pos <i class="fa fa-print"></i> </a>
            </div>
        <?php endif; ?>
        <?php if(userCanView('invoiceandsales.print_afour')): ?>
            <div class="col-md-6">
                <a href="<?php echo e(route('invoiceandsales.print_afour',$invoice->id)); ?>" onclick="open_print_window(this); return false" class="btn btn-primary btn-lg btn-block">Print Invoice A4 <i class="fa fa-print"></i></a>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="row mtop-20">
        <div class="col-md-12">
            <a href="<?php echo e(route('invoiceandsales.new')); ?>" class="btn btn-info btn-lg btn-block">New Sales / Invoice <i class="fa fa-plus"></i></a>
        </div>
    </div>
    <br/>
</div>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/invoice/success-updated.blade.php ENDPATH**/ ?>