<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function showTables(){
        //select * from seats where status in ('active','occupied')
        $seats = Seat::whereIn( 'status',['active','occupied'] )->get();
        return view('sale.show_tables')->with('seats',$seats);
    }

    public function pos(){
        return view('sale.pos');
    }

    public function index($table_no,$id = null){
        $seat = Seat::find($table_no);
        $categories = Category::where('status','=','active')
            ->orderBy('name','asc')->get();
        if($id == null){
            $menus = Menu::where('status','=','active')->orderBy('name','asc')->get();
            $activeLink = 'all';
        }else{
            $menus = Menu::where('category_id','=',$id)
            ->where('status','=','active')
            ->orderBy('name','asc')->get();
            $activeLink = $id;
        }
        return view('sale.index')
            ->with('table_no',$seat->table_name)
            ->with('categories',$categories)
            ->with('menus',$menus)
            ->with('activeLink',$activeLink);
    }
}
