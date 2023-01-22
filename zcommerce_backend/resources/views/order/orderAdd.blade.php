<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layout.app')
    @section('content')
        <div class="d-flex justify-content-around">
            <div class="mt-3 me-5" style="width: 30vw">
                <form action="ordersAdd" method="post" class="border p-3 ">
                    @csrf
                    <div class=" mb-2 ">
                        <label class="form-label" for="inputGroupSelect01">User Name :</label>
                        <select name='uid' class="form-select" id="inputGroupSelect01">
                            
                            @if($name && $uid)
                            <option selected value="{{ $uid }}" >{{ $name }}</option>
                            @else
                            <option selected disabled>Choose User</option>
                              @if ($users->count())
                                @foreach ($users as $user)
                                 <option value="{{ $user->id }}">{{ $user->name }}</option>
                               @endForeach
                              @else
                                 No Record Found
                             @endif
                            @endif
                        </select>
                    </div>
                    <div class=" mb-2">
                        <label class="form-label" for="inputGroupSelect01">Payment Type :</label>
                        <select name='order_type' class="form-select" id="inputGroupSelect01">
                            @if ($orderInfo['order_type'])
                            <option selected value="{{ $orderInfo['order_type'] }}">{{ $orderInfo['order_type'] }}</option>
                            @else 
                            <option selected disabled>Payment Type</option>
                            <option value="Bkash">Bkash</option>
                            <option value="Nogod">Nogod</option>
                            <option value="cash on hand">Cash On Hand</option>   
                            @endif
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="3" class="form-label">Transaction Id :</label>
                        @if ($orderInfo['transaction_id'])
                        <input name='transaction_id' type="text" class="form-control" id="3" value={{ $orderInfo['transaction_id'] }}
                            placeholder="transaction id">  
                        @else
                        <input name='transaction_id' type="text" class="form-control" id="3" 
                            placeholder="transaction id">    
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="4" class="form-label">Billing Address :</label>
                        @if ($orderInfo['billing_address'])
                        <input name='billing_address' type="textarea" class="form-control" id="4" value={{ $orderInfo['billing_address'] }}
                        placeholder="billing address">
                        @else
                        <textarea name='billing_address' type="textarea" class="form-control" id="4"
                        placeholder="billing address"></textarea>    
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="5" class="form-label">Shipping Address :</label>
                        @if ($orderInfo['shipping_address'])
                        <input name='shipping_address' type="textarea" class="form-control" id="4" value={{ $orderInfo['shipping_address'] }}
                        placeholder="shipping_address"> 
                        @else
                        <textarea name='shipping_address' type="textarea" class="form-control" id="4"
                        placeholder="shipping_address"></textarea>    
                        @endif
                    </div>
                    <div class=" d-flex justify-content-between">
                        <div class="mb-2">
                            <label class="form-label" for="inputGroupSelect01">Add Product :</label>
                            <select name='id' class="form-select" id="inputGroupSelect01">
                                <option selected disabled>Choose Product</option>
                                @if ($products->count())
                                    @foreach ($products as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endForeach
                                @else
                                    No Record Found
                                @endif
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="6" class="form-label">Quantity :</label>
                            <input name='quantity' type="text" class="form-control" id="6" placeholder="quantity">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <input type="submit" class='btn  btn-info btn-sm' value="Add Product">

                        <button onclick="window.location.href='{{ route('orders') }}'" type="button"
                        class='btn btn-danger btn-sm'>Back</button>
                        
                    </div>
                   
                </form>
    
            </div>


            {{-- table --}}
            <div>
                <h5 class="mt-3">Listed Products</h5>
                <div class="mb-3 d-flex justify-content-between">
                    <button onclick="window.location.href='{{ route('orderCheckout' , $orderInfo) }}'" type="button"
                        class='btn btn-primary  btn-sm'>Checkout</button>
                    <button  onclick="window.location.href='{{ route('clearCart' ) }}'" type="button"
                    class='btn btn-warning  btn-sm'>Clear Cart</button> 
                     
                       
                    
                
                </div>
            <table class="table table-striped table-hover border">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                           @if($orderInfo['products'])
                           
                            @foreach ($orderInfo['products']  as $order)
                            <tr class="text-center">
                              <td class="w-50"><img class="w-25" src={{$order['image'] }} alt=""> </td>
                              <td class="w-25">{{ $order['name'] }} </td> 
                              <td class="w-25">{{ $order['quantity'] }} </td> 
                              <td class="w-25">{{ $order['total'] }} </td>    
                            </tr>
                            @endforeach
                           
                           @else
                           
                           @endif
                           <tr>
                            <td></td>
                            <td></td>
                            @if ($orderInfo['total_price'])
                            <td>Total</td>
                            <td>{{ $orderInfo['total_price'] }}</td>
                            @endif
                           </tr>
                        
                       
                </tbody>
              </table>
            </div>
        </div>
    @endsection

    {{-- $order = new Order;
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
            $orderdetails->save(); --}}
