<?php
/**
 * @var \Illuminate\Support\Collection|\Laravel\Telescope\EntryResult[] $entries
 */

$views = [];
$total = 0;
foreach ($entries as $entry) {
    $name = $entry->content['name'];

    if (isset($views[$name])) {
        $views[$name]['num']++;
    }

    $views[$name] = [
        'id' => $entry->id,
        'name' => $name,
        'path' => $entry->content['path'] ?? '',
        'num' => 1,
    ];
    $total++;
}

$views = collect($views)->reverse();

?>
<?php $__env->startComponent('telescope-toolbar::item', ['name' => 'views', 'link' => true]); ?>

    <?php $__env->slot('icon'); ?>
        <?php echo file_get_contents('/Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/resources/icons/' . basename('views') . '.svg'); ?>

        <span class="sf-toolbar-value"><?php echo e($total); ?></span>

    <?php $__env->endSlot(); ?>

    <?php $__env->slot('text'); ?>

        <div class="sf-toolbar-info-piece">
            <table class="sf-toolbar-previews">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Path</th>
                        <th>Num</th>
                    </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $views; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr >
                        <td>
                            <a href="<?php echo e(route('telescope')); ?>/views/<?php echo e($view['id']); ?>" target="_telescope">
                                <?php echo e(\Illuminate\Support\Str::limit($view['name'], 40)); ?>

                            </a>
                        </td>

                        <td title="<?php echo e($view['path']); ?>">
                            <?php echo e(\Illuminate\Support\Str::limit($view['path'], 40)); ?>

                        </td>

                        <td>
                            <?php echo e($view['num']); ?>

                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
        </div>
    <?php $__env->endSlot(); ?>


<?php echo $__env->renderComponent(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/collectors/views.blade.php ENDPATH**/ ?>