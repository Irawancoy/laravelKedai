<?php

namespace App\Http\Resources\Admin\Rekening;

use Illuminate\Http\Resources\Json\JsonResource;

class RekeningResource extends JsonResource
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
            'id' => $this->id,
            'nama_pemilik' => $this->nama_pemilik,
            'nama_bank'=>$this->nama_bank,
            'nomor_rekening'=>$this->nomor_rekening
            
         
        ];

    }
}
