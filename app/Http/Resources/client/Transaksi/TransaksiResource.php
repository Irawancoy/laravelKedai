<?php

namespace App\Http\Resources\client\Transaksi;

use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request){

        $pembatalanStatus = $this->pembatalan ? $this->pembatalan['status'] : 0;
 
        return [
            'id_transaksi' => $this->id_transaksi,
            'no_struk' => $this->no_struk,
            'id_customer' => $this->id_customer,
            'nama_customer' => $this->customer->nama,
            'telp_customer' => $this->customer->no_hp,
            'telp_customer2' => $this->no_hp,
            'email_customer' => $this->customer->email,
            'tanggal_sewa' => $this->tanggal_sewa,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'jenis_transaksi' => $this->jenis_transaksi,
            'status' => $this->status,
            'status_pelunasan' => $this->status_pelunasan,
            'status_pembatalan' => $pembatalanStatus,
            'tamu' => $this->tamu,
            'harga_ruang' => $this->harga_ruang,
            'foto_ktp' => $this->fotoUrl(),
            'total' => $this->total,
            'bayar'=>$this->bayar,
            'kurang_bayar'=>$this->kurang_bayar,
            'detail_menu'=>$this->detailMenu->map(function($item){
                return[
                    'id_detail_menu' => $item->id_det_transaksi_menu,
                    'id_menu' => $item->id_menu,
                    'nama' => $item->detail_menu->nama,
                    'kategori' => $item->detail_menu->kategori,
                    'harga' => $item->detail_menu->harga,
                    'jumlah' => $item->jumlah,
                ];
            }),
            'detail_ruangan'=>$this->detailRuangan->map(function($item){
                return[
                    'id_detail_ruangan' => $item->id_det_transaksi_ruangan,
                    'id_ruangan' => $item->id_ruangan,
                    'nama' => $item->detail_ruangan->nama,
                ];
            }),

        ];
        
    }
}
