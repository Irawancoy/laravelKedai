<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiModel extends Model
{
    use HasFactory,HasRelationships,SoftDeletes;

    protected $table = 't_transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = true;

    protected $fillable = [
        'no_struk',
        'id_customer',
        'tamu',
        'harga_ruang',
        'total',
        'bayar',
        'kurang_bayar',
        'tanggal_sewa',
        'jam_mulai',
        'jam_selesai',
        'jenis_transaksi',
        'foto_ktp',
        'status',
        'no_hp',
        'catatan',
        'status_pelunasan'
    ];
    public function fotoUrl() {
        if(empty($this->foto_ktp)) {
            return asset('assets/img/kosong.jpg');
        }

        // return $this->gambar;
        return asset('storage/'.$this->foto_ktp);

    }

    public function customer()
    {
        return $this->belongsTo(UserModel::class, 'id_customer', 'id');
    }

    public function detailMenu()
    {
        return $this->hasMany(DetTransaksiMenuModel::class, 'id_transaksi', 'id_transaksi');
    }

    public function detailRuangan()
    {
        return $this->hasMany(DetTransaksiRuanganModel::class, 'id_transaksi', 'id_transaksi');
    }

    public function pembatalan()
    {
        return $this->hasOne(PembatalanModel::class, 'id_transaksi', 'id_transaksi');
    }
 
    public function store(array $payload)
{
    return $this->create($payload);
}

public function getAll():object
{
    return $this->query()->with('detailMenu.detail_menu', 'detailRuangan.detail_ruangan')->get();

}
public function getById(int $keranjangId):object
{
    // dd($keranjangId);
    return $this->with('detailMenu.detail_menu', 'detailRuangan.detail_ruangan')->find($keranjangId);
}


public function getByCustomer(int $customerId):object
{
    // dd($customerId);
    return $this->with('detailMenu.detail_menu', 'detailRuangan.detail_ruangan')->where('id_customer', $customerId)->get();
}


public function edit(array $payload, int $id_keranjang){
    return $this->find($id_keranjang)->update($payload);
}

public function deleteTransaksi(int $transaksi)
{
    $transaksi = $this->find($transaksi);
    $transaksi->detailMenu()->delete();
    $transaksi->detailRuangan()->delete();
    $transaksi->pembatalan()->delete();
    return $transaksi->delete();
}


}
