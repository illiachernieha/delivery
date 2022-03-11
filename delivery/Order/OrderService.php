<?php

namespace Delivery\Order;

use App\Models\Order;
use App\Repositories\OrdersRepository;
use Delivery\Order\DTO\CreateOrderDTO;
use Delivery\Order\DTO\GetDelayOrderDTO;
use Delivery\Order\DTO\GetOrderDTO;
use Delivery\Order\DTO\UpdateOrderDTO;
use Delivery\Order\Order as OrderEntity;
use Illuminate\Support\Collection;

class OrderService
{
    private OrderMapper $orderMapper;
    private OrdersRepository $ordersRepository;

    public function __construct(OrderMapper $orderMapper, OrdersRepository $ordersRepository)
    {
        $this->orderMapper = $orderMapper;
        $this->ordersRepository = $ordersRepository;
    }

    public function createOrder(CreateOrderDTO $DTO): OrderEntity
    {
        $orderEntity = $this->orderMapper->mapOrderEntity($DTO);
        $orderEntity->setStatus(Status::NEW->name);

        $this->ordersRepository->saveOrder($orderEntity);

        $orderEntity->setOrderId(Order::latest()->first()->id);

        return $orderEntity;
    }

    public function updateOrder(UpdateOrderDTO $updateOrderDTO): OrderEntity
    {
        $orderModel = $this->ordersRepository->updateOrder($updateOrderDTO);

        return $this->orderMapper->mapModelToEntity($orderModel);
    }

    public function getOrders(GetOrderDTO $orderDTO): Collection
    {
        return $this->ordersRepository->getOrders($orderDTO);
    }

    public function getDelayedOrders(GetDelayOrderDTO $orderDTO): Collection
    {
        return $this->ordersRepository->getDelayedOrders($orderDTO);
    }
}
