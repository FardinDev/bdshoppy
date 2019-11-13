<?php

namespace App\Http\Resources;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'image' => $this->img ? Voyager::image( $this->img ) : '',
            'description' => $this->description ? $this->description : '',
        ];
    }
}
