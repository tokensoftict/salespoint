<?php

namespace Database\Seeders;

use App\Models\PayrollPeriod;
use Illuminate\Database\Seeder;

class PayrollPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PayrollPeriod::create([
            'period' => date("Y-m-01"),
            'employee_count' => 0,
            'status' => 1,
            'gross_pay' => 0,
            'gross_deduction' => 0,
            'net_pay' => 0,
        ]);
    }
}
