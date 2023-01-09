<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use Illuminate\Http\Request;

class AllowanceController extends Controller
{
    public function index(){
        $data['title'] = "List Allowance";
        $data['title2'] = "Add Allowance";
        $data['allowances'] = Allowance::all();
        return setPageContent('payroll.allowance.list-Allowance',$data);
    }


    public function create(){

    }


    public function edit($id){

        $data['title'] = "Update Allowance";

        $data['allowance'] = Allowance::find($id);

        return setPageContent('payroll.allowance.edit',$data);
    }


    public function toggle($id){

        $this->toggleState(Allowance::find($id));

        return redirect()->route('allowance.index')->with('success','Operation Successful');

    }


    public function store(Request $request){

        $request->validate(Allowance::$validation);

        Allowance::create($request->only(Allowance::$fields));

        return redirect()->route('allowance.index')->with('success','Operation Successful');

    }


    public function update(Request $request, $id){

        $request->validate(Allowance::$validation);

        Allowance::find($id)->update($request->only(Allowance::$fields));

        return redirect()->route('allowance.index')->with('success','Operation Successful');
    }
}
