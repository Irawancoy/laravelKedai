<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\RecordSignature;
use App\Models\Admin\LayananModel;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class DetKeranjangRuanganModel extends Model
{
    use HasFactory, HasRelationships, SoftDeletes;

    protected $table = 't_detailkeranjangruangan';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_keranjang',
        'id_ruangan',
    ];

    public function detail_keranjang(){
        return $this->belongsTo(KeranjangModel::class, 'id_keranjang', 'id_keranjang');
    }

    public function detail_ruangan(){
        return $this->belongsTo(LayananModel::class, 'id_ruangan', 'id_ruangan');
    }


    
}
