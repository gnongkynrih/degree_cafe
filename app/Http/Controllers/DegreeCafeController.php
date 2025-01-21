<?php

namespace App\Http\Controllers;

use App\Models\DegreeCafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCafeDetailRequest;

class DegreeCafeController extends Controller
{
    public function index()
    {
        $cafe = DegreeCafe::first();
        return view('cafe.index', compact('cafe'));
    }

   

    public function store(StoreCafeDetailRequest $request)
    {
       
        try{
            //store all the validated data in array variable data
            $data = $request->validated();
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                //store the image IN Images folder with a unique name
                $imagePath = $image->storeAs('images',$image->hashName());
                $data['logo'] = $imagePath; 
            }
            //check if the data exist in the table
            $cafe = DegreeCafe::first();
            if($cafe){
                //if previous logo exist then delete the old one
                if($cafe->logo){
                    Storage::delete($cafe->logo);
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
