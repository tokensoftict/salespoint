<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalesRepInvoiceTableAndPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("invoices", function (Blueprint $table) {
            $table->foreignId("sales_representative_id")->nullable()->after("customer_id")->constrained()->nullOnDelete();
        });

        Schema::table("payments", function (Blueprint $table) {
            $table->foreignId("sales_representative_id")->nullable()->after("customer_id")->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("invoices", function (Blueprint $table) {
             $table->dropConstrainedForeignId("sales_representative_id");
        });

        Schema::table("payments", function (Blueprint $table) {
            $table->dropConstrainedForeignId("sales_representative_id");
        });
    }
}
