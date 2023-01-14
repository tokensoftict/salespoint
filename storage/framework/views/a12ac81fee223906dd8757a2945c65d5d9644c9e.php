<?php if(userCanView("stock.available_custom") && auth()->user()->warehousestore_id === NULL): ?>
    <span class="tools pull-right" style="margin-right: 30px">
                                  <div class="form-group">
                                      <label>Switch Store</label>
                                      <select class="form-control form-control-lg change_store col-sm-3" name="global_filter_store">
                                            <?php $__currentLoopData = getStores(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option <?php echo e($_store->id == realActiveStore() ?  "selected" : ""); ?>  <?php echo e($_store->id == request()->get("global_filter_store") ? "selected" : ""); ?> value="<?php echo e($_store->id); ?>"><?php echo e($_store->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>

                                  </div>
                            </span>
    <br/> <br/>
    <script>
        window.onload = function()
        {
            $(document).ready(function(){
                $('.change_store').on("change",function(){
                    const location = window.location.href.split("?")[0];
                    window.location = location+"?global_filter_store="+$(this).val()
                })
            });
        }
    </script>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/components/store-selector.blade.php ENDPATH**/ ?>