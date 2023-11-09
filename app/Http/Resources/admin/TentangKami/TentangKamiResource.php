<?php

namespace App\Http\Resources\Admin\TentangKami;

use Illuminate\Http\Resources\Json\JsonResource;

class TentangKamiResource extends JsonResource
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
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'alamat'=>$this->alamat,
            'gambar' => $this->fotoUrl()  ,
            'no_hp'=>$this->no_hp,
        ];

    }
}
