<?php

namespace App\Http\Resources;

use TCG\Voyager\Facades\Voyager;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     function prepareImages($images){
         $final = [];

         $images =   json_decode($images);

         foreach ($images as $image) {
           array_push($final, Voyager::image( $image ));
         }
        return $final;
     }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'images' => $this->prepareImages($this->images),
            'on_offer' => $this->on_offer ? true : false,
            'price' => [
                'regular_price' => $this->regular_price,
                'offer_price' => $this->offer_price,
            ],
            'category' => new CategoryResource($this->category),
            'brand' => new BrandResource($this->brand),
            'description' => $this->description ? $this->description : '',
            'quantity' => $this->quantity ? $this->quantity : '',
            
            
        ];
    }
}
