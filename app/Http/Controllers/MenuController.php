<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Http\Requests\CreateCategoryRequest;
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

    public function store(CreateCategoryRequest $request){

        // $request->validate([
        //     'name' => 'required|string|min:4|max:25|unique:menus,name',
        //     'description' => 'nullable|string|min:4',
        //     'price' => 'required|numeric|min:10',
        //     'category_id' => 'required|exists:categories,id'
        // ]);
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
        return redirect()->route('menu.index')->with('success','Menu added successfully');
    }
}
