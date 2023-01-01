<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(getStoreSettings()->name); ?></title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" data-turbolinks-track="reload">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/simple-line-icons/css/simple-line-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/weather-icons/css/weather-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/themify-icons/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/main.css')); ?>">
    <link href="<?php echo e(asset('assets/js/bootstrap-submenu/css/bootstrap-submenu.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/rickshaw/rickshaw.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/js/jquery-easy-pie-chart/easypiechart.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/js/horizontal-timeline/css/style.css')); ?>">
    <style>
        .select2-container, .selection, .select2-selection {
            height: 30px;
            width: 100% !important;
            font-size: 10px;
        }
        input {
            margin-bottom: 0 !important;
        }
    </style>
    <?php echo $__env->yieldPushContent('css'); ?>

    <script src="<?php echo e(asset('assets/js/modernizr-custom.js')); ?>"></script>
   <!-- <script  src="<?php echo e(asset('js/app.js')); ?>"  data-turbolinks-eval="false" data-turbo-eval="false"></script>-->
    <script>let productfindurl = ""; window.validating_modal_show = false;</script>
</head>
<body>
<div id="ui" class="ui ui-aside-none">
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="content" class="ui-content ui-content-aside-overlay">
        <div class="ui-content-body">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div class="modal fade" id="validateInvoice" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
    <div class="modal-dialog modal-dialog-center modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="mloader"></div>
                <div class="loader-txt" id="loader-txt">
                </div>
            </div>
        </div>
    </div>
</div>


<script  data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/jquery/dist/jquery-ui.min.js')); ?>"></script>
<script  data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script  data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js')); ?>"></script>
<script  data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/autosize/dist/autosize.min.js')); ?>"></script>
<script  data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('assets/js/bootstrap-submenu/js/bootstrap-submenu.js')); ?>"></script>
<script  data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('assets/js/bootstrap-hover-dropdown.js')); ?>"></script>

<?php echo $__env->yieldPushContent('js'); ?>

<!-- Common Script   -->
<script  data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('dist/js/main.js')); ?>"></script>
<script>
    $('.confirm_action').on("click",function(e){
        if(confirm($(this).attr('data-msg') )== false){
            e.preventDefault();
        }
    });
    function confirm_action(elem){
        if(confirm($(elem).attr('data-msg')) == true){
            return true;
        }
        return false;
    }

    function open_print_window(elem){
        var href = $(elem).attr('href');
        var win = window.open(href, "MsgWindow", "width=800,height=500");
        win.onload = function(){
            win.print();
        }
        return false;
    }
    function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

            const negativeSign = amount < 0 ? "-" : "";

            let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
            console.log(e)
        }
    }
</script>
<script>
    function showMask(loadingText){
        if(!loadingText){
            loadingText = "Processing Please wait..";
        }
        //$('#loadingMask').removeAttr('style','display:block;')
        if(window.validating_modal_show !== true) {
            window.validating_modal_show = true;
            $("#validateInvoice").modal({
                backdrop: "static", //remove ability to close modal with click
                keyboard: false, //remove option to close with keyboard
                show: true //Display loader!
            });
        }
        $('#loader-txt').html('<p>'+loadingText+'</p>');
    }

    function hideMask(){
        //$('#loadingMask').attr('style','display:none;');
        window.validating_modal_show = false;
        $("#validateInvoice").modal("hide");
    }

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") { return; }

        // original length
        var original_len = input_val.length;

        // initial caret position
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val =  left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = input_val;

            // final formatting
            if (blur === "blur") {
                input_val += ".00";
            }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }


</script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/layouts/app.blade.php ENDPATH**/ ?>