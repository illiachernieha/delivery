<?php

namespace App\Repositories;

use App\Models\DelayedOrder;
use App\Models\Order;
use Delivery\Order\DTO\GetDelayOrderDTO;
use Delivery\Order\DTO\GetOrderDTO;
use Delivery\Order\DTO\UpdateOrderDTO;
use Delivery\Order\Order as OrderEntity;
use Delivery\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrdersRepository implements OrderRepositoryInterface
{
    public function saveOrder(OrderEntity $orderDetails)
    {
        $orderModel = new Order();

        $orderModel->expected_time = $orderDetails->getExpectedTime()->format('H:i:s');
        $orderModel->delivery_address = $orderDetails->getDeliveryAddress();
        $orderModel->billing_address = $orderDetails->getBillingAddress();
        $orderModel->customer_id = $orderDetails->getCustomerId();
        $orderModel->item_id = $orderDetails->getOrderItems()->get('itemId');
        $orderModel->item_quantity = $orderDetails->getOrderItems()->get('itemQuantity');
        $orderModel->status = $orderDetails->getStatus();

        $orderModel->save();
    }

    public function updateOrder(UpdateOrderDTO $updateOrderDTO)
    {
        Order::where('id', $updateOrderDTO->getOrderId())
            ->update(['status' => $updateOrderDTO->getStatus()]);

        return DB::table('orders')->select('*')->where('id', $updateOrderDTO->getOrderId());
    }

    public function getOrders(GetOrderDTO $orderDTO)
    {
        $query = Order::query();
        $query->select('*');
        if (!empty($orderDTO->getStatus())) {
            $query->where('status', $orderDTO->getStatus());
        } elseif (!empty($orderDTO->getOrderId())) {
            $query->where('id', $orderDTO->getOrderId());
        }

        return $query->get();
    }

    public function getDelayedOrders(GetDelayOrderDTO $delayOrderDTO)
    {
        return DelayedOrder::select('*')
            ->whereBetween('expected_time', [$delayOrderDTO->getStartTime(), $delayOrderDTO->getEndTime()])
            ->orderBy('expected_time', 'asc')
            ->get();
    }
}
