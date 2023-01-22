<!DOCTYPE html>
<html lang="en">
<head>
@extends('layout.app')
@section('content')

  <div class="mt-5">
     <form action="ordersEdit" method="post" class="border p-4 ">
      @csrf
      <input name='id' type="hidden" class="form-control"   value='{{ $order->id }}' >
    
      <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Options</label>
        <select name='status' class="form-select" id="inputGroupSelect01">
          <option selected disabled>Choose Status</option>
          <option value="pending">Pending</option>
          <option value="approved">Approved</option>
          <option value="shipping">Shipping</option>
          <option value="completed">Completed</option>
        </select>
      </div>
        <input type="submit" class='btn btn-primary' value="Edit Status">
        <button onclick="window.location.href='{{route('orders')}}'" type="button" class='btn btn-danger' >Back</button>
      </div>
     </form>
     
  </div>
@endsection