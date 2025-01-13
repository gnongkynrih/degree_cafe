<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <a href="{{route('category.index')}}">Back</a>
  <form method="POST" action="{{route('category.update',$category->id)}}">
    @csrf
    @method('PUT')
    <div>
      <label>Category Name</label>
    <input type="text" name="category_name" value="{{$category->name}}"/>
    
    </div>
    <div>
      <label>Status</label>
      <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>
    </div>
    <button type="submit">Update</button>
  </form>
</body>
</html>