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
    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
  </div>
</form>

<div class="flex flex-wrap justify-center">
  <a href="{{ route('sale.index',[$seat->table_name]) }}" class="block max-w-[15em] p-6 m-2 rounded-md shadow hover:bg-gray-100 dark:bg-gray-800 dark:border dark:hover:bg-gray-700 transition duration-300 {{ $activeLink =='all' ? 'bg-blue-500 text-white' : 'bg-white border border-gray-200 text-gray-900 dark:text-white dark:border-gray-700'}}">
    <h5 class="text-center text-2xl font-bold tracking-tight">All</h5>
  </a>
  @foreach($categories as $category)
  <a href="{{ route('sale.index', [$seat->table_name,$category->id]) }}" class="block max-w-[15em] p-6 m-2 rounded-md shadow hover:bg-gray-100 dark:bg-gray-800 dark:border dark:hover:bg-gray-700 transition duration-300 {{ $activeLink == $category->id ? 'bg-blue-500 text-white' : 'bg-white border border-gray-200 text-gray-900 dark:text-white dark:border-gray-700'}}">
    <h5 class="text-center text-2xl font-bold tracking-tight">{{$category->name}}</h5>
  </a>
  @endforeach
</div>

<hr class="my-4">
<h3 class="text-2xl font-bold tracking-tight bg-purple-600 text-white text-center py-4 mb-10">Table No {{ $seat->table_name }}</h3>
<div class="flex flex-col md:flex-row w-full px-6 border border-gray-200 rounded-lg">
  <div class="md:basis-2/3 rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th class="px-4 py-2">Item Name</th>
          <th class="px-4 py-2">Description</th>
          <th class="px-4 py-2">Price</th>
          <th class="px-4 py-2">Quantity</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($menus as $menu)
        <tr id="R{{ $menu->id }}" class="even:bg-gray-100 odd:bg-white dark:even:bg-gray-700 dark:odd:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition duration-200">
          <td class="px-4 py-2">{{ $menu->name }}</td>
          <td class="px-4 py-2">{{ $menu->description }}</td>
          <td class="px-4 py-2">{{ $menu->price }}</td>
          <td class="px-4 py-2">
            <div class="flex items-center justify-center">
              <button id="M{{ $menu->id }}" class="minus text-white text-2xl  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full mr-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition duration-200 h-10 w-10">-</button>
              <input readonly type="number" name="quantity" id="Q{{ $menu->id }}" value="0" min="0" class="quantity w-16 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent text-center">
              <button id="A{{ $menu->id }}" class="plus text-white text-2xl  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-full ml-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition duration-200 h-10 w-10">+</button>
            </div>
          <lt2>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="md:basis-1/3 border-l-0 md:border-l border-gray-200 rounded-lg md:rounded-l-none p-4">
    <div class="font-bold text-lg mb-2">Selected Items</div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th class="px-2 py-1">Item</th>
          <th class="px-2 py-1">Qty</th>
          <th class="px-2 py-1">Price</th>
          <th class="px-2 py-1">Total</th>
        </tr>
      </thead>
      <tbody id="selectedItems">
        @foreach ($orders as $order)
          <tr id="S{{ $order->menu_id }}" class="even:bg-gray-100 odd:bg-white dark:even:bg-gray-700 dark:odd:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition duration-200">
            <td class="px-2 py-1">{{ $order->menu->name }}</td>
            <td class="px-2 py-1">{{ $order->quantity }}</td>
            <td class="px-2 py-1">{{ $order->menu->price }}</td>
            <td class="px-2 py-1">{{ $order->quantity * $order->menu->price }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot id="tableFoot" class="bg-blue-500 text-white">
        <tr>
          <td colspan="3" class="px-2 py-1 text-right font-bold">Grand Total</td>
          <td id="grandTotal" class="px-2 py-1 font-bold">0</td>
        </tr>
      </tfoot>
    </table>
    <div class="text-center mt-4">
      <button id="btnConfirmOrder" type="button" class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
        <i class="fa-solid fa-check mr-2"></i> Confirm Order
      </button>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
      let grandTotal = 0;

      //check when user click on minus button
      $('.minus').click(function(){
        var id = $(this).attr('id').substr(1);//get the id after removing M from the id
        var count = parseInt($('#Q'+id).val()) - 1; //decrement the value
        if(count < 0){
          count = 0;
        }

        grandTotal -= parseInt($('#Q'+id).val()) * parseInt($('#R'+id).find('td').eq(2).text());
        $('#Q'+id).val(count);
        $('#Q'+id).change();

        
        $('#grandTotal').text(grandTotal);
        return false;
      });
      $('.plus').click(function(){
        var id = $(this).attr('id').substr(1);//get the id after removing M from the id
        var count = parseInt($('#Q'+id).val()) + 1; //increment the value
        $('#Q'+id).val(count);
        $('#Q'+id).change();

        grandTotal += parseInt($('#Q'+id).val()) * parseInt($('#R'+id).find('td').eq(2).text());
        $('#grandTotal').text(grandTotal);
        return false;
      });

      $('.quantity').on('change', function() {
        //update or insert the value in the table selectedItems
        var id = $(this).attr('id').substr(1); //get the id after removing Q from the id
        var name = $('#R'+id).find('td').eq(0).text(); //get the name of the item
        var price = $('#R'+id).find('td').eq(2).text(); //get the price of the item
        var quantity = $('#Q'+id).val(); //get the quantity of the item
        var total = price * quantity; //calculate the total
        if(quantity > 0){
          $('#S'+id).remove();
          $('#selectedItems').append('<tr id="S'+id+'"><td>'+ name +'</td><td>'+ 
                      quantity +'</td><td>'+ price +'</td><td>'+ total +'</td></tr>');
        }else{
          $('#S'+id).remove();
        }
      });

      $('#btnConfirmOrder').click(function(e){
        e.preventDefault();
        let items = [];
        $('#selectedItems').find('tr').each(function(){
          var id = $(this).attr('id').substr(1);
          var quantity = $(this).find('td').eq(1).text();
          var price = $(this).find('td').eq(2).text();
          var total = $(this).find('td').eq(3).text();
          items.push({id, quantity, price, total});
        });
        //check if the items is empty
        if(items.length == 0){
          Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Please select at least one item!",
            });
          return;
        }
        $.post('{{ route('sale.confirmOrder',$seat->table_name)}}', {
          _token: '{{ csrf_token() }}',
          items: items,
        }).done(async function(response){
          if(response.status == 'success'){
            await Swal.fire({
              icon: "success",
              title: "Order Placed!",
              text: "Your order has been placed.",
            });
            let url = "{{ route('sale.show_tables')}}";
            window.location.href = url; //redirect the page
          }else{
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
            });
          }
        });

        
      });
      updateQuantity();
      function updateQuantity(){
        //store the orders from $orders in an array
        let items =  @json($orders);
        let total = 0;
        console.log(items);
        items.forEach(item => {
          $('#Q'+item.menu_id).val(item.quantity);
          total += parseInt(item.quantity) * parseInt(item.amount); 
        });
        $('#grandTotal').text(total);
      }
});
</script>
@endsection