<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderListController extends Controller
{
    public function orderList(Request $request) {
        $total = 0;
        foreach($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'total' => $item['total'],
                'qty' => $item['qty'],
                'order_code' => $item['order_code']
            ]);
            $total += $item['total'];
        };

        //Delete the cart after order
        Cart::where('user_id',Auth::user()->id)->delete();

        //Add order lists to order table
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000
        ]);
        return response()->json([
            'status' => 'true'
        ], 200);
    }
}
