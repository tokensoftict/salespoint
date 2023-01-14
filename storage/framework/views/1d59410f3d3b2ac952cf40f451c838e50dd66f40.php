<?php
/**
 * @var \Illuminate\Support\Collection|\Laravel\Telescope\EntryResult[] $entries
 */

$calls = 0;
$types = [];

foreach ($entries as $entry) {
    $calls++;

    if (!isset($types[$entry->content['type']])) {
        $types[$entry->content['type']] = 0;
    }
    $types[$entry->content['type']]++;
}

?>
<?php $__env->startComponent('telescope-toolbar::item', ['name' => 'queries', 'link' => true]); ?>

    <?php $__env->slot('icon'); ?>
        <?php echo file_get_contents('/Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('cache') . '.svg'); ?>

        <span class="sf-toolbar-value"><?php echo e($calls); ?></span>

        <?php if(isset($types['missed'])): ?>
            <span class="sf-toolbar-info-piece-additional-detail">
                <span class="sf-toolbar-label">(</span><span class="sf-toolbar-value"><?php echo e($types['missed']); ?></span> <span class="sf-toolbar-label">miss)</span>
            </span>
        <?php endif; ?>
    <?php $__env->endSlot(); ?>

    <?php $__env->slot('text'); ?>

           <table class="sf-toolbar-previews">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                    <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td title="<?php echo e($entry->content['key']); ?>">
                                <?php echo e(\Illuminate\Support\Str::limit($entry->content['key'], 60)); ?>

                            </td>
                            <td>
                                <?php echo e($entry->content['type']); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
        </table>

    <?php $__env->endSlot(); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/collectors/cache.blade.php ENDPATH**/ ?>