
<!-- Start of Telescope Toolbar assets !-->
<script src="<?php echo e(route('telescope-toolbar.baseJs')); ?>?<?php echo e($assetVersion); ?>"></script>
<?php if($lightMode !== 'auto'): ?>
    <link href="<?php echo e(route('telescope-toolbar.styling')); ?>?<?php echo e($assetVersion); ?>&lightMode=<?php echo e($lightMode); ?>" rel="stylesheet">
<?php else: ?>
    <link href="<?php echo e(route('telescope-toolbar.styling')); ?>?<?php echo e($assetVersion); ?>&lightMode=1" rel="stylesheet">
    <link href="<?php echo e(route('telescope-toolbar.styling')); ?>?<?php echo e($assetVersion); ?>&lightMode=0" media="(prefers-color-scheme: dark)" rel="stylesheet">
<?php endif; ?>
<script <?php if(isset($csp_script_nonce) && $csp_script_nonce): ?> nonce="<?php echo e($csp_script_nonce); ?>" <?php endif; ?>>/*<![CDATA[*/
    (function () {
        <?php $__currentLoopData = $requestStack; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        Sfjs.requestStack.push(<?php echo json_encode($request, 15, 512) ?>);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    })();
    /*]]>*/</script>
<!-- End of Telescope Toolbar assets !-->
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/head.blade.php ENDPATH**/ ?>