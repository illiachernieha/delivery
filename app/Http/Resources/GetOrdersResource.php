<?php

namespace App\Http\Resources;

use Delivery\Order\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order<Order>
 */
class GetOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
