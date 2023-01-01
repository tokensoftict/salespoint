<?php
/** @var array|\Illuminate\Support\Collection $entries */
?>

<!-- START of Laravel Telescope Toolbar -->
<div id="sfMiniToolbar-<?php echo e($token); ?>" class="sf-minitoolbar" data-no-turbolink>
    <a class="open-button" href="#" title="Show Telescope toolbar" tabindex="-1" id="sfToolbarMiniToggler-<?php echo e($token); ?>" accesskey="D">
        <?php echo file_get_contents('/Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('telescope') . '.svg'); ?>
    </a>
</div>
<div id="sfToolbarClearer-<?php echo e($token); ?>" class="sf-toolbar-clearer"></div>

<div id="sfToolbarMainContent-<?php echo e($token); ?>" class="sf-toolbarreset clear-fix" data-no-turbolink>

    <?php echo $__env->make("telescope-toolbar::collectors.ajax", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $__currentLoopData = config('telescope-toolbar.collectors'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $templates): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($entries[$type])): ?>
            <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make($template, ['entries' => $entries[$type]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo $__env->make("telescope-toolbar::collectors.config", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <a class="hide-button" id="sfToolbarHideButton-<?php echo e($token); ?>" title="Close Toolbar" tabindex="-1" accesskey="D">
        <?php echo file_get_contents('/Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('telescope') . '.svg'); ?>
    </a>
</div>
<!-- END of Laravel Telescope Toolbar --><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/toolbar.blade.php ENDPATH**/ ?>