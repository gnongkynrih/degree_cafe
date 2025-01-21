@extends('layouts.app')
@section('content')
  <form class="max-w-md mx-auto mb-5">   
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
              </svg>
          </div>
          <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
          <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
      </div>
  </form>

  <div class="flex flex-wrap">
    <a href="{{ route('sale.index') }}" class="block max-w-[15em] p-6 {{ $activeLink =='all' ? 'bg-blue-400' : 'bg-white'}} border border-gray-200 rounded-md shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 m-2" >
        <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-white dark:text-white">All</h5>
      </a>
    @foreach($categories as $category)
      <a href="{{ route('sale.index', $category->id) }}" class="block max-w-[15em] p-6 {{ $activeLink == $category->id ? 'bg-blue-400' : 'bg-white'}} border border-gray-200 rounded-md shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 m-2" >
        <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$category->name}}</h5>
      </a>
    @endforeach
  </div>

  <hr class="m-4">
    
    <div class="flex  w-full px-6 border border-gray-200">
      <div class="basis-2/3  rounded flex items-center justify-between">
        <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th>Item Name</th>
              <th>Description</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($menus as $menu)
              <tr class="even:bg-gray-100 odd:bg-white hover:bg-purple-200">
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->description }}</td>
                <td>{{ $menu->price }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        <div class="basis-1/3 border-l-gray-200 rounded flex items-center justify-between">
          Right side side
        </div>
  </div>
@endsection