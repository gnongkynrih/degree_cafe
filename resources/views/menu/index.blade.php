@extends('layouts.app')
@section('content')
  <a class="mb-4 bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded" href="{{route('menu.create')}}">
    
    Add New Menu Item</a>
  <h1 class="mt-5">list all the menu items</h1>
  <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <tr>
      <th>Sl No</th>
      <th>Item Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Category</th>
    </tr>
    @foreach ($menus as $menu)
      <tr>
        {{-- print the serial number --}}
        <td>{{ $loop->iteration }}</td> 
        <td>{{ $menu->name }}</td>
        <td>{{ $menu->description }}</td>
        <td>{{ $menu->price }}</td>
        <td>{{ $menu->category->name }}</td>
      </tr>
    @endforeach
  </table>
@endsection