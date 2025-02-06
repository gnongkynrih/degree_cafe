@extends('layouts.print')
@section('content')
  <div class="max-w-md mx-auto bg-white p-5 rounded-lg">
    <div class="text-center mb-5 text-sm">
        <h4 class="underline">Degree Cafe</h4>
        <h5>NIELIT Shillong</h5>
        <h4 class="text-2xl font-bold tracking-tight text-gray-900">Receipt</h4>

        <table class="table table-bordered table-responsive">
          <thead>
            <tr>
              <th colspan="3">Invoice No: {{ $sale->invoice_number }}</th>
              <th colspan="2">Dated: {{ $sale->invoice_date }}</th>  
            </tr>
            <tr  class="border-b border-gray-200 font-bold">
              <th>Sl No</th>
              <th>Item</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sale->orders as $order)
              <tr class="border-b border-gray-200">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->menu->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->quantity * $order->amount }}</td>
              </tr>
            @endforeach
            <tr  class="border-b border-gray-200">
              <td colspan="4">Grand Total</td>
              <td>{{ $sale->total }}</td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
@endsection
