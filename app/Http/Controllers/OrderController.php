<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\GetDelayOrdersRequest;
use App\Http\Requests\GetOrdersRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\CreateOrderResource;
use App\Http\Resources\GetDelayOrdersResource;
use App\Http\Resources\GetOrdersResource;
use App\Http\Resources\UpdateOrderResource;
use Delivery\Order\DTO\CreateOrderDTO;
use Delivery\Order\DTO\GetDelayOrderDTO;
use Delivery\Order\DTO\GetOrderDTO;
use Delivery\Order\DTO\UpdateOrderDTO;
use Delivery\Order\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createOrder(CreateOrderRequest $request): JsonResponse
    {
        $orderDTO = new CreateOrderDTO();

        $orderDTO->setOrderDetails($request->get('orderDetails'));
        $orderDTO->setCustomerId($request->get('customerId'));
        $orderDTO->setOrderItems($request->get('orderItems'));

        $order = $this->orderService->createOrder($orderDTO);

        return response()->json([
            'message' => 'Order is successfully created, waiting for approval',
            'order' => [CreateOrderResource::make($order)]
        ]);
    }

    public function updateOrder(UpdateOrderRequest $request, $orderId): JsonResponse
    {
        $orderDTO = new UpdateOrderDTO();
        $orderDTO->setStatus($request->get('status'));
        $orderDTO->setOrderId($orderId);

        $order = $this->orderService->updateOrder($orderDTO);

        return response()->json([
            'message' => 'Order status has been successfully updated',
            'order' => [UpdateOrderResource::make($order)]
        ]);
    }

    public function getOrders(GetOrdersRequest $request): JsonResponse
    {
        $orderDTO = new GetOrderDTO($request);

        $orders = $this->orderService->getOrders($orderDTO);

        return response()->json([
            'message' => 'All orders selected with used filter (id or status)',
            'orders' => GetOrdersResource::collection($orders)
        ]);
    }

    public function getDelayedOrders(GetDelayOrdersRequest $request)
    {
        $delayOrderDTO = new GetDelayOrderDTO();
        $delayOrderDTO->setStartTime($request->get('startTime'));
        $delayOrderDTO->setEndTime($request->get('endTime'));

        $orders = $this->orderService->getDelayedOrders($delayOrderDTO);

        return response()->json([
            'message' => 'All orders that have delay for expected time of delivery',
            'orders' => GetDelayOrdersResource::collection($orders)
        ]);
    }
}
