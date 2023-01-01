<?php

namespace App\Http\Controllers\InvoiceAndSales;

use App\Models\BankAccount;
use App\Models\Payment;
use App\Models\SalesRepresentative;
use PDF;
use App\Classes\Settings;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    protected $settings;

    public function __construct(Settings $_settings){
        $this->settings = $_settings;
    }


    public function draft_invoice(){

    }

    public function complete_invoice(){

    }

    public function new(){
        $data = [];
        $data['customers'] = Customer::all();
        $data['payments'] = PaymentMethod::all();
        $data['banks'] = BankAccount::where('status',1)->get();
        $data['reps'] = SalesRepresentative::where('status',1)->get();
        return setPageContent('invoice.new-invoice',$data);
    }

    public function draft(){
        $data = [];
        $data['title'] = 'Draft Invoice List';
        $data['invoices'] = Invoice::with(['created_user','customer'])->where('warehousestore_id', getActiveStore()->id)->where('status','DRAFT')->where('invoice_date',date('Y-m-d'))->get();
        return setPageContent('invoice.draft-invoice',$data);
    }

    public function paid(){
        $data = [];
        $data['title'] = 'Completed Invoice List';
        $data['invoices'] = Invoice::with(['created_user','customer'])->where('warehousestore_id', getActiveStore()->id)->where('status','COMPLETE')->where('invoice_date',date('Y-m-d'))->get();
        return setPageContent('invoice.paid-invoice',$data);
    }

    public function update(Request $request, $id){
        $invoice = Invoice::findorfail($id);

        $reports = Invoice::validateInvoiceUpdateProduct(json_decode($request->get('data'),true),'quantity', $invoice);

        if($reports['status'] == true) return response()->json(['status'=>false,'error'=>$reports['errors']]);

        $reports = Invoice::validateDepositPaymentUsage($reports,$id);

        if($reports['status'] == true) return response()->json(['status'=>false,'error'=>$reports['errors']]);

        $invoice = Invoice::updateInvoice($request,$reports, $invoice);

        if($request->get('payment') !== "false" && $request->get('status') == 'COMPLETE'){
            $payment_info = session()->get("payment_info");
            session()->forget("payment_info");
            $payment = Payment::createPayment(['invoice'=>$invoice,'payment_info'=>$request->get('payment'), "type"=>"Invoice","update"=>$payment_info]);

            $invoice->payment_id = $payment->id;

            $invoice->total_amount_paid = $payment->total_paid;

            $invoice->update();
        }

        $success_view = view('invoice.success-updated',['invoice_id'=> $invoice->id])->render();

        return json(['status'=>true,'html'=>$success_view]);
    }

    public function create(Request $request){

        $reports = Invoice::validateInvoiceProduct(json_decode($request->get('data'),true),'quantity');    // validate products if the quantity is okay

        if($reports['status'] == true) return response()->json(['status'=>false,'error'=>$reports['errors']]);

        $reports = Invoice::validateDepositPaymentUsage($reports);

        if($reports['status'] == true) return response()->json(['status'=>false,'error'=>$reports['errors']]);

        $invoice = Invoice::createInvoice($request,$reports, false);

        if($request->get('payment') !== "false" && $request->get('status') == 'COMPLETE'){

            $payment = Payment::createPayment(['invoice'=>$invoice,'payment_info'=>json_decode($request->get('payment'),true),"type"=>"Invoice"]);

            $invoice->payment_id = $payment->id;

            $invoice->total_amount_paid = $payment->total_paid;

            $invoice->update();

        }

        $success_view = view('invoice.success',['invoice_id'=> $invoice->id])->render();

        return json(['status'=>true,'html'=>$success_view]);
    }


    public function print_pos($id){
        $data = [];
        $invoice = Invoice::with(['created_by','customer','invoice_items','paymentMethodTable'])->findorfail($id);
        if($invoice->payment_id != NULL)
        {
            $invoice->load('paymentMethodTable');
        }
        $data['invoice'] =$invoice;
        $data['store'] =  $this->settings->store();
        $page_size = $invoice->invoice_items()->get()->count() * 15;
        $page_size += 180;
        $pdf = PDF::loadView('print.pos', $data,[],[
            'format' => [80,$page_size],
            'margin_left'          => 0,
            'margin_right'         => 0,
            'margin_top'           => 0,
            'margin_bottom'        => 0,
            'margin_header'        => 0,
            'margin_footer'        => 0,
            'orientation'          => 'P',
            'display_mode'         => 'fullpage',
            'custom_font_dir'      => '',
            'custom_font_data' 	   => [],
            'default_font_size'    => '12',
        ]);

        return $pdf->stream('document.pdf');
    }

    public function print_afour($id){
        $data = [];
        $invoice = Invoice::with(['created_by','customer','invoice_items'])->findorfail($id);
        $data['invoice'] = $invoice;
        $data['store'] =  $this->settings->store();
        $pdf = PDF::loadView("print.pos_afour",$data);
        return $pdf->stream('document.pdf');
    }

    public function print_way_bill($id){
        $data = [];
        $invoice = Invoice::with(['created_by','customer','invoice_items'])->findorfail($id);
        $data['invoice'] = $invoice;
        $data['store'] =  $this->settings->store();
        $pdf = PDF::loadView("print.pos_afour_waybill",$data);
        return $pdf->stream('document.pdf');
    }


    public function view($id){
        $data = [];
        $data['title'] = 'View Invoice';
        $data['payments'] = PaymentMethod::all();
        $data['banks'] = BankAccount::where('status',1)->get();
        $data['invoice'] = Invoice::with(['created_by','customer','invoice_items'])->findorfail($id);
        return setPageContent('invoice.view',$data);
    }


    public function complete_invoice_no_edit($id, Request $request)
    {
        $invoice = Invoice::findorfail($id);
        if($invoice->status == "COMPLETE") return redirect()->route('invoiceandsales.view',$id)->with('success','Invoice has been completed successfully!');

        $payment = Payment::createPayment(['invoice'=>$invoice,'payment_info'=>$request,"type"=>"Invoice"]);

        $invoice->payment_id = $payment->id;

        $invoice->status = "COMPLETE";

        $invoice->total_amount_paid = $payment->total_paid;

        $invoice->update();


        return redirect()->route('invoiceandsales.view',$id)->with('success','Invoice has been completed successfully!');
    }

    public function edit($id){
        $data = [];
        $data['customers'] = Customer::all();
        $data['payments'] = PaymentMethod::all();
        $data['invoice'] = Invoice::with(['created_by','customer','invoice_items','payment'])->findorfail($id);
        $data['banks'] = BankAccount::where('status',1)->get();
        $data['reps'] = SalesRepresentative::where('status',1)->get();
        return setPageContent('invoice.update-invoice',$data);
    }


    public function destroy($id){
        $invoice = Invoice::findorfail($id);

        if($invoice->status == "DRAFT")
            $invoice->delete();

        return redirect()->route('invoiceandsales.draft')->with('success','Invoice has been deleted successfully');

    }


    public function return_invoice(){
        $data = [];
        $data['customers'] = Customer::all();
        $data['payments'] = PaymentMethod::all();
        $data['banks'] = BankAccount::where('status',1)->get();
        return setPageContent('invoice.new-return-invoice',$data);
    }

    public function add_return_invoice(Request $request){

        $reports = Invoice::validateReturnInvoiceProduct(json_decode($request->get('data'),true),'quantity',$request);

        if($reports['status'] == true) return response()->json(['singleError'=>$reports['singleError'],'status'=>false,'error'=>false]);

        $invoice = Invoice::ReturnInvoice($request,$reports);

        if($request->get('payment') !== "false" && $request->get('status') == 'COMPLETE'){

            $payment = Payment::createPayment(['invoice'=>$invoice,'payment_info'=>json_decode($request->get('payment'),true),"type"=>"Invoice"]);

            $invoice->payment_id = $payment->id;

            $invoice->total_amount_paid = $payment->total_paid;

            $invoice->update();

        }


        $success_view = view('invoice.return-success',['invoice_id'=> $invoice->id])->render();

        return json(['status'=>true,'html'=>$success_view]);

    }

}
