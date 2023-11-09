<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\MenuModel;

class DetTransaksiMenuModel extends Model
{
    use HasFactory,HasRelationships,SoftDeletes;

    protected $table = 't_det_transaksi_menu';
    protected $primaryKey = 'id_det_transaksi_menu';
    public $timestamps = true;

    protected $fillable = [
        'id_transaksi',
        'id_menu',
        'jumlah'
    ];
    public function detail_menu()
    {
        return $this->belongsTo(MenuModel::class, 'id_menu', 'id_menu');
    }


}
