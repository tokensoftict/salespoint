<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Scale;
use Illuminate\Http\Request;

class ScaleController extends Controller
{
    public function index(){
        $data['title'] = "List Scale";
        $data['title2'] = "Add Scale";
        $data['scales'] = Scale::all();
        return setPageContent('hr.scale.list-scale',$data);
    }


    public function create(){

    }


    public function edit($id){

        $data['title'] = "Update Scale";

        $data['scale'] = Scale::find($id);

        return setPageContent('hr.scale.edit',$data);
    }


    public function toggle($id){

        $this->toggleState(Scale::find($id));

        return redirect()->route('scale.index')->with('success','Operation Successful');

    }


    public function store(Request $request){

        $request->validate(Scale::$validation);

        Scale::create($request->only(Scale::$fields));

        return redirect()->route('scale.index')->with('success','Operation Successful');

    }


    public function update(Request $request, $id){

        $request->validate(Scale::$validation);

        Scale::find($id)->update($request->only(Scale::$fields));

        return redirect()->route('scale.index')->with('success','Operation Successful');
    }
}
