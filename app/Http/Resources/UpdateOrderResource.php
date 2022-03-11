<?php

namespace App\Http\Resources;

use Delivery\Order\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order<Order>
 */
class UpdateOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        foreach ($this->getOrderItems() as $item) {
            $itemId = $item['itemId'];
            $itemQuantity = $item ['itemQuantity'];
        }

        return [
                'id' => $this->getOrderId(),
                'expectedTime' => $this->getExpectedTime(),
                'deliveryAddress' => $this->getDeliveryAddress(),
                'billingAddress' => $this->getBillingAddress(),
                'customerId' => $this->getCustomerId(),
                'itemId' => $itemId,
                'itemQuantity' => $itemQuantity,
                'status' => $this->getStatus()
        ];
    }
}
