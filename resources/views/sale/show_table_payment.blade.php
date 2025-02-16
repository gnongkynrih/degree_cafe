@extends('layouts.app')
@section('content')
<div class="flex mt-5">
  <div class="basis-1/2">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 text-center mb-10 bg-purple-400">Select the table for payment</h2>
      <div class="flex flex-wrap justify-center">
        @foreach($seats as $seat)
          <a id="T{{$seat->table_name}}" class="confirm" href="#">
            <div class="{{$seat->status =='active' ? 'text-black' : 'text-[#fff]'}}  text-center mr-5 mb-5 max-w-sm min-w-sm  p-6 {{ $seat->status =='active' ? 'bg-white' : 'bg-purple-300'}} border border-gray-200 rounded-lg shadow-sm">
            <i class="fa-solid fa-utensils text-4xl mb-5"></i>
            <h5 class="mb-2 text-4xl font-bold tracking-tight">{{$seat->table_name}}</h5>
          </div>
          </a>
        @endforeach
    </div>
  </div>
  <div class="basis-1/2">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 text-center mb-10">Order Summary</h2>
    <div id="orderSummary"></div>
    <form action="{{ route('sale.confirmPayment', ':id') }}" id="confirmPaymentForm" method="POST">
      @csrf
      <button id="btnPay" class="w-full px-4 py-2 mt-4 text-white transition-colors duration-150 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Pay Now</button>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $('#btnPay').hide();
  let saleId = '';
  $('.confirm').click(function(e){
    e.preventDefault();
      let id = $(this).attr('id').substr(1);
      let url ="{{ route('sale.getOrdersByTableNo', ':id') }}".replace(':id',id)
     
      $.get(url, function(data){
        console.log(data.data);
        $('#orderSummary').html(data.data);
        saleId = data.saleId;
        $('#btnPay').show();
      })
  });

  $('#btnPay').click(function(e){
    e.preventDefault();
    Swal.fire({
        title: "Are you sure you want to pay?",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
      }).then((result) => {
        let url ="{{ route('sale.confirmPayment', ':id') }}".replace(':id',saleId)
        $('#confirmPaymentForm').attr('action', url);
        $('#confirmPaymentForm').submit();
        // $.post(url, {
        //   _token: '{{ csrf_token() }}',
        // }).done(function(response){
        //   if (result.isConfirmed) {
        //     Swal.fire("Saved!", "", "success");
        //   }
        // });
        
      });
    
  });
</script>
@endSection