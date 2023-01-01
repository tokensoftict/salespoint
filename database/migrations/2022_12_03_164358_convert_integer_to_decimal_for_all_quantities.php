<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConvertIntegerToDecimalForAllQuantities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stockbatches', function (Blueprint $table) {

            $table->decimal("quantity",20,5)->change();
            $table->decimal("yard_quantity",20,5)->change();

        });

        Schema::table('stock_log_items', function (Blueprint $table) {
            $table->decimal("quantity",20,5)->change();
        });

        Schema::table('stock_log_operations', function (Blueprint $table) {
            $table->decimal("quantity",20,5)->change();
        });

        Schema::table('stock_taking_items', function (Blueprint $table) {
            $table->decimal("available_quantity",20,5)->change();
            $table->decimal("available_yard_quantity",20,5)->change();
            $table->decimal("counted_available_quantity",20,5)->change();
            $table->decimal("counted_yard_quantity",20,5)->change();
            $table->decimal("available_quantity_diff",20,5)->change();
            $table->decimal("available_yard_quantity_diff",20,5)->change();
        });

        Schema::table('stock_transfer_items', function (Blueprint $table) {
            $table->decimal("quantity",20,5)->change();
        });

        Schema::table('invoice_item_batches', function (Blueprint $table) {
            $table->decimal("quantity",20,5)->change();
        });

        Schema::table('invoice_items', function (Blueprint $table) {
            $table->decimal("quantity",20,5)->change();
        });

        Schema::table('purchase_order_items', function (Blueprint $table) {
            $table->decimal("qty",20,5)->change();
        });

        Schema::table('return_logs', function (Blueprint $table) {
            $table->decimal("quantity_before",20,5)->change();
            $table->decimal("quantity_after",20,5)->change();
            $table->decimal("dif",20,5)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stockbatches', function (Blueprint $table) {
            //
        });
    }
}
