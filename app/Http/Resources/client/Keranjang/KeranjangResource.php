<?php

namespace App\Http\Resources\client\Keranjang;

use Illuminate\Http\Resources\Json\JsonResource;

class KeranjangResource extends JsonResource
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
            'id_keranjang' => $this->id_keranjang,
            'id_customer' => $this->id_customer,
            'tamu' => $this->tamu,
            'tanggal_sewa' => $this->tanggal_sewa,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'harga_ruang' => $this->harga_ruang,
            'total' => $this->total,
            'detail_menu'=>$this->detailMenu->map(function($item){
                return[
                    'id_detail_menu' => $item->id,
                    'id_menu' => $item->id_menu,
                    'nama' => $item->detail_menu->nama,
                    'kategori' => $item->detail_menu->kategori,
                    'harga' => $item->detail_menu->harga,
                    'jumlah' => $item->jumlah,
                ];
            }),
            'detail_ruangan'=>$this->detailRuangan->map(function($item){
                return[
                    'id_detail_ruangan' => $item->id,
                    'id_ruangan' => $item->id_ruangan,
                    'nama' => $item->detail_ruangan->nama,
                ];
            }),

        ];
        
    }
}
