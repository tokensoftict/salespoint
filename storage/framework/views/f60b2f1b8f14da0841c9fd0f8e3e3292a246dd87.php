<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Invoice #<?php echo e($invoice->id); ?></title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-size: 8pt;
            background-color: #fff;
        }

        #products {
            width: 100%;
        }

        #products tr td {
            font-size: 7pt;
        }

        #printbox {
            width: 80mm;
            margin: 5pt;
            padding: 5px;
            text-align: justify;
        }

        .inv_info tr td {
            padding-right: 14pt;
        }

        .product_row {
            margin: 13pt;
        }

        .stamp {
            margin: 5pt;
            padding: 3pt;
            border: 3pt solid #111;
            text-align: center;
            font-size: 20pt;
            color:#000;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<h3 id="logo" class="text-center"><br><img style="max-height:30px;" src="<?php echo e(public_path("img/". $store->logo)); ?>" alt='Logo'></h3>
<div id="printbox">
    <h2 style="margin:-2px;padding: 0px" class="text-center"><?php echo e($store->name); ?></h2>
    <div align="center" >
        <?php echo e($store->first_address); ?>

        <?php if(!empty($store->second_address)): ?>
            <br/>
            <?php echo e($store->second_address); ?>

        <?php endif; ?>
        <?php if(!empty($store->contact_number)): ?>
            <br/>
            <?php echo e($store->contact_number); ?>

        <?php endif; ?>
    </div>
    <table class="inv_info">
        <tr>
            <td>Invoice / Receipt No</td>
            <td><?php echo e($invoice->invoice_paper_number); ?></td>
        </tr>
        <tr>
            <td>Invoice Number</td>
            <td><?php echo e($invoice->invoice_number); ?></td>
        </tr>
        <tr>
            <td>Invoice Date</td>
            <td><?php echo e(convert_date2($invoice->invoice_date)); ?></td>
        </tr>
        <tr>
            <td>Customer</td>
            <td><?php echo e($invoice->customer->firstname); ?> <?php echo e($invoice->customer->lastname); ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><?php echo e($invoice->status); ?></td>
        </tr>
        <tr>
            <td>Mode of Payment</td>
            <td>
                <?php if($invoice->paymentMethodTable->count() > 1): ?>
                    <?php
                        $methods = [];
                    ?>

                    <?php $__currentLoopData = $invoice->paymentMethodTable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            echo  $meth->payment_method->name." : ". number_format( $meth->amount,2)."<br/>";
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                <?php else: ?>
                   <?php echo e($invoice->paymentMethodTable->first()->payment_method->name); ?> : <?php echo e(number_format($invoice->paymentMethodTable->first()->amount,2)); ?>

                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Credit Balance</td>
            <td><?php echo e(number_format($invoice->customer->credit_balance,2)); ?></td>
        </tr>
    </table>
    <hr>
    <table id="products">
        <tr class="product_row">
            <td>#</td>
            <td align="left"><b>Name</b></td>
            <td align="center"><b>Quantity</b></td>
            <td align="center"><b>Price</b></td>
            <td align="right"><b>Total</b></td>
        </tr>
        <tr>
            <td colspan="5">
                <hr>
            </td>
        </tr>
        <tbody id="appender">
        <?php $__currentLoopData = $invoice->invoice_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td align="left" class="text-left"><?php echo e($item->stock->name); ?></td>
                <td align="center" class="text-center"><?php echo e($item->quantity); ?></td>
                <td align="center" class="text-center"><?php echo e(number_format($item->selling_price,2)); ?></td>
                <td align="right" class="text-right"><?php echo e(number_format(($item->total_selling_price),2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">Sub Total</td>
            <td class="text-right"><?php echo e(number_format($invoice->sub_total,2)); ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td  align="right" class="text-right">Total</td>
            <td  align="right" class="text-right"><b><?php echo e(number_format(($invoice->sub_total),2)); ?></b></td>
        </tr>
        <?php if(isset($invoice->paymentMethodTable->first()->payment_method_id) && $invoice->paymentMethodTable->first()->payment_method_id == "1"): ?>
            <?php
                $method = json_decode($invoice->paymentMethodTable->first()->payment_info);
            ?>

            <?php if(isset( $method-> customer_change)): ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td  align="right" class="text-right">Change</td>
            <td  align="right" class="text-right"><b><?php echo e(number_format(($method-> customer_change),2)); ?></b></td>
        </tr>
        <?php endif; ?>
        <?php endif; ?>
        </tfoot>
    </table>
    <hr>
    <div class="text-center">  <?php echo e($store->footer_notes); ?></div>
    <div class="text-center"> <?php echo softwareStampWithDate(); ?></div>
</div>
</body>
</html>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/print/pos.blade.php ENDPATH**/ ?>