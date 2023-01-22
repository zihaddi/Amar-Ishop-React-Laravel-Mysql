@extends('layout.app')
@section('content')

  <div class="d-flex justify-content-end">
    <button onclick="window.location.href='{{route('productAdd')}}'" type="button" class="btn btn-primary btn-sm mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg> Add Product</button>
  </div>
  <table class="table table-bordered my-5 table-hover border border-dark ">
    <thead>
      <tr class="text-center">
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        {{-- <p>This is user {{ $product->id }}</p> --}}
        <tr class="text-center">
          <td class="w-25"><img class="w-25" src={{ $product->image }} alt=""></td>
          <td >{{ $product->name }}</td>
          <td>{{ $product->quantity }}</td>
          <td>{{ $product->price }}</td>
          <td><div class="d-flex">
            <button onclick="window.location.href='{{route('productEdit',$product->id)}}'" class='btn btn-info btn-sm'>Edit</button>
             &nbsp;
            <button onclick="window.location.href='{{route('productDelete',$product->id)}}'" class='btn btn-danger btn-sm'>Delete</button></div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection