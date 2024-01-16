<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatusType;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\order\updateOrderRequest;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    public function index()
    {
        /** @var User $user */
        $order = auth()->user()->order()->with('orderItems')->paginate(5);
        return OrderResource::collection($order);
    }
    public function show(Order $order)
    {
        $user_id = auth()->user()->id;
        $order_data = Order::with('orderItems')
            ->where('user_id', $user_id)
            ->first();
        return new OrderResource($order_data);
    }

    public function store(StoreOrderRequest $request)
    {

        $order = Order::create([
            'user_id' => auth()->user()->id,
        ]);

        foreach ($request->orderItems as $productId => $productData) {

            $product = product::where('id', $productData['id'])->first();
            $orderItem = OrderItem::create([
                'product_id' => $productData['id'],
                'order_id' => $order->id,
                'price_item' => $productData['quantity'] * $product->price,
                'quantity_item' => $productData['quantity'],
            ]);
            $total=0;
            $total=+ $orderItem->price_item;
            $order->update(['total'=>$total]);
            $product = $orderItem->product;
            $product->update([
                'quantity' => $product->quantity - $productData['quantity'],
            ]);
        }
        return response(__('store successfully'), Response::HTTP_OK);

    }
   
    public function destroy(Order $order)
    {
        OrderItem::where('order_id', $order['id'])->delete();
        $order->delete();

        return response(__('deleted successfully'), Response::HTTP_OK);
    }
}
 // public function update(updateOrderRequest $request, Order $order)
    // {
    //     $orderData = $request->validated();
    
    //     // Initialize total outside the loop
    //     $total = 0;
    
    //     foreach ($request->orderItems as $productData) {
    //         $productId = $productData['id'];
    //         $quantity = $productData['quantity'];
    
    //         $product = Product::findOrFail($productId);
    
    //         $orderItem = OrderItem::updateOrCreate(
    //             [
    //                 'product_id' => $productId,
    //                 'order_id' => $order->id,
    //             ],
    //             [
    //                 'price_item' => $product->price * $quantity,
    //                 'quantity_item' => $quantity,
    //             ]
    //         );
    
    //         // Accumulate order item prices for total
    //         $total += $orderItem->price_item;
    
    //         // Adjust product quantity based on the change in order quantity
    //         $product->update([
    //             'quantity' => $product->quantity - $quantity + $orderItem->quantity_item,
    //         ]);
    //     }
    
    //     // Update the order total after processing all order items
    //     $order->update(['total' => $total]);
    
    //     // Update the order data
    //     $order->update($orderData);
    
    //     return $this->showOne($order, OrderResource::class, __('Update successful'), 200);
    // }