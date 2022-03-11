<?php

namespace Delivery\Order;

use Carbon\Carbon;
use Delivery\Order\DTO\CreateOrderDTO;

class OrderMapper
{
    public function mapOrderEntity(CreateOrderDTO $orderDTO): Order
    {
        $order = new Order();

        $order->setExpectedTime(Carbon::createFromFormat('H:i', $orderDTO->getExpectedTime()));
        $order->setDeliveryAddress($orderDTO->getDeliveryAddress());
        $order->setBillingAddress($orderDTO->getBillingAddress());
        $order->setCustomerId($orderDTO->getCustomerId());
        $order->setOrderItems(collect($orderDTO->getOrderItems()));

        return $order;
    }

    public function mapModelToEntity($orderModel): Order
    {
        $order = new Order();

        foreach ($orderModel->get()->toArray() as $item) {
            $order->setOrderId($item->id);
            $order->setExpectedTime(Carbon::make($item->expected_time));
            $order->setDeliveryAddress($item->delivery_address);
            $order->setBillingAddress($item->billing_address);
            $order->setCustomerId($item->customer_id);
            $order->setOrderItems(collect([['itemId' => $item->item_id,'itemQuantity' => $item->item_quantity]]));
            $order->setStatus($item->status);
        }

        return $order;
    }
}
