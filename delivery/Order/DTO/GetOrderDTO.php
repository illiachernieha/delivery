<?php

namespace Delivery\Order\DTO;

use App\Http\Requests\GetOrdersRequest;

class GetOrderDTO
{

    private int $orderId;
    private string $status;

    public function __construct(GetOrdersRequest $orderRequest)
    {
        if (!empty($orderRequest->get('orderId'))) {
            $this->orderId = $orderRequest->get('orderId');
            $this->status = '';
        } elseif (!empty($orderRequest->get('status'))) {
            $this->status = $orderRequest->get('status');
        }
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     */
    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }
}
