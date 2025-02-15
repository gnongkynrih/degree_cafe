@extends('layouts.app')
@section('content')
<h4 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-center mb-10">POS</h4>
<div class="flex flex-wrap justify-center">
  <div class="mr-5 mb-5 max-w-sm min-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <a href="#">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">TAKE ORDER</h5>
      </a>
      <p class="mb-3 font-normal text-gray-700">Customer will take order here</p>
      <a href="{{ route('sale.show_tables')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
          Click Here
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
          </svg>
      </a>
  </div>


  <div class="mr-5 mb-5 max-w-sm min-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <a href="#">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">CANCEL ORDER</h5>
      </a>
      <p class="mb-3 font-normal text-gray-700">Customer will cancel order here</p>
      <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
          Click Here
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
          </svg>
      </a>
  </div>


  <div class="mr-5 mb-5 max-w-sm min-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <a href="{{ route('sale.show_table_payment')}}">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">PAY BILL</h5>
      </a>
      <p class="mb-3 font-normal text-gray-700">Customer will make payment here</p>
      <a href="{{ route('sale.show_table_payment')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
          Click Here
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
          </svg>
      </a>
  </div>


  <div class="mr-5 mb-5 max-w-sm min-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <a href="{{ route('report.sale-report')}}">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Sale Report</h5>
      </a>
      <p class="mb-3 font-normal text-gray-700">show existing orders of customer</p>
      <a href="{{ route('report.sale-report')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
          Click Here
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
          </svg>
      </a>
  </div>
  <div class="mr-5 mb-5 max-w-sm min-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <a href="{{ route('report.sale-report')}}">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Send email</h5>
      </a>
      <p class="mb-3 font-normal text-gray-700">email testing</p>
      <form action="{{ route('mail.send')}}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Enter email">
        <button type="submit">Send</button>
      </form>
      
  </div>
</div>
@endsection