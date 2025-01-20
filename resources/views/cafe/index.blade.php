@extends('layouts.app')
@section('content')
<form 
enctype="multipart/form-data"
class="max-w-[600px] mx-auto bg-purple-300 p-5" 
method="POST" 
action="{{route('degreecafe.store')}}">
  @csrf
  <div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Cafe Name</label>
    <input
    type="text"
    name="name"
    value="{{$cafe ? $cafe->name : old('name')}}"/>  
    @error('name')
      <span class="text-red-600">{{ $message }}</span>
    @enderror
  </div>
  <div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Cafe Address</label>
    <textarea name="address" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter item description">
      {{$cafe ? $cafe->address : old('address')}}
    </textarea>
      
    @error('address')
      <span class="text-red-600">{{ $message }}</span>
    @enderror
  </div>
  <div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Phone</label>
    <input
    type="number"
    name="phone"
    value="{{$cafe ? $cafe->phone : old('phone')}}"/>  
    @error('phone')
      <span class="text-red-600">{{ $message }}</span>
    @enderror
  </div>
  <div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">GST</label>
    <input
    type="text"
    name="gst_no"
    value="{{$cafe ? $cafe->gst_no : old('gst_no')}}"/>  
    @error('gst_no')
      <span class="text-red-600">{{ $message }}</span>
    @enderror
  </div>
  <div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">email</label>
    <input
    type="email"
    name="email"
    value="{{$cafe ? $cafe->email : old('email')}}"/>  
    @error('email')
      <span class="text-red-600">{{ $message }}</span>
    @enderror
  </div>
  <div class="flex">
    <input type="file" name="logo" accept="image/*"/>
    @if(isset($cafe->logo))
      <img width="50px" height="50px" src="{{asset('storage/'.$cafe->logo)}}"  >
    @endif
  </div>
  <div>
    <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold p-2 px-4 mt-5 rounded" type="submit">Save Cafe</button>
  </div>
</form>
  @endsection