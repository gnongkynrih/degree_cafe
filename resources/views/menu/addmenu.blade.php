<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>To add new menu item</h1>
  <form method="POST" action="{{route('menu.store')}}">
    @csrf
    <div>
      <label>Category</label>
      <select required name="category_id">
        <option value="">Select Category</option>
        @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label>Item</label>
      <input type="text" name="name" />
    </div>
    <div>
      <label>Description</label>
      <textarea name="description"></textarea>
    </div>
    <div>
      <label>Price</label>
      <input type="number" name="price" />
    </div>
    
    <button type="submit">Save</button>
  </form>
</body>
</html>