<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
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
</body>
</html>