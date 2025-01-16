@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-black via-white-500 to-gray-400">
    <div class="flex items-center justify-center min-h-screen p-6">
        <div class="w-full max-w-md bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Add New Menu Item</h1>
            
            <form method="POST" action="{{route('menu.store')}}" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select required name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option {{ old('category_id') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-600">{{$message}}</span>
                    @enderror
                </div>
                    
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Item Name</label>
                    <input 
                    value = "{{old('name')}}"
                    type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter item name" />
                    @error('name')
                        <span class="text-red-600">{{$message}}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter item description">
                        {{old('description')}}
                    </textarea>
                    @error('description')
                        <span class="text-red-600">{{$message}}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500">Rs</span>
                        <input 
                        value = "{{old('price')}}"
                        type="number" name="price" step="0.01" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="0.00" />
                    </div>
                    @error('price')
                        <span class="text-red-600">{{$message}}</span>
                    @enderror
                </div>
                
                <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-medium rounded-lg shadow-lg hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-[1.02]">
                    Save Menu Item
                </button>
            </form>
        </div>
    </div>
</div>
@endsection