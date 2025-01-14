<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    //list all the menus
    public function index(){
        $menus = Menu::all();
        return view('menu.index')
            ->with('menus',$menus);
    }

    public function create(){
        //get all the active categories
        $categories = Category::where('status','=','active')->get();
        
        return view('menu.addmenu')
            ->with('categories',$categories);
    }

    public function store(Request $request){
        // $menu = new Menu();
        // $menu->name = $request->name;
        // $menu->description = $request->description;
        // $menu->price = $request->price;
        // $menu->category_id = $request->category_id;
        // $menu->save();

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'status' => 'active'
        ]);
        return redirect()->route('menu.index');
    }
}
