<table class="table table-bordered table-responsive table convert-data-table table-striped" style="font-size: 12px">
    <thead>
    <tr>
        <th>#</th>
        <th>Invoice/Receipt No</th>
        <th>Customer</th>
        <th>Status</th>
        <th>Sub Total</th>
        <th>Total Paid</th>
        <th>Date</th>
        <th>Time</th>
        <th>By</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $total = 0;
    ?>
    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $total += $invoice->total_amount_paid;
        ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($invoice->invoice_paper_number); ?></td>
            <td><?php echo e($invoice->customer->firstname); ?> <?php echo e($invoice->customer->lastname); ?></td>
            <td><?php echo invoice_status($invoice->status); ?></td>
            <td><?php echo e(number_format($invoice->sub_total,2)); ?></td>
            <td><?php echo e(number_format($invoice->total_amount_paid,2)); ?></td>
            <td><?php echo e(convert_date2($invoice->invoice_date)); ?></td>
            <td><?php echo e($invoice->sales_time); ?></td>
            <td><?php echo e($invoice->created_user->name); ?></td>
            <td>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                    <ul role="menu" class="dropdown-menu">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $invoice)): ?>
                            <li><a href="<?php echo e(route('invoiceandsales.view',$invoice->id)); ?>">View Invoice</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$invoice)): ?>
                            <li><a href="<?php echo e(route('invoiceandsales.edit',$invoice->id)); ?>">Edit Invoice</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',$invoice)): ?>
                            <li><a href="<?php echo e(route('invoiceandsales.destroy',$invoice->id)); ?>">Delete Invoice</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('approve',$invoice)): ?>
                            <li><a class="confirm_action" data-msg="Are you sure, you want to approve this Invoice, the is can not be reversed ?" href="<?php echo e(route('invoiceandsales.approve',$invoice->id)); ?>">Approve Invoice</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('decline',$invoice)): ?>
                            <li><a class="confirm_action" data-msg="Are you sure, you want to decline this Invoice, the is can not be reversed ?" href="<?php echo e(route('invoiceandsales.approve',$invoice->id)); ?>">Decline Invoice</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('draftInvoice',$invoice)): ?>
                            <li><a class="confirm_action" data-msg="Are you sure, you want to decline this Invoice, the is can not be reversed ?" href="<?php echo e(route('invoiceandsales.send_draft_invoice',$invoice->id)); ?>">Send Back To Draft</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print',$invoice)): ?>
                            <li><a onclick="open_print_window(this); return false" href="<?php echo e(route('invoiceandsales.pos_print',$invoice->id)); ?>">Print Invoice Pos</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print',$invoice)): ?>
                            <li><a onclick="open_print_window(this); return false" href="<?php echo e(route('invoiceandsales.print_afour',$invoice->id)); ?>">Print Invoice A4</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print',$invoice)): ?>
                            <li><a onclick="open_print_window(this); return false" href="<?php echo e(route('invoiceandsales.print_way_bill',$invoice->id)); ?>">Print Waybill</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Total</th>
        <th><?php echo e(number_format($total,2)); ?></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </tfoot>
</table>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/components/invoice-list-component.blade.php ENDPATH**/ ?>