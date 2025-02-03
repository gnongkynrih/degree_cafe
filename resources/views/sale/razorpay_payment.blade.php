@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="min-w-sm max-w-md mx-auto bg-gray-200">
      <h5>Make Payment</h5>

      <table class="table table-bordered table-responsive">
        <tr>
          <th>Item</th>
          <th>Price</th>
          {{-- <td>{{ $applicant->fullname }}</td> --}}
          <th>Quantity</th>
          <th>Total</th>
        </tr>
        @foreach($payment->orders as $order)
          <tr><td>{{ $order->menu->name }}</td>
          <td>{{ $order->quantity }}</td>
          <td>{{ $order->amount }}</td>  
          <td>{{ $order->quantity * $order->amount }}</td></tr>
        @endforeach
        <tr><td colspan="3">Grand Total</td><td>{{ $payment->total }}</td></tr>
        <tr>
          <td class="text-center" colspan="4">
            <form action="{{ route('sale.process_payment') }}" method="POST" 
            class="bg-purple-500 text-white px-10 py-2 rounded-lg mt-10 mb-5 ml-auto mr-auto" >
                @csrf 
                <script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZOR_KEY') }}"
                        data-amount="{{$payment->total*100}}"
                        data-buttontext="Complete Payment"
                        data-name="{{$payment->id}}"
                        order_id = "{{ $payment->razorpay_order_id }}"
                        data-description="Admission form fee payment"
                        data-image="https://www.laravelia.com/storage/logo.png"
                        data-prefill.name="Degree Cafe"
                        {{-- data-prefill.email="{{$applicant->email}}" --}}
                        data-theme.color="#ff7529">
                </script>
            </form>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection