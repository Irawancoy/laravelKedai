<?php

namespace App\Http\Resources\client\Transaksi;

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
        $pembatalanStatus = $this->pembatalan ? $this->pembatalan['status'] : 0;
        // dd($request);
        return [
            'id_transkasi' => $this->resource->id_transaksi,
            'no_struk' => $this->resource->no_struk,
            'id_customer' => $this->resource->id_customer,
            'nama_customer' => $this->resource->customer->nama,
            'telp_customer' => $this->resource->customer->no_hp,
            'telp_customer2' => $this->resource->no_hp,
            'email_customer' => $this->resource->customer->email,
            'tanggal_sewa' => $this->resource->tanggal_sewa,
            'jam_mulai' => $this->resource->jam_mulai,
            'jam_selesai' => $this->resource->jam_selesai,
            'status' => $this->resource->status,
            'status_pelunasan' => $this->resource->status_pelunasan,
            'status_pembatalan' => $pembatalanStatus,
            'tamu' => $this->resource->tamu,
            'harga_ruang' => $this->resource->harga_ruang,
            'foto_ktp' => $this->resource->fotoUrl(),
            'total' => $this->resource->total,
            'bayar'=>$this->resource->bayar,
            'kurang_bayar'=>$this->resource->kurang_bayar,
            'detail_menu'=>$this->resource->detailMenu->map(function($item){
                return[
                    'id_detail_menu' => $item->id_det_transaksi_menu,
                    'id_menu' => $item->id_menu,
                    'nama' => $item->detail_menu->nama,
                    'kategori' => $item->detail_menu->kategori,
                    'harga' => $item->detail_menu->harga,
                    'jumlah' => $item->jumlah,
                ];
            }),
            'detail_ruangan'=>$this->resource->detailRuangan->map(function($item){
                return[
                    'id_detail_ruangan' => $item->id_det_transaksi_ruangan,
                    'id_ruangan' => $item->id_ruangan,
                    'nama' => $item->detail_ruangan->nama,
                ];
            }),
        ];
    }
}
