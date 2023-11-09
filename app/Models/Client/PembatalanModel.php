<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembatalanModel extends Model
{
    use HasFactory,HasRelationships,SoftDeletes;

    protected $table = 't_pembatalan';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
'id_transaksi',
        'keterangan',
        'status',
    ];

    public function transaksi(){
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi', 'id_transaksi');
    }


    public function getById(int $pembatalanId):object
    {
        return $this->with('transaksi')->find($pembatalanId);
    }

    public function getAll():object
    {

        // dd($this->query()->with('transaksi')->get());
        return $this->query()->with('transaksi')->get();
    }

    public function deletePembatalan(int $pembatalanId)
    {
        $pembatalan = $this->find($pembatalanId);
        return $pembatalan->delete();
    }

    public function updatePembatalan( array $dataInput,int $pembatalanId)
    {
        $pembatalan = $this->find($pembatalanId);
        return $pembatalan->update($dataInput);
    }

    public function createPembatalan(array $dataInput)
    {
        return $this->create($dataInput);
    }
}
