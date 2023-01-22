@extends('layout.app')
@section('content')

  <div class="d-flex justify-content-end">
    <button onclick="window.location.href='{{route('orderAdd')}}'" type="button" class="btn btn-primary btn-sm mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg> Add Order</button>
  </div>
  <div class="d-flex">
    <button onclick="window.location.href='{{route('pendingOrder')}}'" class="btn btn-danger me-1">Pending</button>
    <button onclick="window.location.href='{{route('approvedOrder')}}'" class="btn btn-primary me-1">Approved</button>
    <button onclick="window.location.href='{{route('shippingOrder')}}'" class="btn btn-warning me-1">Shipping</button>
    <button onclick="window.location.href='{{route('completedOrder')}}'" class="btn btn-success me-1">Completed</button>
  </div>
  <table class="table table-bordered my-3 table-hover border border-dark ">
    <thead>
      <tr class="text-center fs-6">
        <th  scope="col">Users Name</th>
        <th scope="col">Selected Products</th>
        <th scope="col">Total</th>
       
        <th scope="col">Payment Type</th>
        <th scope="col">Transaction Id</th>
        <th scope="col">Billing Address</th>
        <th scope="col">Shipping Address</th>
        <th scope="col">Status</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
        {{-- <p>This is user {{ $product->id }}</p> --}}
        <tr class="text-center">
          <td class="w-100">{{ $order->user_name }}
          <td class="w-25">{{ $order->quantity }} items</td>
          <td class="w-50">{{ $order->total_price }} BDT</td>
         
          <td class="w-50">{{ $order->order_type }}</td>
          <td class="w-50">{{ $order->transaction_id }}</td>
          <td class="w-50">{{ $order->billing_address }}</td>
          <td class="w-50">{{ $order->shipping_address }}</td>
          {{-- <td {{ $order->status=='pending' ? class='w-50 text-blue-600' : class='w-50 text-red-400'}}>{{ $order->status }}</td> --}}
          {!! ($order->status == 'pending')? 
          '<td class="  w-50 text-danger  border-spacing-1">pending</td>':
          (($order->status == 'approved')?
          '<td class="  w-50 text-primary  border-spacing-1">approved</td>':
          (($order->status == 'completed')?
          '<td class="  w-50 text-success  border-spacing-1">completed</td>':
          '<td class="  w-50 text-warning  border-spacing-1">shipping</td>'))
          !!}
          
         
         
          <td><div class="d-flex">
            <button onclick="window.location.href='{{route('orderEdit',$order->id)}}'" class='btn btn-info btn-sm'>Change Status</button>
             &nbsp;
             <button onclick="window.location.href='{{route('orderDetails',[$order->id , $order->uid]  )}}'" class='btn btn-primary text-dark btn-sm'>See Details</button>
            {{-- <button onclick="window.location.href='{{route('productDelete',$product->id)}}'" class='btn btn-danger btn-sm'>Delete</button></div> --}}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection