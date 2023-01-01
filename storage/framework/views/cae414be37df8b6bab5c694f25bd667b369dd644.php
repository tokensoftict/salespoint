<?php
/** @var \Illuminate\Support\Collection|\Laravel\Telescope\EntryResult[] $entries */
$data = $entries->first()->content;

?>

<?php $__env->startComponent('telescope-toolbar::item', ['name' => 'time', 'link' => true]); ?>

    <?php $__env->slot('icon'); ?>

        <?php echo file_get_contents('/Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('time') . '.svg'); ?>

        <span class="sf-toolbar-value"><?php echo e($data['duration']); ?></span>
        <span class="sf-toolbar-label">ms</span>
    <?php $__env->endSlot(); ?>

    <?php $__env->slot('text'); ?>

        <div class="sf-toolbar-info-piece">
            <b>Request Duration</b>
            <span><?php echo e($data['duration']); ?> ms</span>
        </div>

        <div class="sf-toolbar-info-piece">
            <b>Peak memory usage</b>
            <span><?php echo e($data['memory']); ?> MB</span>
        </div>

    <?php $__env->endSlot(); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/collectors/time.blade.php ENDPATH**/ ?>