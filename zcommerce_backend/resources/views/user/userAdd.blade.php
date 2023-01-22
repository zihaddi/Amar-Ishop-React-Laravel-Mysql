<!DOCTYPE html>
<html lang="en">
<head>
@extends('layout.app')
@section('content')
  <div class="mt-5">
     <form action="usersAdd" method="post" class="border p-4 ">
      @csrf
      <div class="mb-3">
        <label for="1" class="form-label">Name :</label>
        <input name='name' type="text" class="form-control" id="1" placeholder="name">
      </div>
      <div class="mb-3">
        <label for="2" class="form-label">Email :</label>
        <input name='email' type="text" class="form-control" id="2" placeholder="email">
      </div>
      <div class="mb-3">
        <label for="3" class="form-label">Password :</label>
        <input name='password' type="password" class="form-control" id="3" placeholder="password">
      </div>
      {{-- <div class="mb-3">
        <label for="4" class="form-label">Role :</label>
        <input name='roles' type="text" class="form-control" id="4" placeholder="write admin/customer">
      </div> --}}
      <div class=" mb-3">
        <label class="form-label" for="inputGroupSelect01">Role :</label>
        <select name='roles' class="form-select" id="inputGroupSelect01">
          <option selected disabled>Choose Role</option>
          <option value="admin">Admin</option>
          <option value="customer">Customer</option>
        </select>
      </div>
      <div class="d-flex justify-content-between">
        <input type="submit" class='btn btn-primary' value="Add User">
        <button onclick="window.location.href='{{route('backWithFlash')}}'" type="button" class='btn btn-danger' >Back</button>
      </div>
     </form>
     
  </div>
@endsection