<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index($id = null){
        $seats = Seat::where( 'status','=','active' )->get();
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
            ->with('categories',$categories)
            ->with('menus',$menus)
            ->with('seats',$seats)
            ->with('activeLink',$activeLink);
    }
}
