<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //this will view all products
    public function view()
    {
       $products = Product::all();
       //dd($products);
       return view('product.products')->with('products',$products);
    }

    //this will add products
    public function add()
    {
        return view('product.productAdd');
    }

    public function postadd(Request $rqst)
    {
          //$all = $rqst->all();
          $products = new Product;
          $products->name = $rqst->name;
          $products->image = $rqst->image;
          $products->price = $rqst->price;
          $products->quantity = $rqst->quantity;
          $products->save();
          $products = Product::all();
          return view('product.products')->with('products',$products);
    }

    public function edit(Request $rqst)
    {
         //$rqst->all();
        $id =  array_key_first($rqst->all());
        $product = Product::find($id);
        //dd($product);
        return view('product.productEdit')->with('product',$product);
    }

    public function postedit(Request $rqst)
    {
       
        //dd($rqst->all());
          $product = Product::find($rqst->id);
          $product->name = $rqst->name;
          $product->image = $rqst->image;
          $product->price = $rqst->price;
          $product->quantity = $rqst->quantity;
          $product->update();
          $products = Product::all();
          return view('product.products')->with('products',$products);
    }

    public function delete(Request $rqst)
    {
         //$rqst->all();
        $id =  array_key_first($rqst->all());
        $product = Product::find($id);
        //dd($product);
        return view('product.productDelete')->with('product',$product);
    }

    public function postdelete(Request $rqst)
    {
       
        //dd($rqst->all());
          $product = Product::find($rqst->id);
          $product->delete();
          $products = Product::all();
          return view('product.products')->with('products',$products);
    }
}
