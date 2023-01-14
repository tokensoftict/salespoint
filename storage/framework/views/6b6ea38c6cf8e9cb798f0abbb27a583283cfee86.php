<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>

    <div class="ui-container">
        <?php if(isset($stock->id)): ?>
            <form role="form"  action="<?php echo e(route('stock.update',$stock->id)); ?>" enctype="multipart/form-data" method="post">
                <?php echo e(method_field('PUT')); ?>

        <?php else: ?>
            <form role="form"  action="<?php echo e(route('stock.store')); ?>" enctype="multipart/form-data" method="post">
       <?php endif; ?>
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-4">
                        <?php if(session('success')): ?>
                            <?php echo alert_success(session('success')); ?>

                        <?php elseif(session('error')): ?>
                            <?php echo alert_error(session('error')); ?>

                        <?php endif; ?>
                        <section class="panel">
                            <header class="panel-heading panel-border">
                                Stock Information
                            </header>
                            <div class="panel-body" >

                                <div class="form-group">
                                    <label>Name <span  style="color:red;">*</span></label>
                                    <div class="input-group col-md-12">
                                        <input type="text" value="<?php echo e(old('name', $stock->name)); ?>" required  class="form-control" id="stock_name" name="name" placeholder="Stock Name"/>
                                        <div class="input-group-btn">
                                            <button onclick="return getImage();" type="button" class="btn btn-primary">Get Image</button>
                                        </div>
                                    </div>
                                    <?php if($errors->has('name')): ?>
                                        <label for="name-error" class="error"
                                               style="display: inline-block;"><?php echo e($errors->first('name')); ?></label>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Stock Type  <span style="color:red;">*</span></label>
                                    <select class="form-control" required name="type">
                                        <?php $__currentLoopData = config('stock_type')[config('app.store')]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e(old('type', $stock->type) == "NORMAL" ? "selected" : ""); ?> value="<?php echo e($type); ?>"><?php echo e($key); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Stock Status  <span style="color:red;">*</span></label>
                                    <select class="form-control" required name="status">
                                        <option <?php echo e(old('status', $stock->status) == "1" ? "selected" : ""); ?> value="1">Enabled</option>
                                        <option <?php echo e(old('status', $stock->status) == "0" ? "selected" : ""); ?> value="0">Disabled</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Stock Code</label>
                                    <input type="text" value="<?php echo e(old('name', $stock->code)); ?>"   class="form-control" name="code" placeholder="Stock Code"/>
                                </div>

                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" value="<?php echo e(old('location', $stock->location)); ?>"   class="form-control" name="location" placeholder="Stock Location"/>
                                </div>

                                <div class="form-group">
                                    <label>Stock Description</label>
                                    <textarea style="height: 100px;" placeholder="Stock Description" class="form-control" name="description"><?php echo e(old('description',$stock->description)); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Manufacturer</label>
                                    <select class="form-control" name="manufacturer_id">
                                        <option value="">-Select Manufacturer-</option>
                                        <?php $__currentLoopData = $manufactures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e(old('manufacturer_id', $stock->manufacturer_id) == $manufacturer->id ? "selected" : ""); ?> value="<?php echo e($manufacturer->id); ?>"><?php echo e($manufacturer->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="product_category_id">
                                        <option value="">-Select Category-</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e(old('product_category_id', $stock->product_category_id) == $category->id ? "selected" : ""); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Can this Product Expiry  <span style="color:red;">*</span></label>
                                    <select class="form-control" id="expire_stock" name="expiry">
                                        <option <?php echo e(old('expiry', $stock->type) == "0" ? "selected" : ""); ?> value="0">No</option>
                                        <option <?php echo e(old('expiry', $stock->type) == "1" ? "selected" : ""); ?> value="1">Yes</option>
                                    </select>
                                </div>

                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading panel-border">
                                Stock Price Settings
                            </header>
                            <div class="panel-body" >
                                <div class="form-group">
                                    <label>Selling Price <span  style="color:red;">*</span></label>
                                    <input type="number" step="0.00001" value="<?php echo e(old('selling_price',$stock->selling_price)); ?>"   class="form-control" name="selling_price" placeholder="Selling Price"/>
                                </div>

                                <div class="form-group">
                                    <label>Cost Price <span  style="color:red;">*</span></label>
                                    <input type="number" step="0.00001" value="<?php echo e(old('cost_price',$stock->cost_price)); ?>"   class="form-control" name="cost_price" placeholder="Cost Price"/>
                                </div>
                                <?php if(config('app.store') == "inventory"): ?>
                                <div class="form-group">
                                    <label>Yard / Pieces Selling Price</label>
                                    <input type="number" step="0.00001" value="<?php echo e(old('yard_selling_price',$stock->yard_selling_price)); ?>"   class="form-control" name="yard_selling_price" placeholder="Yard Selling Price"/>
                                </div>
                                <div class="form-group">
                                    <label>Yard / Pieces Cost Price</label>
                                    <input type="number" step="0.00001" value="<?php echo e(old('cost_price',$stock->yard_cost_price)); ?>"   class="form-control" name="yard_cost_price" placeholder="Yard Cost Price"/>
                                </div>
                                <?php elseif(config('app.store') == "hotel"): ?>
                                 <div class="form-group">
                                        <label>VIP Selling Price</label>
                                        <input type="number" step="0.00001" value="<?php echo e(old('vip_selling_price',$stock->vip_selling_price)); ?>"   class="form-control" name="vip_selling_price" placeholder="VIP Selling Price"/>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>

                        <?php if(!isset($stock->id)): ?>
                            <section class="panel">
                                <header class="panel-heading panel-border">
                                    Stock Quantity Settings
                                </header>
                                <div class="panel-body" >
                                    <div class="form-group">
                                        <label>Initial Quantity <span  style="color:red;">*</span></label>
                                        <input type="number"  value=""  class="form-control" name="stock_batch[quantity]" placeholder="Initial Quantity"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" name="stock_batch[supplier_id]">
                                            <option value="">-Select Supplier-</option>
                                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option  value="<?php echo e($supplier->id); ?>"><?php echo e($supplier->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('stock_batch.supplier_id')): ?>
                                            <label for="name-error" class="error"
                                                   style="display: inline-block;"><?php echo e($errors->first('stock_batch.supplier_id')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input type="text" value="" id="expiry_date" name="stock_batch[expiry_date]"  data-min-view="2" data-date-format="yyyy-mm-dd" class="form-control datepicker js-datepicker" name="stock_batch[expiry_date]" placeholder="Expiry Date"/>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading panel-border">
                                Stock Barcode
                            </header>
                            <div class="panel-body" >
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <div class="input-group col-md-12">
                                        <input readonly style="background-color: #FFF;color:#000" value="<?php echo e($stock->barcode); ?>" id="text_barcode" type="text" name="barcode" class="form-control">
                                        <div class="input-group-btn">
                                            <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-primary">Capture Barcode</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <header class="panel-heading panel-border">
                                Stock Image
                            </header>
                            <div class="panel-body" >
                                <?php if(isset($stock->image)): ?>
                                    <img src="<?php echo e($stock->image); ?>" id="product_image" class="img-thumbnail"/>
                                    <br/>
                                    <?php else: ?>
                                    <img src="<?php echo e(asset('assets/products.jpg')); ?>" id="product_image" class="img-thumbnail"/>
                                    <br/>
                                 <?php endif; ?>
                                <input type="file" class="form-control" name="image">
                            </div>
                        </section>

                        <section class="panel">

                            <div class="panel-body" >
                                <input class="btn btn-info btn-block btn-lg" type="submit" name="save" value="Save Stock">
                            </div>
                        </section>
                    </div>
                </div>
            </form>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Capture Stock Barcode</h4>
                </div>
                <div class="modal-body">
                    <div class="well" id="barcode"><?php echo e($stock->barcode); ?></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('assets/js/init-datepicker.js')); ?>"></script>
    <script type='text/javascript' src="<?php echo e(asset('assets/js/barcode.js')); ?>"></script>
    <script>
        $(document).ready(function(){

            $(document).scannerDetection({
                timeBeforeScanTest: 200, // wait for the next character for upto 200ms
                endChar: [13], // be sure the scan is complete if key 13 (enter) is detected
                avgTimeByChar: 40, // it's not a barcode if a character takes longer than 40ms
                ignoreIfFocusOn: 'input', // turn off scanner detection if an input has focus
                startChar: [16], // Prefix character for the cabled scanner (OPL6845R)
                endChar: [40],
                onComplete: function(barcode){
                    $('#barcode').html(barcode);
                    $('#text_barcode').val(barcode);
                    setTimeout(function(){
                        $('#myModal').modal('hide');
                    },1200)
                }, // main callback function
                scanButtonKeyCode: 116, // the hardware scan button acts as key 116 (F5)
                scanButtonLongPressThreshold: 5, // assume a long press if 5 or more events come in sequence
                onScanButtonLongPressed: function(){
                    alert('key pressed');
                }, // callback for long pressing the scan button
                onError: function(string){}
            });

            if($("#expire_stock").val() == "0"){
                $("#expiry_date").removeAttr("required").attr("style","display:none").attr("disabled","disabled");
                $("#expiry_date").parent().find('label').attr("style","display:none");
            }else if($("#expire_stock").val() == "1" && $("#expiry_date").attr('style') === "display:none"){
                $("#expiry_date").attr("required","required").removeAttr('style').removeAttr("disabled");
                $("#expiry_date").parent().find('label').removeAttr("style");
            }

            $("#expire_stock").on("change",function(e){
                if($(this).val() == "0"){
                    $("#expiry_date").removeAttr("required").attr("style","display:none").attr("disabled","disabled");
                    $("#expiry_date").parent().find('label').attr("style","display:none");
                }else if($(this).val() == "1" && $("#expiry_date").attr('style') === "display:none"){
                    $("#expiry_date").attr("required","required").removeAttr('style').removeAttr("disabled");
                    $("#expiry_date").parent().find('label').removeAttr("style");
                }
            });

        });


        function getImage(){
            if($('#stock_name').val() !="") {
                $.ajax({
                    url: '<?php echo e(route('findimage')); ?>' + '?name=' + $('#stock_name').val(),
                    method: 'GET',
                    success: function (returnData) {
                        if (returnData.status == true) {
                            alert('Image Found');
                            $('#product_image').attr('src', returnData.link);
                        } else {
                            alert('image not found!');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('An error occurred, unable to fetch image')
                    }
                });
            }else{
                alert('Please enter stock name');
            }
        }

     </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/stock/form.blade.php ENDPATH**/ ?>