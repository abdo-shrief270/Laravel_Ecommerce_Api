<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getAll(Request $request)
    {
        if (Order::count() >= 30) {

            $perPage = 10;
            $request->page = $request->page ?: 1;
            $orders = Order::with('products')->paginate($perPage, ['*'], 'page', $request->page);
            $custom = collect(['has_error' => false, 'message' => 'Orders was found']);
            $res = $custom->merge($orders);
            return response()->json($res);
        }
        $orders = Order::with('products')->get();
        $res = [
            'has_error' => false,
            'message' => 'order was found',
            'data' => $orders
        ];
        return response()->json($res);
    }
    public function orderProductsByPage(Request $request, $id)
    {
        $order = Order::with('products')->find($id);

        if (count($order->products) >= 20) {

            $perPage = 5;
            $request->page = $request->page ?: 1;
            $orders = Order::with('products')->products->paginate($perPage, ['*'], 'page', $request->page);
            $custom = collect(['has_error' => false, 'message' => "Order's products wasn found"]);
            $res = $custom->merge($orders);
            return response()->json($res);
        } elseif (count($order->products) == 0) {

            $res = [
                'has_error' => true,
                'message' => "Order's products wasn't found"
            ];
            return response()->json($res);
        } else {
            $res = [
                'has_error' => false,
                'message' => "Order's products was found",
                'data' => $order->products
            ];
            return response()->json($res);
        }
    }
    public function orderById($id)
    {
        $order = Order::with('products')->find($id);
        if ($order) {
            $res = [
                'has_error' => false,
                'message' => 'Order was found',
                'data' => $order
            ];
        }else{
            $res = [
                'has_error' => true,
                'message' => "Order wasn't found"
                
            ];
        }
        return response()->json($res);
    }
}
