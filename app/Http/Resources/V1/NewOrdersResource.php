<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_date' => $this->order_date,
            'total_amount' => $this->total_amount,
            'delivery_address' => $this->delivery_address,
            'items' => $this->orderItem->map(function ($item) {
                return [
                    'product' => $item->product,
                    'quantity' => $item->quantity,
                ];
            })->toArray(),
        ];
    }
}
