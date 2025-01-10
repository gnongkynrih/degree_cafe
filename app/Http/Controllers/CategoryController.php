<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //show user the screen to add category
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        Category::create([
            'name' => $request->category_name
        ]);
        return redirect()->back();
    }
}
