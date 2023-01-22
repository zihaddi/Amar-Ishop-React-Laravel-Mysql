<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
   public function view()
   {
    return response()->json(Product::all());
   }
}
