<?php

namespace App\Http\Resources;
use TCG\Voyager\Facades\Voyager;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name ? $this->name : '',
            'icon' => $this->icon ? Voyager::image( $this->icon ) : '',
        ];
    }
}
