<?php
/** @var \Illuminate\Support\Collection|\Laravel\Telescope\EntryResult[] $entries */
$data = $entries->first()->content;

$statusCode = $data['response_status'];
if ($statusCode > 400) {
    $statusColor = 'red';
} elseif ($statusCode > 300) {
    $statusColor = 'yellow';
} else {
    $statusColor = 'green';
}
?>

<?php $__env->startComponent('telescope-toolbar::item', ['name' => 'request', 'link' => true]); ?>

    <?php $__env->slot('icon'); ?>
        <span class="sf-toolbar-status sf-toolbar-status-<?php echo e($statusColor); ?>"><?php echo e($statusCode); ?></span>
        <?php echo file_get_contents('/Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('requests') . '.svg'); ?>
        <span class="sf-toolbar-value sf-toolbar-info-piece-additional"><?php echo e($data['method']); ?> <?php echo e($data['uri']); ?></span>
    <?php $__env->endSlot(); ?>

    <?php $__env->slot('text'); ?>
        <div class="sf-toolbar-info-group">
            <div class="sf-toolbar-info-piece">
                <b>HTTP status</b>
                <span><?php echo e($statusCode); ?></span>
            </div>

            <?php if($data['method'] !== 'GET'): ?>
            <div class="sf-toolbar-info-piece">
                <b>Method</b>
                <span><?php echo e($data['method']); ?></span>
            </div>
            <?php endif; ?>

            <div class="sf-toolbar-info-piece">
                <b>Request URI</b>
                <span title="<?php echo e($data['uri']); ?>"><?php echo e($data['method']); ?> <?php echo e($data['uri']); ?></span>
            </div>

            <div class="sf-toolbar-info-piece">
                <b>Controller Action</b>
                <span>
                    <?php echo e($data['controller_action']); ?>

                </span>
            </div>

            <div class="sf-toolbar-info-piece">
                <b>Middleware</b>
                <span>
                    <?php echo e(implode(', ', array_filter($data['middleware'])) ?: '-'); ?>

                </span>
            </div>

            <?php if(isset($data['response']['view'])): ?>
                <div class="sf-toolbar-info-piece">
                    <b>View</b>
                    <span>
                       <?php echo e(str_replace(base_path(), '', $data['response']['view'])); ?>

                    </span>
                </div>
            <?php elseif(isset($data['response']) && is_string($data['response'])): ?>
                <div class="sf-toolbar-info-piece">
                    <b>Response</b>
                    <span>
                       <?php echo e(\Illuminate\Support\Str::limit($data['response'], 60)); ?>

                    </span>
                </div>
            <?php endif; ?>

        </div>
    <?php $__env->endSlot(); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/collectors/request.blade.php ENDPATH**/ ?>