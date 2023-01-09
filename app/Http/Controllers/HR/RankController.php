<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index(){
        $data['title'] = "List Rank";
        $data['title2'] = "Add Rank";
        $data['ranks'] = Rank::all();
        return setPageContent('hr.rank.list-rank',$data);
    }


    public function create(){

    }


    public function edit($id){

        $data['title'] = "Update Rank";

        $data['rank'] = Rank::find($id);

        return setPageContent('hr.rank.edit',$data);
    }


    public function toggle($id){

        $this->toggleState(Rank::find($id));

        return redirect()->route('rank.index')->with('success','Operation Successful');

    }


    public function store(Request $request){

        $request->validate(Rank::$validation);

        Rank::create($request->only(Rank::$fields));

        return redirect()->route('rank.index')->with('success','Operation Successful');

    }


    public function update(Request $request, $id){

        $request->validate(Rank::$validation);

        Rank::find($id)->update($request->only(Rank::$fields));

        return redirect()->route('rank.index')->with('success','Operation Successful');
    }
}
