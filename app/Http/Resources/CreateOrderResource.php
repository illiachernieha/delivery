<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Delivery\Order\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order<Order>
 */
class CreateOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'status' => $this->getStatus(),
            'expectedDeliveryTime' => Carbon::make($this->getExpectedTime())->toString(),
        ];
    }
}
