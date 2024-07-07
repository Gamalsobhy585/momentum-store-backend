<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'shortDescription' => $this->shortDescription,
            'detailedDescription' => $this->detailedDescription,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'rate' => $this->rate,
        ];
    }
}
