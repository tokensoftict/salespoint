<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $data['title'] = "List Department";
        $data['title2'] = "Add Department";
        $data['departments'] = Department::all();
        return setPageContent('hr.department.list-department',$data);
    }


    public function create(){

    }


    public function edit($id){

        $data['title'] = "Update Department";

        $data['department'] = Department::find($id);

        return setPageContent('hr.Department.edit',$data);
    }


    public function toggle($id){

        $this->toggleState(Department::find($id));

        return redirect()->route('department.index')->with('success','Operation Successful');

    }


    public function store(Request $request){

        $request->validate(Department::$validation);

        Department::create($request->only(Department::$fields));

        return redirect()->route('department.index')->with('success','Operation Successful');

    }


    public function update(Request $request, $id){

        $request->validate(Department::$validation);

        Department::find($id)->update($request->only(Department::$fields));

        return redirect()->route('department.index')->with('success','Operation Successful');
    }

}
