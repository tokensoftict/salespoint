<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="ui-container">

        <div class="row">
            <?php if(!isset($transfer->id)): ?>
                <div class="col-md-8">
                    <section class="panel">
                        <?php if(session('success')): ?>
                            <?php echo alert_success(session('success')); ?>

                        <?php elseif(session('error')): ?>
                            <?php echo alert_error(session('error')); ?>

                        <?php endif; ?>

                        <div class="panel-body">
                            <form action="" method="post">
                                <?php echo e(csrf_field()); ?>

                                <br/>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Transfer From</label>
                                        <select required id="store" name="from" class="form-control select2">
                                            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($from == $store->id ? "selected" : ""); ?>  value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Transfer To</label>
                                        <select required id="store" name="to" class="form-control select2">
                                            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option  <?php echo e($to == $store->id ? "selected" : ""); ?>  value="<?php echo e($store->id); ?>"><?php echo e($store->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Select Product Type</label>
                                        <select required id="type" name="type" class="form-control select2">
                                            <?php $__currentLoopData = config('stock_type_name.'.config('app.store')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($_type == $type ? "selected" : ""); ?>  value="<?php echo e($_type); ?>"><?php echo e($key); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-sm btn-primary"  style="margin-top: 25px;" type="submit">Go</button>
                                    </div>
                                </div>
                                <br/>
                            </form>
                        </div>

                    </section>
                </div>
            <?php endif; ?>
            <?php
                if(isset($from) && isset($to) && isset($type)){
            ?>
            <div class="col-md-12" >
                <section class="panel">
                    <div class="panel-heading">
                        <?php echo e($title); ?>

                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form action="" onsubmit="return add_item();">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <label>Select Stock</label>
                                        <select class="form-control" name="stock" id="products" placeholder="Search for Product"></select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Available Quantity</label>
                                        <span type="text"  class="form-control" id="av_qty"></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Quantity</label>
                                        <input type="number" max="0" class="form-control" id="qty"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-sm btn-primary" style="margin-top: 25px;" type="submit">Add Stock</button>
                                    </div>
                                </div>
                                <br/>
                            </form>
                            <br/>
                            <?php if(isset($transfer->id)): ?>
                                <form onsubmit="return checkform()" action="<?php echo e(route('stocktransfer.update',$transfer->id)); ?>" enctype="multipart/form-data" method="post">
                                    <?php echo e(method_field('PUT')); ?>

                            <?php else: ?>
                                <form onsubmit="return checkform()" action="" enctype="multipart/form-data" method="post">
                             <?php endif; ?>
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="from" value="<?php echo e($from); ?>"/>
                                <input type="hidden" name="to" id="to" value="<?php echo e($to); ?>"/>
                                <input type="hidden" name="type" id="type" value="<?php echo e($type); ?>"/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3 col-lg-offset-9">
                                            <label>Transfer Date</label>
                                            <input class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-dd"   name="transfer_date" value="<?php echo e(date('Y-m-d',strtotime($transfer->transfer_date))); ?>"/>
                                            <?php if($errors->has('date_created')): ?>
                                                <label for="name-error" class="error"
                                                       style="display: inline-block;"><?php echo e($errors->first('date_created')); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br/>  <br/>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th class="text-left">Name</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-right">Cost Price</th>
                                                    <th class="text-right">Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="appender">
                                                <?php $__currentLoopData = $transfer->stock_transfer_items()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <input type="hidden" name="stock_id[]" value="<?php echo e($item->stock_id); ?>"/>
                                                        <input type="hidden" name="qty[]" value="<?php echo e($item->quantity); ?>"/>
                                                        <td><?php echo e($item->stock->name); ?></td>
                                                        <td><?php echo e($item->quantity); ?></td>
                                                        <td><?php echo e($item->cost_price); ?></td>
                                                        <td><?php echo e(number_format( ($item->cost_price * $item->quantity),2)); ?></td>
                                                        <td><button class="btn btn-sm btn-danger" onclick="remove_item(this)">Remove</button></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <th class="text-right">Total</th>
                                                    <th class="text-right" id="total_transfer"><?php echo e(number_format($transfer->total_price,2)); ?></th>
                                                    <td></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <?php if(isset($transfer->id)): ?>
                                                <button class="btn btn-primary btn-sm" type="submit" name="status" value="DRAFT"><i class="fa fa-arrow-right"></i>Update</button>
                                            <?php else: ?>
                                                <button class="btn btn-primary btn-sm" type="submit" name="status" value="DRAFT"><i class="fa fa-arrow-right"></i>Draft Transfer Stock</button>
                                                <button class="btn btn-success btn-sm" type="submit" name="status" value="COMPLETE"><i class="fa fa-arrow-right"></i>Complete Transfer Stock</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            <?php
                }
            ?>

        </div>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/select2/dist/js/select2.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="<?php echo e(asset('assets/js/init-select2.js')); ?>"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="<?php echo e(asset('assets/js/init-datepicker.js')); ?>"></script>

    <script>
        $(document).ready(function(e){
            var path = "<?php echo e(route('findselectstock')); ?>?select2=yes&type=<?php echo e($type); ?>&store=<?php echo e($from); ?>";
            var select =  $('#products').select2({
                placeholder: 'Search for product',
                ajax: {
                    url: path,
                    dataType: 'json',
                    delay: 250,
                    data: function (data) {
                        return {
                            searchTerm: data.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results:response
                        };
                    },
                }
            });


            $("#products").on('change',function(eventData){
                var data = $(this).select2('data');
                data = data[0];

                $('#av_qty').html(data['available_quantity']);
                $('#qty').attr('max',data['available_quantity']);

                $('#qty').attr('data-cost-price',data['cost_price'])
                $('#qty').attr('data-selling-price',data['cost_price'])
            });

        });

        function add_item(){
            if(document.getElementById($("#products option:selected").val()+"-row")){
                $("#qty").val("");
                $("#cost_price").val("");
                alert("Item already exits, Please check and try again");
                return false;
            }

            if(($("#products option:selected").val() ==="") || ($("#qty").val()==="")){
                return false;
            }

            var html= "<tr id='"+$("#products option:selected").val()+"-row'>";
            html+='<input type="hidden" name="stock_id[]" value="'+$("#products option:selected").val()+'"/>';
            html+='<input type="hidden" name="qty[]" value="'+$("#qty").val()+'"/>';
            html+="<td>"+$("#products option:selected").text()+"</td>";
            html += "<td class='text-center'>" + $("#qty").val() + "</td>";
            html+="<td class='text-right'>"+formatMoney($('#qty').attr('data-cost-price'))+"</td>";
            html+="<td class='total_trans text-right' value='"+(parseFloat($('#qty').attr('data-cost-price')) * parseFloat($("#qty").val()))+"' >"+formatMoney(($('#qty').attr('data-cost-price') * parseFloat($("#qty").val())))+"</td>";
            html+='<td><button class="btn btn-sm btn-danger" onclick="remove_item(this)">Remove</button></td>';
            html+="</tr>";

            $("#products").select2("val","");
            $("#qty").val("");
            $("#cost_price").val("");
            $("#appender").append(html);
            total();
            return false;
        }

        function remove_item(btn){
            $(btn).parent().parent().remove();
            total();
        }


        function total(){
            var total =0;
            $('.total_trans').each(function(id,elem){
                total +=parseFloat($(elem).attr('value'));
            })

            $('#total_transfer').html(formatMoney(total));
        }

        function checkform(){
            if($('#appender tr').length === 0){
                alert("Please add at least one item to to continue");
                return false;
            }else{
                $('#save_and_create').attr('disabled','disabled')
            }

            return true
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/salespoint/resources/views/stock/transfer/form.blade.php ENDPATH**/ ?>