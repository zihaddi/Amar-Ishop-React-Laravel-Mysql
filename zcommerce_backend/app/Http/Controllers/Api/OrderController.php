<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function viewOrder(Request $rqst)
    {
        $id = $rqst->id;

        return response()->json(
            [
               'orders' => Order::where('uid' , $id)->get()
            ],
            201
        );
    }

    public function viewOrderdetail(Request $rqst)
    {
        $id = $rqst->id;
        $orderdetails = Orderdetail::where('oid' , $id)->get();

        foreach($orderdetails as $orderdet)
        {
            $orderdet["name"] = Product::where('id' , $orderdet->pid)->first(['name']);
            $orderdet["image"] = Product::where('id' , $orderdet->pid)->first(['image']);
        }
        return response()->json(
            [
               'orderdetails' => $orderdetails,
            ],
            201
        );
    }

    public function createOrder(Request $rqst)
    {
         $order = new Order;
         $order->uid =  $rqst->uid;
         $order->total_price =  $rqst->total_price;
         $order->status =  $rqst->status;
         $order->order_type =  $rqst->order_type;
         $order->transaction_id =  $rqst->transaction_id;
         $order->billing_address = $rqst->billing_address	;
         $order->shipping_address = $rqst->shipping_address	;
         $order->save();
       
         
         $products = $rqst->products;
         foreach($products as $product)
         {
            $gettedProduct = Product::where('id',$product["id"])->first();
            // return response()->json(['a' => $gettedProduct['price']]);
            $orderdetails = new Orderdetail;
            $orderdetails->oid = $order->id;
            $orderdetails->pid = $product["id"];
            $orderdetails->quantity = $product["qty"];
            $orderdetails->total =$gettedProduct["price"] *$product["qty"];
            $orderdetails->save();
         }

         return response()->json(
            [
                'order' => $order,
                'orderdetails' => Orderdetail::where('oid',$order->id)->get(),
            ],
            201
            );
    }

    public function editOrder()
    {

    }

    public function deleteOrder()
    {

    }

    
}
