<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function view()
    {
     
      $orders = Order::all();
      foreach($orders as $order)
      {
        $orderdetails = Orderdetail::where('oid' , $order->id)->get();
        $sum = 0;

        $users = User::where('id' , $order->uid)->get();
      
      
        foreach($orderdetails as $orderdetail)
        {
           $sum = $sum + $orderdetail['quantity'];         
        }
       
        $order['quantity'] = $sum; 
        //dd( $users[0]->name);
        $order['user_name'] = $users[0]->name;
       
      }
       //dd($products);
       return view('order.orders')->with('orders',$orders);
    }


    public function edit(Request $rqst)
    {
      
         //$rqst->all();
        $id =  array_key_first($rqst->all());
        
        $order = Order::find($id);
      
        return view('order.orderEdit')->with('order',$order);
    }

    public function postedit(Request $rqst)
    {
       
        //dd($rqst->all());
          $order = Order::find($rqst->id);
          $order->status = $rqst->status;
         
          $order->update();
        //   $orders = Order::all();
        //   return view('order.orders')->with('orders',$orders);
        return redirect('/orders');
    }

    public function orderDetails(Request $rqst)
    {
        //dd(array_keys($rqst->all()));
       
       $orderdetails = Orderdetail::where('oid' , array_key_first($rqst->all()))->get();
       $user = User::where('id' , array_keys($rqst->all())[1])->first();
      //dd($user);
      
        foreach($orderdetails as $orderdetail)
        {
           $product = Product::where('id' , $orderdetail->pid)->first();
           $orderdetail["name"] = $product['name'];
           $orderdetail["image"] = $product['image'];
           $orderdetail["user_name"] = $user['name'];
        }
        return view('order.orderDetails')->with('orderDetails',$orderdetails);
    }

    public function pendingOrder()
    {
        $orders = Order::where('status' , 'pending')->get();
        //dd($orders);
        foreach($orders as $order)
        {
          $orderdetails = Orderdetail::where('oid' , $order->id)->get();
          $sum = 0;
  
          $users = User::where('id' , $order->uid)->get();
        
        
          foreach($orderdetails as $orderdetail)
          {
             $sum = $sum + $orderdetail['quantity'];         
          }
         
          $order['quantity'] = $sum; 
          //dd( $users[0]->name);
          $order['user_name'] = $users[0]->name;
         
        }
         //dd($products);
         return view('order.orders')->with('orders',$orders);   
    }

    public function approvedOrder()
    {
        $orders = Order::where('status' , 'approved')->get();
        //dd($orders);
        foreach($orders as $order)
        {
          $orderdetails = Orderdetail::where('oid' , $order->id)->get();
          $sum = 0;
  
          $users = User::where('id' , $order->uid)->get();
        
        
          foreach($orderdetails as $orderdetail)
          {
             $sum = $sum + $orderdetail['quantity'];         
          }
         
          $order['quantity'] = $sum; 
          //dd( $users[0]->name);
          $order['user_name'] = $users[0]->name;
         
        }
         //dd($products);
         return view('order.orders')->with('orders',$orders);   
    }

    public function shippingOrder()
    {
        $orders = Order::where('status' , 'shipping')->get();
        //dd($orders);
        foreach($orders as $order)
        {
          $orderdetails = Orderdetail::where('oid' , $order->id)->get();
          $sum = 0;
  
          $users = User::where('id' , $order->uid)->get();
        
        
          foreach($orderdetails as $orderdetail)
          {
             $sum = $sum + $orderdetail['quantity'];         
          }
         
          $order['quantity'] = $sum; 
          //dd( $users[0]->name);
          $order['user_name'] = $users[0]->name;
         
        }
         //dd($products);
         return view('order.orders')->with('orders',$orders);   
    }

    public function completedOrder()
    {
        $orders = Order::where('status' , 'completed')->get();
        //dd($orders);
        foreach($orders as $order)
        {
          $orderdetails = Orderdetail::where('oid' , $order->id)->get();
          $sum = 0;
  
          $users = User::where('id' , $order->uid)->get();
        
        
          foreach($orderdetails as $orderdetail)
          {
             $sum = $sum + $orderdetail['quantity'];         
          }
         
          $order['quantity'] = $sum; 
          //dd( $users[0]->name);
          $order['user_name'] = $users[0]->name;
         
        }
         //dd($products);
         return view('order.orders')->with('orders',$orders);   
    }


    public function add()
    {
        $users = User::all();
        $products  = Product::all();
        $orderInfo = array();
        $orderInfo['products'] = null;
        $orderInfo['total_price'] = null;
        $orderInfo['order_type'] = null;
        $orderInfo['transaction_id'] = null;
        $orderInfo['shipping_address'] = null;
        $orderInfo['billing_address'] = null;
        $name = null ; 
        $uid = null ; 
        return view('order.orderAdd', compact('users', 'products', 'orderInfo' , 'name'));
    }

    public function postadd(Request $rqst)
    {
      //session()->forget('orderInfo');
      $value = session()->get('orderInfo');
      //dd($value);
      if($value)
      {
        $uid = $rqst->uid;
        $status = 'pending';
        $name = User::where('id' , $uid)->first('name')->name;
        //dd($name);
        $order_type = $rqst->order_type;
        $transaction_id = $rqst->transaction_id;
        $billing_address = $rqst->billing_address;
        $shipping_address = $rqst->shipping_address;
        //dd(($value['products']));
        $products =  array_push(($value['products']) ,  ['id'=> $rqst->id , 'quantity' => $rqst->quantity]);

        $arra = array();
        $total_price = 0 ;
        foreach($value['products']  as $pro)
        {
          $pro["name"] = Product::where('id' , $pro['id'])->first('name')->name;
          $pro["image"] = Product::where('id' , $pro['id'])->first('image')->image; 
          $pro["total"] = (Product::where('id' , $pro['id'])->first('price')->price) * $pro['quantity'];  
          $total_price = $total_price + $pro["total"];
          array_push($arra , $pro);           
        }
        //dd($arra['total']);
       // $total_price = array_sum(array_column($arra , 'total'));
        //dd(($value['products']));
        session()->put('orderInfo' , [
          'uid'=> $uid , 
          'status' => $status ,
          'total_price'=>$total_price, 
          'order_type' => $order_type , 
          'transaction_id' => $transaction_id , 
          'billing_address'=> $billing_address , 
          'shipping_address' => $shipping_address , 
          'products' => $arra
         ]);
      }
      else
      {
        $uid = $rqst->uid;
        $name = User::where('id' , $uid)->first('name')->name;
        $status = 'pending';
        $order_type = $rqst->order_type;
        $transaction_id = $rqst->transaction_id;
        $billing_address = $rqst->billing_address;
        $shipping_address = $rqst->shipping_address;
        $products = 
        [
          ['id'=> $rqst->id , 
          'quantity' => $rqst->quantity,
          'name' => Product::where('id' , $rqst->id)->first('name')->name,
          'image' => Product::where('id' , $rqst->id)->first('image')->image, 
          'total' => (Product::where('id' , $rqst->id)->first('price')->price) * $rqst->quantity]
        ];

        

        session()->put('orderInfo' , [
          'uid'=> $uid , 
          'status' => $status , 
          'total_price' => $products[0]['total'],
          'order_type' => $order_type , 
          'transaction_id' => $transaction_id , 
          'billing_address'=> $billing_address , 
          'shipping_address' => $shipping_address , 
          'products' => $products
         ]);
        }
      
          $talue = session()->get('orderInfo');

      $users = User::all();
      $products  = Product::all();

      
    return view('order.orderAdd', compact('users', 'products' , 'name' , 'uid'))->with('orderInfo',$talue);
    }

    public function backWithFlash()
    {
      session()->forget('orderInfo');
      return redirect('/orders');
    }

    public function clearCart()
    {
      session()->forget('orderInfo');
      return redirect('/orderAdd');
    }

    public function orderCheckout(Request $rqst)
    {
         //dd($rqst->all());
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
            $orderdetails->quantity = $product["quantity"];
            $orderdetails->total =$gettedProduct["price"] *$product["quantity"];
            $orderdetails->save();
         }
         session()->forget('orderInfo');
         return redirect('/orderAdd');
    }
}