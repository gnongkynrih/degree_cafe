<?php

namespace App\Http\Controllers;

use App\Models\DegreeCafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DegreeCafeController extends Controller
{
    public function index()
    {
        $cafe = DegreeCafe::first();
        return view('cafe.index', compact('cafe'));
    }

   

    public function store(Request $request)
    {
        $image_name = null;
        $request->validate([
            'name' => 'required|string|min:4|max:25',
            'phone' => 'required|string|max:25',
            'address' => 'required|string|min:4|max:25',
            'email' => 'required|email|min:4|max:25',
            'gst_no' => 'required|string|min:4|max:21',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //check if the image is uploaded
try{
       $data = $request->all();
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imagePath = $image->storeAs('images',$image->hashName());
            $data['logo'] = $imagePath; 
        }
        //check if the data exist in the table
        $cafe = DegreeCafe::first();
        if($cafe){
            //if previous logo exist then delete the old one
            if($cafe->logo != null){
                Storage::disk()->delete($cafe->logo);
            }
            $cafe->update($data);
        }else{
            DegreeCafe::Create($data);
        }
            return redirect()->route('degreecafe.index')->with('success', 'Cafe updated successfully!'); 
       
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error($e->getMessage()); 

        // Return an error response to the user
        return redirect()->back()->withErrors(['failure' => 'Failed to update cafe.']); 
    }
}
}
