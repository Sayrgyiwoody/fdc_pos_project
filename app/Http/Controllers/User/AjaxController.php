<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list according to option value
    // public function pizzaList(Request $request) {
    //     if($request->status == 'asc') {
    //     $data = Product::orderBy('created_at' , 'asc')->get();
    //     } elseif ($request->status == 'desc') {
    //     $data = Product::orderBy('created_at' , 'desc')->get();
    //     }
    //     return $data;
    // }

    //Add to cart
    public function addToCart(Request $request) {
        $data = $this->getCartData($request);
        Cart::create($data);
        $response = [
            'status'=>'success',
            'addCartMessage'=>'Product added to cart successfully'
        ];
        return response()->json($response,200);
    }

    //add to cart from home page
    public function addCart(Request $request) {
        $data = $this->getCartData($request);
        Cart::create($data);
        return back()->with(['addCartMessage'=>'Product added to cart successfully']);
    }

    //get cart request data to array type
    private function getCartData($request) {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->productCount,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    //Delete all from cart list
    public function deleteAll() {
        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json(200);
    }

    //Delete Each cart list
    public function delete(Request $request) {
        Cart::where('user_id',$request->userId)
        ->where('product_id',$request->productId)
        ->where('id',$request->cartId)
        ->delete();
        return response()->json(200);
    }
}
