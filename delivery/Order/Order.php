<?php

namespace Delivery\Order;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Order
{
    private int $orderId;

    private Carbon $expectedTime;

    private string $deliveryAddress;
    private string $billingAddress;

    private int $customerId;

    /** @var Collection<Item> */
    private Collection $orderItems;

    private string $status;

    /**
     * @return string
     */
    public function getBillingAddress(): string
    {
        return $this->billingAddress;
    }

    /**
     * @return Collection
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return Carbon
     */
    public function getExpectedTime(): Carbon
    {
        return $this->expectedTime;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }
    /**
     * @param Collection $orderItems
     */
    public function setOrderItems(Collection $orderItems): void
    {
        $this->orderItems = $orderItems;
    }

    /**
     * @param int $orderId
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @param Carbon $expectedTime
     */
    public function setExpectedTime(Carbon $expectedTime): void
    {
        $this->expectedTime = $expectedTime;
    }

    /**
     * @param string $deliveryAddress
     */
    public function setDeliveryAddress(string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @param string $billingAddress
     */
    public function setBillingAddress(string $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
