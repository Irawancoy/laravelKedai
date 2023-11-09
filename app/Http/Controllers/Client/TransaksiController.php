<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Client\Transaksi\TransaksiHelper;
use App\Http\Resources\client\Transaksi\DetailResource;
use App\Http\Resources\client\Transaksi\TransaksiResource;
use App\Http\Resources\client\Transaksi\TransaksiCollection;
use App\Http\Requests\client\Transaksi\TransaksiRequest;
use App\Http\Requests\Client\Transaksi\UpdateRequest;

class TransaksiController extends Controller
{
    private $transaksiHelper;

    public function __construct(TransaksiHelper $transaksiHelper)
    {
        $this->transaksiHelper = $transaksiHelper;
    }

    public function index()
    {
     $result=$this->transaksiHelper->getAll();
    //  dd($result);
    //  if(empty($results)){
    //     return response()->failed(['Data Keranjang tidak ditemukan']);
    // }
    return response()->success(new TransaksiCollection($result));
    }
    
    public function showByCustomer($customerId)
    {
        
        $result = $this->transaksiHelper->getTransaksiByCustomer($customerId);
        if(empty($result)){
            return response()->failed(['Data Keranjang tidak ditemukan']);
        }
        return response()->success(new TransaksiCollection($result));
    }

    public function show($transaksiId){
        $dataTransaksi = $this->transaksiHelper->getTransaksiById($transaksiId);
        if(!$dataTransaksi){
            return response()->failed(['Data Transaksi tidak ditemukan']);
        }
        return response()->success(new TransaksiResource($dataTransaksi));
    }



    public function store(TransaksiRequest $request)
    {

        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }
        $payload = $request->only([
            'no_struk',
            'id_customer',
            'harga_ruang',
            'tamu',
            'total',
            'kurang_bayar',
            'bayar',
            'tanggal_sewa',
            'jam_mulai',
            'jam_selesai',
            'jenis_transaksi',
            'no_hp',
            'catatan',
            'foto_ktp',
            'status',
            'detail_menu',
            'detail_ruangan',
            'status_pelunasan',
        
        ]);
        $result = $this->transaksiHelper->createTransaksi($payload);
        if(!$result['status']){
            return response()->failed($result['error']);
        }
        return response()->success($result,'Transaksi berhasil ditambahkan');
    }   

    
}
