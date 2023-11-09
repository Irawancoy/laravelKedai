<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use App\Models\Admin\LayananModel;

class DetTransaksiRuanganModel extends Model
{
    use HasFactory,HasRelationships,SoftDeletes;

    protected $table = 't_det_transaksi_ruangan';
    protected $primaryKey = 'id_det_transaksi_ruangan';
    public $timestamps = true;

    protected $fillable = [
        'id_transaksi',
        'id_ruangan',
    ];

    public function detail_ruangan(){
        return $this->belongsTo(LayananModel::class, 'id_ruangan', 'id_ruangan');
    }

}
