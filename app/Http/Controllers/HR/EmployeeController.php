<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Rank;
use App\Models\Scale;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request){
        $data['title'] = "Employee List";
        $data['s'] = $request->search;
        $data['employees'] = Employee::with(['rank','scale','designation'])
            ->where(function($query) use (&$request){
                if($request->search) {
                    $s = explode(" ", $request->search);

                    foreach ($s as $search) {
                        $query->orwhere("employee_no", 'LIKE', '%' . $search . '%');
                        $query->orwhere("surname", 'LIKE', '%' . $search . '%');
                        $query->orwhere("other_names", 'LIKE', '%' . $search . '%');
                    }
                }
            })->paginate(20)->appends(['search'=>$request->search]);
        return setPageContent('hr.employee.list-employee',$data);
    }


    public function create(){

        $data['title'] = "New Employee";
        $data['employee'] = new Employee();
        $data['scales'] = Scale::where("enabled",1)->get();
        $data['designations'] = Designation::where("enabled",1)->get();
        $data['department'] = Department::where("enabled",1)->get();
        $data['ranks'] = Rank::where("enabled",1)->get();
        $data['banks'] = Bank::all();

        return setPageContent('hr.employee.form',$data);

    }


    public function edit($id){

        $data['title'] = "Update Employee";

        $data['scales'] = Scale::where("enabled",1)->get();
        $data['designations'] = Designation::where("enabled",1)->get();
        $data['department'] = Department::where("enabled",1)->get();
        $data['ranks'] = Rank::where("enabled",1)->get();
        $data['banks'] = Bank::all();

        $data['employee'] = Employee::find($id);

        return setPageContent('hr.employee.form',$data);
    }


    public function toggle($id){

        $this->toggleState(Employee::find($id));

        return redirect()->route('employee.index')->with('success','Operation Successful');

    }


    public function store(Request $request){

        $request->validate(Employee::$validation);

        Employee::create($request->only(Employee::$fields));

        return redirect()->route('employee.index')->with('success','Operation Successful');

    }


    public function update(Request $request, $id){

        $request->validate(Employee::$validation);

        Employee::find($id)->update($request->only(Employee::$fields));

        return redirect()->route('employee.index')->with('success','Operation Successful');
    }


}
