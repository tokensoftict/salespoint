<!-- Start of Telescope Toolbar widget !-->
<div id="sfwdt<?php echo e($token); ?>" class="sf-toolbar sf-display-none"></div>

<script <?php if(isset($csp_script_nonce) && $csp_script_nonce): ?> nonce="<?php echo e($csp_script_nonce); ?>" <?php endif; ?>>/*<![CDATA[*/
  (function () {
    Sfjs.loadToolbar('<?php echo e($token); ?>');
  })();
/*]]>*/</script>
<!-- End of Telescope Toolbar widget !-->
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/vendor/fruitcake/laravel-telescope-toolbar/src/../resources/views/widget.blade.php ENDPATH**/ ?>