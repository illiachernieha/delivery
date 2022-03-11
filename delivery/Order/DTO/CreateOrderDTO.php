<?php

namespace Delivery\Order\DTO;

class CreateOrderDTO
{
    private array $orderDetails;
    private int $customerId;
    private array $orderItems;

    /**
     * @param int $customerId
     * @return CreateOrderDTO
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @param array $orderItems
     * @return CreateOrderDTO
     */
    public function setOrderItems(array $orderItems): self
    {
        $this->orderItems = $orderItems;

        return $this;
    }

    /**
     * @param array $orderDetails
     * @return CreateOrderDTO
     */
    public function setOrderDetails(array $orderDetails): self
    {
        $this->orderDetails = $orderDetails;

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return array
     */
    public function getOrderItems(): array
    {
        return $this->orderItems;
    }

    /**
     * @return array
     */
    public function getOrderDetails(): array
    {
        return $this->orderDetails;
    }

    public function getExpectedTime()
    {
        return $this->getOrderDetails()['expectedTime'];
    }

    public function getDeliveryAddress()
    {
        return $this->getOrderDetails()['deliveryAddress'];
    }

    public function getBillingAddress()
    {
        return $this->getOrderDetails()['billingAddress'];
    }
}
