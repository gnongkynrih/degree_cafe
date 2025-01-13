<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        
        $cat = Category::all();//select * from categories
        //go to the view and pass the value of categories through compact
        return view('category.index',compact('cat'));
    }
    //show user the screen to add category
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        Category::create([
            'name' => $request->category_name
        ]);
        // return redirect()->back();
        return redirect()->route('category.index');
    }

    public function deleteCategory($id){
        //find will search by primary key
        // Category::find($id)->delete();
        $category = Category::find($id); //searches
        $category->delete(); //deletes
        return redirect()->route('category.index');
    }

    public function editCategory($id){
        $category = Category::where('id','=',$id)->firstOrFail();
        return view('category.edit',compact('category'));
    }
    public function updateCategory(Request $request,$id){
        $category = Category::find($id);
        $category->name = $request->category_name;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('category.index');
    }
}
