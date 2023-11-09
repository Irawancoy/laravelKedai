<?php

namespace App\Http\Resources\client\Pembatalan;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PembatalanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'list' => $this->collection, // otomatis mengikuti format UserResource
  
        ];
    }
}
