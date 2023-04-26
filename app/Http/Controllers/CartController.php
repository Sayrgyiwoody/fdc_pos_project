<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartList() {
        $cart = Cart::select('carts.*','products.name as product_name','products.image as image','products.price as product_price')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('user_id',Auth::user()->id)->paginate(4);
        $totalPrice = 0;
        foreach($cart as $c) {
            $totalPrice += $c->product_price * $c->qty;
        }
        return view('user.main.cartList',compact('cart','totalPrice'));
    }
}
