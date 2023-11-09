<?php

namespace App\Http\Resources\Admin\Rekening;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
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
            'id' => $this->resource->id,
            'nama_pemilik' => $this->resource->nama_pemilik,
            'nama_bank'=>$this->resource->nama_bank,
            'nomor_rekening'=>$this->resource->nomor_rekening
            
         
        ];
    }
}
