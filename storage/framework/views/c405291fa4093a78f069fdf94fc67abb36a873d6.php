<div class="sf-toolbar-block sf-toolbar-block-<?php echo e($name); ?> sf-toolbar-status-<?php echo e($status ?? 'normal'); ?> <?php echo e($additional_classes ?? ''); ?>" <?php echo $block_attrs ?? ''; ?>>
    <?php if(isset($link) && $link): ?> <a href="<?php echo e(is_string($link) ? $link : route('telescope-toolbar.show', ['token' => $token, 'tab' => $name])); ?>"  target="_telescope"><?php endif; ?>
        <div class="sf-toolbar-icon"><?php echo e($icon ?? ''); ?></div>
        <?php if(isset($link) && $link): ?></a><?php endif; ?>
    <div class="sf-toolbar-info"><?php echo e($text ?? ''); ?></div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/item.blade.php ENDPATH**/ ?>