@extends('layouts.app')
@section('content')
<h4 class="text-2xl font-bold tracking-tight text-gray-900 text-center mb-10">Tables</h4>
<div class="flex flex-wrap justify-center">
    @foreach($seats as $seat)
      <a href="{{ route('sale.index', $seat->id) }}">
        <div class="{{$seat->status =='active' ? 'text-black' : 'text-[#fff]'}}  text-center mr-5 mb-5 max-w-sm min-w-sm  p-6 {{ $seat->status =='active' ? 'bg-white' : 'bg-purple-300'}} border border-gray-200 rounded-lg shadow-sm">
        <i class="fa-solid fa-utensils text-4xl mb-5"></i>
        <h5 class="mb-2 text-4xl font-bold tracking-tight">{{$seat->table_name}}</h5>
      </div>
      </a>
    @endforeach
</div>
@endsection