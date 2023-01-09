<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index(){
        $data['title'] = "List Designation";
        $data['title2'] = "Add Designation";
        $data['designations'] = Designation::all();
        return setPageContent('hr.designation.list-Designation',$data);
    }


    public function create(){

    }


    public function edit($id){

        $data['title'] = "Update Designation";

        $data['designation'] = Designation::find($id);

        return setPageContent('hr.designation.edit',$data);
    }


    public function toggle($id){

        $this->toggleState(Designation::find($id));

        return redirect()->route('designation.index')->with('success','Operation Successful');

    }


    public function store(Request $request){

        $request->validate(Designation::$validation);

        Designation::create($request->only(Designation::$fields));

        return redirect()->route('designation.index')->with('success','Operation Successful');

    }


    public function update(Request $request, $id){

        $request->validate(Designation::$validation);

        Designation::find($id)->update($request->only(Designation::$fields));

        return redirect()->route('designation.index')->with('success','Operation Successful');
    }
}
