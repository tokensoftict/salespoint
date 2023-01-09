<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    public function index(){
        $data['title'] = "List Deduction";
        $data['title2'] = "Add Deduction";
        $data['deductions'] = Deduction::all();
        return setPageContent('payroll.deduction.list-Deduction',$data);
    }


    public function create(){

    }


    public function edit($id){

        $data['title'] = "Update Deduction";

        $data['deduction'] = Deduction::find($id);

        return setPageContent('payroll.deduction.edit',$data);
    }


    public function toggle($id){

        $this->toggleState(Deduction::find($id));

        return redirect()->route('deduction.index')->with('success','Operation Successful');

    }


    public function store(Request $request){

        $request->validate(Deduction::$validation);

        Deduction::create($request->only(Deduction::$fields));

        return redirect()->route('deduction.index')->with('success','Operation Successful');

    }


    public function update(Request $request, $id){

        $request->validate(Deduction::$validation);

        Deduction::find($id)->update($request->only(Deduction::$fields));

        return redirect()->route('deduction.index')->with('success','Operation Successful');
    }
}
