<?php

namespace App\Models\Client;

use App\Models\Admin\LayananModel;
use App\Models\Admin\MenuModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\RecordSignature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class KeranjangModel extends Model
{

    use   HasFactory, HasRelationships, SoftDeletes;
    protected $table = 't_keranjang';
    protected $primaryKey = 'id_keranjang';
    public $timestamps = true;

    protected $fillable = [
        'id_customer',
        'harga_ruang',
        'tanggal_sewa',
        'jam_mulai',
        'jam_selesai',
      'tamu',
      'total'
    ];

    public function detailMenu(){
        return $this->hasMany(DetKeranjangMenuModel::class, 'id_keranjang', 'id_keranjang');
    }
    public function detailRuangan(){
        return $this->hasMany(DetKeranjangRuanganModel::class, 'id_keranjang', 'id_keranjang');
    }

    public function getById(int $keranjangId):object
    {
        // dd($keranjangId);
        return $this->with('detailMenu.detail_menu', 'detailRuangan.detail_ruangan')->find($keranjangId);
    }

  
public function getAll():object
{
    return $this->query()->with('detailMenu.detail_menu', 'detailRuangan.detail_ruangan')->get();

}   

public function getByCustomer(int $customerId):object
{
    // dd($customerId);
    return $this->with('detailMenu.detail_menu', 'detailRuangan.detail_ruangan')->where('id_customer', $customerId)->get();
}


public function deleteKeranjang(int $keranjangId)
{
    $keranjang = $this->find($keranjangId);
    $keranjang->detailMenu()->delete();
    $keranjang->detailRuangan()->delete();
    return $keranjang->delete();
}



public function store(array $payload)
{
    return $this->create($payload);
}

// public function edit(array $payload, int $id_keranjang){
//     return $this->find($id_keranjang)->update($payload);
// }

}
