@extends('layouts.app')
@section('content')
  <a href="{{route('category.index')}}">Back</a>
  <form  class="max-w-[600px] mx-auto bg-purple-300 p-5" method="POST" action="{{route('category.store')}}">
    @csrf
    <div class="mb-5">
      <label class="block mb-2 text-sm font-medium text-green-700">Category Name</label>
      <input
      type="text"
      name="category_name"
      value="{{old('category_name')}}"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Category"/>

      @error('category_name')
        <span class="text-red-600">{{ $message }}</span>
      @enderror
    </div>
    <div>
      <button
      class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2"
       type="submit">Save</button>
    </div>
  </form>
  @endsection