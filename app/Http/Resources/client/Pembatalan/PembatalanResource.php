<?php

namespace App\Http\Resources\client\Pembatalan;

use Illuminate\Http\Resources\Json\JsonResource;

class PembatalanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($request-> transaksi);   
        return [
            
            'id' => $this->id,
            'id_transaksi' => $this->id_transaksi,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
           'transaksi'=>[
            'id' => $this->transaksi->id_transaksi,
            'no_struk' => $this->transaksi->no_struk,
            'tanggal_sewa'=>$this->transaksi->tanggal_sewa,
            'jam_mulai'=>$this->transaksi->jam_mulai,
            'jam_selesai'=>$this->transaksi->jam_selesai,
            'jenis_transaksi'=>$this->transaksi->jenis_transaksi,
            'total_harga'=>$this->transaksi->total,
            'bayar'=>$this->transaksi->bayar,
            'kurang_bayar'=>$this->transaksi->kurang_bayar,
            'status'=>$this->transaksi->status,
            'tamu'=>$this->transaksi->tamu,
            'nama_customer'=>$this->transaksi->customer->nama,
            'email_customer'=>$this->transaksi->customer->email,
            'telp_customer'=>$this->transaksi->no_hp,
            'telp_customer2'=>$this->transaksi->customer->no_hp,

           ]
           ];
        
    }
}
