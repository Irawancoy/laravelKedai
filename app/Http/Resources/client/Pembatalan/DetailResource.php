<?php

namespace App\Http\Resources\client\Pembatalan;

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
          'id' => $this->resource->id,
            'id_transaksi' => $this->resource->id_transaksi,
            'keterangan' => $this->resource->keterangan,
            'status' => $this->resource->status,
           'transaksi'=>[
            'id' => $this->resource->transaksi->id_transaksi,
            'no_struk' => $this->resource->transaksi->no_struk,
            'tanggal_sewa'=>$this->resource->transaksi->tanggal_sewa,
            'jam_mulai'=>$this->resource->transaksi->jam_mulai,
            'jam_selesai'=>$this->resource->transaksi->jam_selesai,
            'jenis_transaksi'=>$this->resource->transaksi->jenis_transaksi,
            'total_harga'=>$this->resource->transaksi->total,
            'bayar'=>$this->resource->transaksi->bayar,
            'kurang_bayar'=>$this->resource->transaksi->kurang_bayar,
            'status'=>$this->resource->transaksi->status,
        ]
    ];
    }
}
