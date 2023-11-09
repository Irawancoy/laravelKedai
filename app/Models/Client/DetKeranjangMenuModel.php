<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\RecordSignature;
use App\Models\Admin\MenuModel;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class DetKeranjangMenuModel extends Model
{
    use HasFactory, HasRelationships, SoftDeletes;

    protected $table = 't_detailkeranjangmenu';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_keranjang',
        'id_menu',
        'jumlah',
    ];


    public function detail_menu(){
        return $this->belongsTo(MenuModel::class, 'id_menu', 'id_menu');
    }

    public function detail_keranjang()
{
    return $this->belongsTo(KeranjangModel::class, 'id_keranjang', 'id_keranjang');
}


   
}
