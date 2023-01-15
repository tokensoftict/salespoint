<?php

namespace App\Http\Controllers\Payroll;

use App\Exports\PayrollPeriodExport;
use App\Http\Controllers\Controller;
use App\Models\Allowance;
use App\Models\Deduction;
use App\Models\EmployeeExtraAllowance;
use App\Models\EmployeeExtraDeduction;
use App\Models\PayrollPeriod;
use App\Models\Payslip;
use Illuminate\Http\Request;
use Excel;

class SalaryPeriodController extends Controller
{

    public function index()
    {
        $data['title'] = "List Periods";
        $data['periods'] = PayrollPeriod::withCount(['payslips'])->orderBy("period","DESC")->get();
        return setPageContent('payroll.periods.list-periods',$data);
    }


    public function run_payroll(PayrollPeriod $payrollPeriod)
    {
        $payrollPeriod->runPayroll();

        return redirect()->route('periods.index')->with('success','Payroll has been run successfully!');
    }


    public function beneficiary(PayrollPeriod $payrollPeriod)
    {
        $data['title'] = "Beneficiaries";
        $data['beneficiaries'] = $payrollPeriod->payslips;
        return setPageContent('payroll.periods.beneficiaries',$data);
    }

    public function export_xls(PayrollPeriod $payrollPeriod)
    {
        return Excel::download(new PayrollPeriodExport($payrollPeriod), "Beneficiaries-".$payrollPeriod->period.'.xlsx');
    }

    public function close_payroll(PayrollPeriod  $payrollPeriod)
    {
        $payrollPeriod->close();

        return redirect()->route('periods.index')->with('success','Payroll has been closed successfully!');
    }

    public function approve_payroll(PayrollPeriod  $payrollPeriod)
    {
        $payrollPeriod->approve();

        return redirect()->route('periods.index')->with('success','Payroll has been approved successfully!');
    }


    public function list_allowance()
    {
        $data['title'] = "List Allowance";
        $data['allowances'] = EmployeeExtraAllowance::with(['employee','allowance'])->where("status","1")->get();
        return setPageContent('payroll.periods.extra_allowance_list',$data);
    }

    public function list_deduction()
    {
        $data['title'] = "List Deduction";
        $data['deductions'] = EmployeeExtraDeduction::with(['employee','deduction'])->where("status","1")->get();;
        return setPageContent('payroll.periods.extra_deduction_list',$data);
    }

/*
    public function export_pdf(PayrollPeriod $payrollPeriod)
    {

    }
*/
    public function extra_deductions(Request $request)
    {

        if($request->method() == "POST")
        {
            EmployeeExtraDeduction::createExtraDeduction($request);
            return redirect()->route('periods.extra_allowance')->with('success','Extra Deduction has been created successfully!');
        }

        $data['deductions'] = Deduction::where("enabled",1)->get();
        $data['title'] = "Add Extra Deduction";
        return setPageContent('payroll.periods.extra_deduction',$data);
    }

    public function extra_allowance(Request $request)
    {
        if($request->method() == "POST")
        {
            EmployeeExtraAllowance::createExtraAllowance($request);
            return redirect()->route('periods.extra_allowance')->with('success','Extra Allowance has been created successfully!');
        }
        $data['title'] = "Add Extra Allowance";
        $data['allowances'] = Allowance::where("enabled",1)->get();
        return setPageContent('payroll.periods.extra_allowance',$data);
    }


    public function  stop_running_deduction(EmployeeExtraDeduction $employeeExtraDeduction)
    {
        $employeeExtraDeduction->stop();
        return redirect()->route('periods.list_deduction')->with('success','Extra Deduction has been stopped successfully!');
    }

    public function stop_running_allowance(EmployeeExtraAllowance $employeeExtraAllowance)
    {
        $employeeExtraAllowance->stop();
        return redirect()->route('periods.list_allowance')->with('success','Extra Allowance has been stopped successfully!');
    }


    public function payslip(PayrollPeriod $payrollPeriod, Payslip $payslip)
    {

        return view("print.payslips",['period'=>$payrollPeriod,"payslip"=>$payslip]);
    }

}
