@extends('layouts.app')
@section('content')

  <a href="{{route('category.index')}}">Back</a>
  <form class="max-w-[600px] mx-auto p-6 border border-gray-200 rounded-lg shadow" method="POST" action="{{route('category.update',$category->id)}}">
    @csrf
    @method('PUT')
    <div>
      <label>Category Name</label>
    <input type="text" name="category_name" value="{{$category->name}}"/>
    
    </div>
    <div>
      <label>Status</label>
      {{-- <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select> --}}
      <label class="inline-flex items-center cursor-pointer">
        <input class="sr-only peer" type="checkbox" name="status" {{ $category->status  =='active' ? 'checked' : '' }}/>
      <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
  <span class="ms-3 text-sm font-medium text-gray-900">{{$category->status}}</span>
      </label>
    </div>
    <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold p-2 px-4 mt-5 rounded" type="submit">Update</button>
  </form>
@endsection