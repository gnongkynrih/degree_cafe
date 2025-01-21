<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Menu;

class SaleController extends Controller
{
    public function index($id = null){
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
            ->with('activeLink',$activeLink);
    }
}
