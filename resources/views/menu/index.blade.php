@extends('layouts.app')
@section('content')
  <a href="{{route('menu.create')}}">Add New Menu Item</a>
  <h1>list all the menu items</h1>
  <table>
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