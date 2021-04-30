<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => url($this->image),
            'price' => number_format($this->price - $this->discountExists(), 2),
            'description' => $this->description,
            'price_before' => number_format($this->price, 2),

        ];
    }
}
