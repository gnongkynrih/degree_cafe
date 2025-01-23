<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(){
        $tables = Seat::all();
        return view('table.index')->with('tables',$tables);
    }
    public function store(Request $request){
        $request->validate([
            'table_no' =>'required|string|min:1|max:2|unique:seats,table_name'
        ]);
        try{

            $seat = Seat::create([
            'table_name' => $request->table_no,
            'status' => 'active'
            ]);
            return response()->json(['seat' => $seat,
                    'message'=>'Table created successfully'],
                    200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    }
    public function update($id){
        $seat = Seat::findOrFail($id);
        if($seat->status == 'active'){
            $seat->status='inactive';
        }else{
            $seat->status='active';
        }
        // $seat->status = $seat->status == 'active' ? 'inactive' : 'active';
        $seat->save();
        return response()->json(['seat' => $seat,
                'message'=>'Table updated successfully'],
                200);
    }

}
