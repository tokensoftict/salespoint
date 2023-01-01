<?php

namespace App\Http\Controllers\Deposits;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\CustomerDepositsHistory;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use PDF;

class CustomerDepositController extends Controller
{


    public function index(){
        $data['title'] = "List Deposits";
        $data['deposits'] = CustomerDepositsHistory::with(['customer','user','payment_method'])->where('deposit_date',dailyDate())->get();
        return setPageContent('deposit.list',$data);
    }



    public function create(){
        $data['title'] = "New Deposit";
        $data['deposit'] = new CustomerDepositsHistory();
        $data['customers'] = Customer::select('id','firstname','lastname')->get();
        $data['payments'] = PaymentMethod::where('status',1)->where('id','<>',4)->get();
        $data['banks'] = BankAccount::all();
        return setPageContent('deposit.new',$data);
    }


    public function store(Request $request){

        $request->validate(CustomerDepositsHistory::$validate);

        $data = $request->only(CustomerDepositsHistory::$fields);

        $data['user_id'] = auth()->id();

        CustomerDepositsHistory::create($data);

        return redirect()->route('deposits.index')->with('success','Deposit as been saved successful!');
    }


    public function edit($id){

        $data['title'] = "Update Deposit";

        $data['deposit'] = CustomerDepositsHistory::findorfail($id);

        $data['customers'] = Customer::select('id','firstname','lastname')->get();

        $data['payments'] = PaymentMethod::where('status',1)->where('id','<>',4)->get();

        $data['banks'] = BankAccount::all();

        return setPageContent('deposit.new',$data);
    }


    public function update(Request $request, $id){

        $request->validate(CustomerDepositsHistory::$validate);

        $data = $request->only(CustomerDepositsHistory::$fields);

        CustomerDepositsHistory::findorfail($id)->update($data);

        return redirect()->route('deposits.index')->with('success','Deposit as been updated successful!');

    }


    public function destroy($id){

        $ex = CustomerDepositsHistory::findorfail($id);

        $ex->delete();

        return redirect()->route('deposits.index')->with('success','Deposit as been deleted successful!');

    }

    public function monthly_report(Request $request){
        if($request->get('from') && $request->get('to')){
            $data['from'] = $request->get('from');
            $data['to'] = $request->get('to');
        }else{
            $data['from'] = date('Y-m-01');
            $data['to'] = date('Y-m-t');
        }
        $data['title'] = "Deposits Report";
        $data['deposits'] = CustomerDepositsHistory::with(['customer','user','payment_method'])
            ->whereBetween('deposit_date',[ $data['from'],$data['to']])
            ->get();
        return setPageContent('deposit.monthly_report',$data);
    }


    public function monthly_report_by_customer(Request $request){
        if($request->get('from') && $request->get('to') && $request->get('customer_id')){
            $data['from'] = $request->get('from');
            $data['to'] = $request->get('to');
            $data['customer'] = $request->get('customer_id');
        }else{
            $data['from'] = date('Y-m-01');
            $data['to'] = date('Y-m-t');
            $data['customer'] = 1;
        }
        $data['title'] = "Deposits Report";
        $data['customers'] = Customer::all();
        $data['deposits'] = CustomerDepositsHistory::with(['customer','user','payment_method'])
            ->whereBetween('deposit_date',[ $data['from'],$data['to']])
            ->where('customer_id', $data['customer'])
            ->get();
        return setPageContent('deposit.monthly_report_by_customer',$data);
    }



    public function print_afour($id){
        $data = [];
        $deposit = CustomerDepositsHistory::with(['user','customer','paymentMethodTable'])->findorfail($id);
        $data['deposit'] = $deposit;
        $data['store'] =  $this->settings->store();
        $pdf = PDF::loadView("print.pos_deposit",$data);
        return $pdf->stream('document.pdf');
    }


}
