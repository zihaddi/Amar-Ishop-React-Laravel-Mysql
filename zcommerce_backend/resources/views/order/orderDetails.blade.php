@extends('layout.app')
@section('content')

  <h3 class="text-primary">Name : {{ $orderDetails[0]->user_name ?  $orderDetails[0]->user_name  : ""}}</h3>
  <table class="table table-bordered my-5 table-hover border border-dark ">
    <thead>
      <tr class="text-center fs-6">
        <th  scope="col">Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Quantity</th>
        <th  scope="col">Total</th> 
      </tr>
    </thead>
    <tbody>
      @foreach ($orderDetails as $order)
        {{-- <p>This is user {{ $product->id }}</p> --}}
        <tr class="text-center">
          <td ><img class="w-75" src={{ $order->image  }} alt={{ $order->name }}></td>
          <td class="w-50">{{ $order->name }} </td>
          <td class="w-25">{{ $order->quantity }} </td>
          <td class="w-50">{{ $order->total }} BDT</td>
         
        </tr>
      @endforeach
      <tr class="text-center">
        <td></td>
        <th>Total</th>
        <th>{{$orderDetails->sum('quantity')  }} items</th>
        <th>{{$orderDetails->sum('total')  }} BDT</th>
      </tr>
    </tbody>
  </table>
  <button onclick="window.location.href='{{route('orders')}}'" type="button" class='btn btn-danger' >Back</button>

@endsection