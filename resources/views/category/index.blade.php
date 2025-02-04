@extends('layouts.app')
@section('content')
  <h5>Categories</h5>
  <div class="mb-5">
    <a class=" bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded" href="{{ route('category.create')}}">Add New Category</a>
  </div>
  <table  id="sortable-table" class="mt-10 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
      <th>Sl No</th>
      <th>
        <span class="flex items-center">
          Category Name
          <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
          </svg>
        </span>
      </th>
      <th>
        <span class="flex items-center">
        Status&nbsp;&nbsp; <i class="fa-solid fa-sort"></i>
        </span>
      </th>
      <th>
        <span class="flex items-center">
        Created At&nbsp;&nbsp; <i class="fa-solid fa-sort"></i>
        </span>
      </th>
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
  {{-- show the pagination links --}}
  {{ $cat->links() }} 

@endsection
<script>

</script>