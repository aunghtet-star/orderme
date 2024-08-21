<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // direct order list page
    public function list(){
        $order = Order::select('orders.*','users.name as u_name')
               ->when(request('key'),function($query){
                $query->where('name','like','%'.request('key').'%');
                })
                ->orderBy('id','desc')
               ->leftJoin('users','orders.user_id','users.id')
               ->get();
    // $order->appends(request()->all());
        return view('admin.order.list',compact('order'));
    }

    // order  status
    public function changeStatus(Request $request){


        // $request->status = $request->status == null ? "" : $request->status;

        $order = Order::select('orders.*','users.name as u_name')
               ->leftJoin('users','orders.user_id','users.id')
               ->orderBy('id','desc');

        if($request->orderStatus == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->orderStatus)->get();
        }
        return view('admin.order.list',compact('order'));
    }

    // ajax change status
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*','users.name as u_name')
                ->leftJoin('users','orders.user_id','users.id')
                ->orderBy('id','desc')
                ->get();

        return response()->json($order,200);
    }

    // order info
    public function listInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();

        $orderList = OrderList::select('order_lists.*','users.name as u_name','products.name as p_name','products.image as p_image')
                   ->leftJoin('users','order_lists.user_id','users.id')
                   ->leftJoin('products','order_lists.product_id','products.id')
                   ->where('order_code',$orderCode)
                   ->get();
        return view('admin.order.orderInfo',compact('orderList','order'));
    }
}
