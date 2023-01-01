<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDepositsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_deposits_history', function (Blueprint $table) {
            $table->id();
            $table->string("deposit_number",255)->unique();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('warehousestore_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('department')->default('STORE');
            $table->decimal("amount",20,5);
            $table->unsignedBigInteger("created_by")->nullable();
            $table->unsignedBigInteger("last_updated_by")->nullable();
            $table->unsignedBigInteger("payment_method_id")->nullable();
            $table->date("deposit_date");
            $table->time("deposit_time");
            $table->text("description")->nullable();
            $table->timestamps();

            $table->foreign('payment_method_id')->references('id')->on('payment_method')->nullOnDelete();
            $table->foreign('last_updated_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_deposits_history');
    }
}
