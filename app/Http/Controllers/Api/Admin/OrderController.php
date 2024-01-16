<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\OrderStatusType;
use App\Http\Controllers\Controller;
use App\Http\Requests\order\updateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'check_admin']);
    }
    public function index()
    {  
        $order = Order::with('orderItems')->paginate(5);
        return OrderResource::collection($order);
    }
    public function show(Order $order)
    {
        $order_data = Order::with('orderItems')->where('id', $order['id'] )->get();
        return OrderResource::collection($order_data);
    }
    public function destroy(Order $order)
    {
        $order->delete();

        return response(__('deleted successfully'), Response::HTTP_OK);
    }
    public function update( Order $order)
    {
      
        if ($order->order_status == OrderStatusType::received) {
            $order->update(['order_status' => OrderStatusType::InPreparation->value]);
        } else {
            $order->update(['order_status' => OrderStatusType::COMPLETED->value]);
        }
        return $this->showOne($order, OrderResource::class, __('update successfully'), 200);
    }

}
