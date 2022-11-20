<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function createOrder(CreateOrderRequest $request)
    {
        DB::beginTransaction();
        $order = Order::create($request->all());

        if ($order) {
            $order->orderItems()->createMany($request->items);
            DB::commit();
            return response()->json(['message' => 'Order created successfully'], 201);
        } else {
            DB::rollBack();
            return response()->json(['message' => 'Order not created'], 500);
        }
    }

    public function getOrders()
    {
        $orders = Order::with('orderItems')->paginate(10);
        return response()->json($this->ordersPaginationMapper($orders), 200);
    }

    public function getOrder($id)
    {
        $order = Order::with('orderItems')->find($id);
        if ($order) {
            return response()->json($order, 200);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    public function ordersPaginationMapper($orders)
    {
        return [
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
            'data' => $orders->items(),
        ];
    }

}
