<?php

namespace App\Http\Resources\Product;

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
        'name' => $this->name,
        'description' => $this->detail,
        'price' => $this->price,
        'stock' => $this->stock == 0 ? "Out of stock" : $this->stock,
        'discount' => $this->discount,
        'rating' => $this->reviews->count() > 0  ?round($this->reviews->sum('star')/$this->reviews->count(), 2) : 'No Ratings Yet',
        'totalprice' => round((1-($this->discount/100)) * $this->price ),

        'href' => [
            'reviews' => route('reviews.index',$this->id)

        ]

       ];
    }
}
