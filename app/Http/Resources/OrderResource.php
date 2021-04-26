<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product' => $this->product->name,
            'billing_total' => number_format($this->billing_total, 2),
            'order_number' => $this->order_number,
            'date' => $this->created_at->diffForHumans()
        ];
    }
}
