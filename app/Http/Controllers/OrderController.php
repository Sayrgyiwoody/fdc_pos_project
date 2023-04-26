<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //customer order list page
    public function listPage() {
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.orderList',compact('order'));
    }

    //Admin order list page
    public function adminPage() {
        $order = Order::select('orders.*' , 'users.name as user_name')
        ->when(request('searchKey'),function($query){
            $query->where('order_code','like','%'.request('searchKey').'%');
        })
        ->orderBy('created_at','desc')
        ->leftJoin('users','orders.user_id','users.id')
        ->paginate(5);
        return view('admin.order.list',compact('order'));
    }

    //Sorting orders with status
    public function statusSort(Request $request) {
        $order = Order::select('orders.*' , 'users.name as user_name')
            ->orderBy('created_at','desc')
            ->leftJoin('users','orders.user_id','users.id');
        if($request->status == null ) {
            $order = $order->paginate(5);
        }else {
            $order = $order->where('status',$request->status)->paginate(5);
        }
        return view('admin.order.list',compact('order'));
    }

    //Status change
    public function statusChange(Request $request) {
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);
        return response()->json(200);
    }

    //Delete order for user
    public function delete(Request $request) {
        Order::where('order_code',$request->order_code)->delete();
        OrderList::where('order_code',$request->order_code)->delete();
        return response()->json(200);
    }

    //Delete order for admin
    public function adminDelete(Request $request) {
        Order::where('order_code',$request->order_code)->delete();
        OrderList::where('order_code',$request->order_code)->delete();
        return response()->json(200);
    }

    //Delete order for admin
    public function adminDeleteAll() {
        Order::truncate();
        OrderList::truncate();
        return response()->json(200);
    }

    //Admin Order information page
    public function info($order_code) {
        $orderInfo = OrderList::select('order_lists.*','products.image as image_name','products.name as product_name')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->where('order_code',$order_code)->paginate(2);
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->where('order_code',$order_code)
        ->first();
        // dd($order->toArray());
        return view('admin.order.info',compact('orderInfo','order'));
    }



    //user Order information page
    public function orderInfo($order_code) {
        $orderInfo = OrderList::select('order_lists.*','products.image as image_name','products.name as product_name')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->where('order_code',$order_code)->paginate(2);
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->where('order_code',$order_code)
        ->first();
        // dd($order->toArray());
        return view('user.main.order.detail',compact('orderInfo','order'));
    }
}
