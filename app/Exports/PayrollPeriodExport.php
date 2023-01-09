<?php

namespace App\Exports;

use App\Models\PayrollPeriod;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollPeriodExport implements FromCollection, WithHeadings
{
    var $period;

    function __construct(PayrollPeriod $payrollPeriod)
    {
        $this->period = $payrollPeriod;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $beneficieries = [];

        foreach ($this->period->payslips as $payslip)
        {
            $beneficieries[] = array(
                $payslip->employee->employee_no,
                $payslip->employee->name,
                $payslip->scale->name,
                $payslip->gross_pay,
                $payslip->total_deduction,
                $payslip->net_pay,
                $payslip->bank->name,
                $payslip->account_name,
                $payslip->account_no
            );
        }

        return collect($beneficieries);
    }

    public function headings(): array
    {
        return [
            'Employee No',
            'Name',
            'Scale',
            'Gross Pay',
            'Total Deduction',
            'Net Pay',
            'Bank',
            'Bank Account Name',
            'Bank Account No'
        ];

    }
}
