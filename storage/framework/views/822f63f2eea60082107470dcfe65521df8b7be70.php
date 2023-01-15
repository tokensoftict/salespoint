<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e(getStoreSettings()->name); ?> - Payslips</title>
    <style>
        #payslip {
            font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        div.clear {
            clear: both;
            margin: 8px 0;
        }
        div.pull-left {
            float: left;
            margin-right: 15px;
        }
        p.small {
            font-size: 8px;
        }
        #payslip table {
            width: 100%;
            margin-bottom: 8px;
            font-size: 11px;
        }

        #payslip th, #payslip td {
            padding: 3px 6px
        }

        #payslip tr.heading {
            background: #e4eaf2;
        }
        #payslip tr.total {
            background: rgba(236, 151, 31, 0.25)
        }
        div.title h3 {
            font-family: Verdana, Helvetica, "Gill Sans", sans-serifr;
        }
    </style>
</head>
<body onload="window.print()">
<div class="row" id="payslip">
    <div class="clear">
        <div class="pull-left">
            <img src="<?php echo e($payslip->employee->image); ?>" width="150px">

        </div>
        <div class="title">
            <h3><?php echo e(getStoreSettings()->name); ?>

            </h3>
            <h4>PAYSLIP</h4>
        </div>
        <p class="small"><?php echo softwareStampWithDate(); ?></p>
    </div>
    <div class="clear">
        <h2><?php echo e($payslip->employee->full_name); ?></h2>
        <table class="table">
            <tr>
                <th>Period:</th>
                <td><?php echo e($period->period_date); ?></td>
                <th>Basic Salary:</th>
                <td><?php echo e(number_format($payslip->employee->salary,2)); ?></td>
            </tr>

            <tr>
                <th>Bank:</th>
                <td><?php echo e($payslip->employee->bank->name); ?></td>
                <th>Designation</th>
                <td><?php echo e($payslip->designation->name ?? ""); ?></td>
            </tr>
            <tr>
                <th>Account Number:</th>
                <td><?php echo e($payslip->employee->bank_account_no); ?></td>
                <th>Rank:</th>
                <td><?php echo e($payslip->rank->name ?? ""); ?></td>
            </tr>
        </table>
        <table class="table">
            <tr class="heading">
                <th colspan="3">PAY ITEMS</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Pay Item</th>
                <th style="text-align:right"> Amount (N)</th>
            </tr>
            <?php $__currentLoopData = $payslip->payslips_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if( $item->item_type == "1"): ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($item->payable->name ?? ""); ?> <?php echo e($item->payable->allowance->name ?? ""); ?></td>
                    <td style="text-align:right"><?php echo e(number_format($item->amount,2)); ?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr class="total">
                <th style="text-align:right"></th>
                <th style="text-align: right">Gross Pay</th>
                <th style="text-align: right"><?php echo e(number_format($payslip->gross_pay,2)); ?></th>
            </tr>
            <tr class="heading">
                <th colspan="3">DEDUCTIONS</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Deduction</th>
                <th style="text-align:right">Total Amount (N)</th>
            </tr>
            <?php $__currentLoopData = $payslip->payslips_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if( $item->item_type == "2"): ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td style="text-align: center"><?php echo e($item->payable->name ?? ""); ?> <?php echo e($item->payable->allowance->name ?? ""); ?></td>
                        <td style="text-align:right"><?php echo e(number_format($item->amount,2)); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr class="total">
                <th></th>
                <th  style="text-align: right">Total Deductions</th>
                <th style="text-align: right"><?php echo e(number_format($payslip->total_deduction,2)); ?></th>
            </tr>
            <tr class="heading">
                <th colspan="3">NET PAY</th>
            </tr>
            <tr class="total">
                <th style="text-align:right"></th>
                <th  style="text-align:right">Net Pay</th>
                <th style="text-align: right"><?php echo e(number_format($payslip->net_pay,2)); ?></th>
            </tr>
        </table>
    </div>
</div>
</body>
</html>


<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/print/payslips.blade.php ENDPATH**/ ?>