@extends('layouts.app')
@section('content')
  <h5>Categories</h5>
  <a href="{{ route('category.create')}}">Add New Category</a>
  <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
      <th>Sl No</th>
      <th>Category Name</th>
      <th>Status</th>
      <th>Created At</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($cat as $category)
      <tr class="bg-white border-b border-red-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td>{{ $loop->iteration }}</td>
        <td> <?php echo$category->name; ?></td>
        <td>{{ $category->status }}</td>
        <td>{{ $category->created_at }}</td>
        <td>
          <a 
          class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
          href="{{ route('category.edit', $category->id) }}">Edit</a>
        </td>
        <td>
          {{-- confirm if you wants to delete --}}
          <form 
          onsubmit="return confirm('Are you sure you want to delete this category?');"
          action="{{ route('category.destroy', $category->id) }}" 
          method="POST" >
            @csrf
            @method('DELETE')
            <button
            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
            type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection