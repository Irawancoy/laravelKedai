<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\RecordSignature;

class RekeningModel extends Model
{
    use HasFactory,RecordSignature,SoftDeletes;

    protected $table='t_rekening';

    protected $primaryKey='id';

    public $timestamp=true;

    protected $fillable=[
        'nama_pemilik',
        'nama_bank',
        'nomor_rekening'
    ];

    
    public function getAll(): object
    {
        return $this->query()->get();
    }
  
    public function getById(int $id): object
    {
        return $this->find($id);
    }


    public function store(array $payload)
    {
        // dd($payload);
        return $this->create($payload);
    }

    public function edit(array $payload, int $id)
    {
        return $this->find($id)->update($payload);
    }

    public function drop(int $id)
    {
        // dd($id);
        return $this->find($id)->delete();
    }
  
}
