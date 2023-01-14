<?php
/**
 * @var \Illuminate\Support\Collection|\Laravel\Telescope\EntryResult[] $entries
 */

$num_queries = 0;
$num_slow = 0;
$query_time = 0;
$queries = [];
foreach ($entries as $query) {
    $num_queries++;
    if ($query->content['slow'] ?? false) {
        $num_slow++;
    }
    $query_time += (float) str_replace(',', '', $query->content['time']) ?? 0;
    $queries[$query->content['hash'] ?? $query->content['sql']] = $query->content['sql'];
}

$num_duplicated = $num_queries - count($queries);
if ($num_queries > 0 && $num_duplicated > $num_queries *.75) {
    $statusColor = 'yellow';
} else {
    $statusColor = null;
}
?>
<?php $__env->startComponent('telescope-toolbar::item', ['name' => 'queries', 'link' => true, 'status' => $statusColor, 'additional_classes' => 'sf-toolbar-block-fullwidth']); ?>

    <?php $__env->slot('icon'); ?>
        <?php echo file_get_contents('/Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('queries') . '.svg'); ?>

        <span class="sf-toolbar-value"><?php echo e($num_queries); ?></span>

        <span class="sf-toolbar-info-piece-additional-detail">
            <span class="sf-toolbar-label">in</span>
            <span class="sf-toolbar-value"><?php echo e(round($query_time)); ?></span>
            <span class="sf-toolbar-label">ms</span>
        </span>

    <?php $__env->endSlot(); ?>

    <?php $__env->slot('text'); ?>

        <table class="sf-toolbar-previews">
            <thead>
            <tr>
                <th>Query<br/><small><?php echo e($num_queries); ?> queries, <?php echo e($num_duplicated); ?> of which are duplicated and <?php echo e($num_slow); ?> slow.</small></th>
                <th style="width: 30px">Duration<br/><small><?php echo e(number_format($query_time, 2)); ?> ms</small></th>
            </tr>
            </thead>

            <tbody>
            <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $query): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php ($path = str_replace(base_path(), '', $query->content['file'])); ?>
                <tr>
                    <td class="monospace sf-query">
                        <?php echo e($query->content['sql']); ?>

                    </td>

                    <td title="<?php echo e($path); ?>:<?php echo e($query->content['line']); ?>">
                        <?php echo e(number_format((float) str_replace(',', '', $query->content['time']), 2)); ?>ms<br/>
                        <small><?php echo e(strlen($path) > 32 ? '..' . substr($path, -30) : $path); ?>:<?php echo e($query->content['line']); ?></small>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>

    <?php $__env->endSlot(); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/collectors/queries.blade.php ENDPATH**/ ?>