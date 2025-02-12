<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        
        $cat = Category::paginate(2);//select * from categories
        //go to the view and pass the value of categories through compact
        return view('category.index',compact('cat'));
    }
    //show user the screen to add category
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        //validate category name
        $request->validate([
            'category_name' => 'required|string|min:4|max:25|unique:categories,name'
        ]);
        if($request->hasFile('image_url')){
            $image = $request->file('image_url');
            $imagePath = $image->storeAs('images',$image->hashName());
        }
        Category::create([
            'name' => $request->category_name,
            'image_url' => $imagePath,
            'status' =>'active'
        ]);
        // return redirect()->back();
        return redirect()->route('category.index')->with('success','Category added successfully');
    }

    public function deleteCategory($id){
        //find will search by primary key
        // Category::find($id)->delete();
        $category = Category::find($id); //searches
        $category->delete(); //deletes
        return redirect()->route('category.index')
            ->with('success','Category deleted successfully');
    }

    public function editCategory($id){
        $category = Category::where('id','=',$id)->firstOrFail();
        return view('category.edit',compact('category'));
    }
    public function updateCategory(Request $request,$id){
        if(isset($request->status)){
            $status= 'active';
        }else{
            $status= 'inactive';
        }
        $category = Category::find($id);
        $category->name = $request->category_name;
        $category->status = $status;
        $category->save();
        return redirect()->route('category.index');
    }
}
