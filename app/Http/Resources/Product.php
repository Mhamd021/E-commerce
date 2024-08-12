<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'store_id' => $this->shops_id,
            'name' => $this->name,
            'price' => $this->price,
            'category' => $this->category,
            'detail' => $this->detail,
           'quantity' => $this->quantity,
            'image' => $this->image,
        ];
    }
}
