<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h5>Categories</h5>
  <a href="{{ route('category.create')}}">Add New Category</a>
  <table>
    <tr>
      <th>Sl No</th>
      <th>Category Name</th>
      <th>Status</th>
      <th>Created At</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    
    @foreach ($cat as $category)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td> <?php echo$category->name; ?></td>
        <td>{{ $category->status }}</td>
        <td>{{ $category->created_at }}</td>
        <td>
          <a href="{{ route('category.edit', $category->id) }}">Edit</a>
        </td>
        <td>
          <form action="{{ route('category.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
</body>
</html>