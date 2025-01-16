@extends('layouts.app')
@section('content')
  <a href="{{route('category.index')}}">Back</a>
  <form method="POST" action="{{route('category.store')}}">
    @csrf
    <div class="mb-5">
      <label class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Category Name</label>
      <input
      type="text"
      name="category_name"
      value="{{old('category_name')}}"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Category"/>

      @error('category_name')
        <span class="text-red-600">{{ $message }}</span>
      @enderror
    </div>
    <div>
      <button
      class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
       type="submit">Save</button>
    </div>
  </form>
  @endsection