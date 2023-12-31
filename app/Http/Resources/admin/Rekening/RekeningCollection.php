<?php

namespace App\Http\Resources\Admin\Rekening;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RekeningCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
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
