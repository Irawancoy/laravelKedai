<?php

namespace App\Http\Controllers\Client;

use App\Helpers\Client\Keranjang\KkeranjangHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\client\Keranjang\KeranjangResource;
use App\Http\Resources\client\Keranjang\DetailResource;
use App\Http\Resources\client\Keranjang\KeranjangCollection;
use App\Http\Requests\Client\Keranjang\KeranjangRequest;


class KeranjangController extends Controller
{
    private $keranjangHelper;

    public function __construct(KkeranjangHelper $keranjangHelper)
    {
        $this->keranjangHelper = $keranjangHelper;
    }

    public function index()
    {
        $results = $this->keranjangHelper->getAllKeranjang();

        if(empty($results)){
            return response()->failed(['Data Keranjang tidak ditemukan']);
        }
        return response()->success(new KeranjangCollection($results));
    }
    

    public function showByCustomer($customerId){
        $result = $this->keranjangHelper->getKeranjangByCustomer($customerId);
        // dd($result);
        return response()->success(new KeranjangCollection($result));
    }

    public function store(KeranjangRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }
       $dataInput = $request->only([
        'id_customer',
        'harga_ruang',
        'tanggal_sewa',
        'jam_mulai',
        'jam_selesai',
        'tamu',
        'total',
        'detail_menu',
        'detail_ruangan'
    ]);
    // dd($dataInput);
        $result = $this->keranjangHelper->createKeranjang($dataInput); 

    if(!$result['status']){
        return response()->failed($result['error'], 422);
    }
        return response()->success($result, 'Keranjang berhasil ditambahkan');
    }
    

    public function update(Request $request, $keranjangId)
    {
        $payload = $request->all();

        $result = $this->keranjangHelper->updateKeranjang($keranjangId, $payload);

      if(!$result['status']){
        return response()->failed($result['error']);
      }
        return response()->success(new KeranjangResource($result),'Keranjang berhasil diupdate'
        );
    }

    public function show($keranjangId)
    {
      $dataKeranjang = $this->keranjangHelper->getKeranjangById($keranjangId);

      if(empty($dataKeranjang)){
        return response()->failed(['Data Keranjang tidak ditemukan']);
      }
// dd($dataKeranjang);
      return response()->success(new DetailResource($dataKeranjang));
       
    }


    public function destroy($keranjangId)
    {
        $result = $this->keranjangHelper->deleteKeranjang($keranjangId);
// dd($result);
        if (!$result) {
            return response()->failed(['Keranjang tidak ditemukan']);
        }
        return response()->success( 'Keranjang berhasil dihapus');
    }
}
