<?php
/**
 * @var \Illuminate\Support\Collection|\Laravel\Telescope\EntryResult[] $entries
 */

$info = 0;
$warnings = 0;
$errors = 0;
$total = 0;

$levels = [];
foreach ($entries as $entry) {
    $level = $entry->content['level'];

    if (in_array($level, ['debug', 'info'])) {
        $info++;
    } elseif (in_array($level, ['notice', 'warning'])) {
        $warnings++;
    } else {
        $errors++;
    }

    if (!isset($levels[$entry->content['level']])) {
        $levels[$entry->content['level']] = 0;
    }
    $levels[$entry->content['level']]++;

    $total++;
}

if ($errors) {
    $statusColor = 'red';
} elseif ($warnings) {
    $statusColor = 'yellow';
} else {
    $statusColor = null;
}

?>
<?php $__env->startComponent('telescope-toolbar::item', ['name' => 'logs ', 'link' => true, 'status' => $statusColor]); ?>

    <?php $__env->slot('icon'); ?>
        <?php echo file_get_contents('/Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('logs') . '.svg'); ?>

        <span class="sf-toolbar-value"><?php echo e($total); ?></span>

    <?php $__env->endSlot(); ?>

    <?php $__env->slot('text'); ?>

        <div class="sf-toolbar-info-piece">
            <table class="sf-toolbar-previews">
                <thead>
                <tr>
                    <th>Details</th>
                    <th>Level</th>
                    <th>Message</th>
                </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr >
                        <td>
                            <a href="<?php echo e(route('telescope')); ?>/logs/<?php echo e($entry->id); ?>" target="_telescope">
                                view
                            </a>
                        </td>

                        <td>
                            <?php echo e($entry->content['level']); ?>

                        </td>

                        <td title="<?php echo e($entry->content['message']); ?>">
                            <?php echo e(\Illuminate\Support\Str::limit($entry->content['message'], 90)); ?>

                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
        </div>
    <?php $__env->endSlot(); ?>


<?php echo $__env->renderComponent(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/collectors/logs.blade.php ENDPATH**/ ?>