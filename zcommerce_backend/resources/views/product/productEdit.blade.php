<!DOCTYPE html>
<html lang="en">
<head>
@extends('layout.app')
@section('content')

  <div class="mt-5">
     <form action="productsEdit" method="post" class="border p-4 ">
      @csrf
      <input name='id' type="hidden" class="form-control"   value='{{ $product->id }}' >
      <div class="mb-3" >
        <label for="1" class="form-label">Name :</label>
        <input name='name' type="text" class="form-control" id="1" placeholder="name" value='{{ $product->name }}'>
      </div>
      <div class="mb-3">
        <label for="2" class="form-label">Image Link :</label>
        <input name='image' type="text" class="form-control" id="2" placeholder="image" value='{{ $product->image}}'>
      </div>
      <div class="mb-3">
        <label for="3" class="form-label">Price :</label>
        <input name='price' type="text" class="form-control" id="3" placeholder="price" value='{{ $product->price }}'>
      </div>
      <div class="mb-3">
        <label for="4" class="form-label">Quantity :</label>
        <input name='quantity' type="text" class="form-control" id="4" placeholder="quantity" value='{{ $product->quantity }}'>
      </div>
      <div class="d-flex justify-content-between">
        <input type="submit" class='btn btn-primary' value="Edit Product">
        <button onclick="window.location.href='{{route('products')}}'" type="button" class='btn btn-danger' >Back</button>
      </div>
     </form>
     
  </div>
@endsection