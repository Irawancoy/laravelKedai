<?php

namespace App\Http\Resources\client\Keranjang;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

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
        // dd($request);
        return [
            'id_keranjang' => $this->resource->id_keranjang,
            'id_customer' => $this->resource->id_customer,
            'tamu' => $this->resource->tamu,
            'tanggal_sewa' => $this->resource->tanggal_sewa,
            'jam_mulai' => $this->resource->jam_mulai,
            'jam_selesai' => $this->resource->jam_selesai,
            'harga_ruang' => $this->resource->harga_ruang,
            'total' => $this->resource->total,
            'detail_menu'=>$this->resource->detailMenu->map(function($item){
                return[
                    'id_detail_menu' => $item->id,
                    'id_menu' => $item->id_menu,
                    'nama' => $item->detail_menu->nama,
                    'kategori' => $item->detail_menu->kategori,
                    'harga' => $item->detail_menu->harga,
                    'jumlah' => $item->jumlah,
                ];
            }),
            'detail_ruangan'=>$this->resource->detailRuangan->map(function($item){
                return[
                    'id_detail_ruangan' => $item->id,
                    'id_ruangan' => $item->id_ruangan,
                    'nama' => $item->detail_ruangan->nama,
                ];
            }),
        ];
    }
}
