<!DOCTYPE html>
<html lang="en">
<head>
@extends('layout.app')
@section('content')
  <div class="mt-5">
     <form action="productsDelete" method="post" class="border p-4 ">
      @csrf
      <input name='id' type="hidden" class="form-control"   value='{{ $product->id }}' >
      <div class="mb-3">
        <label for="1" class="form-label">Name :</label>
        <input name='name' type="text" class="form-control" id="1" placeholder="name" value='{{ $product->name }}' disabled>
      </div>
      <div class="mb-3">
        <label for="2" class="form-label">Image Link :</label>
        <input name='image' type="text" class="form-control" id="2" placeholder="image" value='{{ $product->image}}' disabled>
      </div>
      <div class="mb-3">
        <label for="3" class="form-label">Price :</label>
        <input name='price' type="text" class="form-control" id="3" placeholder="price" value='{{ $product->price }}' disabled>
      </div>
      <div class="mb-3">
        <label for="4" class="form-label">Quantity :</label>
        <input name='quantity' type="text" class="form-control" id="4" placeholder="quantity" value='{{ $product->quantity }}' disabled>
      </div>
      <div class="d-flex justify-content-between">
        <input type="submit" class='btn btn-primary' value="Delete Product">
        <button onclick="window.location.href='{{route('products')}}'" type="button" class='btn btn-danger' >Back</button>
      </div>
     </form>
     
  </div>
@endsection