<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\SalesRepresentative;
use Illuminate\Http\Request;

class SalesRepresentativeController extends Controller
{
    public function index(){
        $data['title'] = "List Sales Representatives";
        $data['title2'] = "Add Sales Representatives";
        $data['reps'] = SalesRepresentative::all();
        return setPageContent('settings.sales_representative.list-rep',$data);
    }


    public function create(){

    }



    public function store(Request $request){

        $request->validate(SalesRepresentative::$validate);

        $data = $request->only(SalesRepresentative::$fields);

        $data['status'] = 1;

        SalesRepresentative::create($data);

        return redirect()->route('sales_representative.index')->with('success','Sales Representative as been created successful!');
    }


    public function toggle($id){

        $this->toggleState(SalesRepresentative::find($id));

        return redirect()->route('sales_representative.index')->with('success','Operation successful!');
    }


    public function edit($id){
        $data['title'] = "Update Sales Representative";
        $data['rep'] = SalesRepresentative::find($id);
        return setPageContent('settings.sales_representative.edit',$data);
    }

    public function update(Request $request, $id){

        $request->validate(SalesRepresentative::$validate);

        $data = $request->only(SalesRepresentative::$fields);

        SalesRepresentative::find($id)->update($data);

        return redirect()->route('sales_representative.index')->with('success','Sales Representative as been updated successful!');

    }

}
