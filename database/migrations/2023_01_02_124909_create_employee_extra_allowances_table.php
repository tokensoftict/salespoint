<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeExtraAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_extra_allowances', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('allowance_id')->constrained()->cascadeOnDelete();
            $table->double('percent', 10, 2)->default(0);
            $table->integer("tenure")->default(1);
            $table->decimal('amount', 20, 2)->default(0);
            $table->decimal('total_amount', 20, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['0','1','2'])->default('0')->comment('0=Pending Approval, 1=Approved, 2=Completed');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('employee_extra_allowances');
    }
}
