<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function view()
    {
       $users = User::all();
       //dd($products);
       return view('user.users')->with('users',$users);
    }

    //this will add products
    public function add()
    {
        return view('user.userAdd');
    }

    public function postadd(Request $rqst)
    {
        //dd($rqst->all());
          //$all = $rqst->all();
           $user = new User;
          $user->name = $rqst->name;
          $user->email = $rqst->email;
          $user->password = Hash::make($rqst->password);
          $user->roles = ($rqst->roles == "admin" ? 0 : 1);
          $user->save();
          $users = User::all();
          return view('user.users')->with('users',$users);
    }

    public function edit(Request $rqst)
    {
         //$rqst->all();
        $id =  array_key_first($rqst->all());
        $user = User::find($id);
        //dd($product);
        return view('user.userEdit')->with('user',$user);
    }

    public function postedit(Request $rqst)
    {
       
        //dd($rqst->all());
          $product = User::find($rqst->id);
          $product->name = $rqst->name;
          $product->email = $rqst->email;
          $product->roles= ($rqst->roles == "admin" ? 0 : 1);
          $product->update();
          $products = User::all();
          return view('user.users')->with('users',$products);
    }

    public function delete(Request $rqst)
    {
         //$rqst->all();
        $id =  array_key_first($rqst->all());
        $product = User::find($id);
        //dd($product);
        return view('user.userDelete')->with('user',$product);
    }

    public function postdelete(Request $rqst)
    {
       
        //dd($rqst->all());
          $product = User::find($rqst->id);
          $product->delete();
          $products = User::all();
          return view('user.users')->with('users',$products);
    }
}
