@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto bg-purple-300 p-5 rounded-lg">
  <div class="row justify-content-center">
    <article class="bg-secondary text-center mb-3 col-md-6">  
      <i class="fa-solid fa-check text-4xl text-white p-5 rounded-full bg-green-600"></i>
      <h4 class="text-white text-2xl mb-10 mt-3">Payment Successful<br></h4>
  <div class="text-left">
    <table class="table table-bordered table-responsive">
        {{-- <tr>
          <th>Admission to class</th>
          <td>{{ $payment->applicant->class_name }}</td>
        </tr>
        <tr>
          <th>Full Name</th>
          <td>{{ $payment->applicant->fullname }}</td>
        </tr> --}}
        <tr>
          <th>Total</th>
          <td>{{$payment->amount}}</td>
        </tr>
        <tr>
          <th>Payment ID</th>
          <td>{{$payment->r_payment_id}}</td>
        </tr>
        <tr>
          <th>Payment Date</th>
          <td>{{$payment->created_at}}</td>
        </tr>
        <tr>
          <th>Payment Status</th>
          <td>{{$payment->status}}</td>
        </tr>
      </table>
    <form class="text-center mt-10" action="{{route('sale.download_receipt',$payment->razorpay_payment_id)}}" method="get">
    @csrf
      <button class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300"> Download Receipt  <i class="fa fa-download "></i></button> 
    </form>
  </div>
  <br><br><br>
</article>
  </div>
</div>
@endsection