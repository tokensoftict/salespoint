<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_periods', function (Blueprint $table) {
            $table->id();
            $table->date('period')->unique();
            $table->integer('employee_count')->unsigned()->default(0);
            $table->enum('status', ['1', '2', '3'])->default('1')->index()->comment('1=pending, 2=approved, 3=closed');
            $table->decimal('gross_pay', 20, 2)->default(0);
            $table->decimal('gross_deduction', 20, 2)->default(0);
            $table->decimal('net_pay', 20, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_periods');
    }
}
