<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Client\Pembatalan\PembatalanHelper;
use App\Http\Requests\Client\Pembatalan\PembatalanRequest;
use App\Http\Resources\client\Pembatalan\PembatalanCollection;
use App\Http\Resources\client\Pembatalan\PembatalanResource ;

class PembatalanController extends Controller
{
    protected $pembatalanHelper;

    public function __construct()
    {
        $this->pembatalanHelper = new PembatalanHelper();
    }

    public function index()
    {
        $dataItem = $this->pembatalanHelper->getAll();
        // dd($dataItem);
        return response()->success(new PembatalanCollection($dataItem));
    }
  public function store(PembatalanRequest $request)
  {
    if (isset($request->validator) && $request->validator->fails()) {
        return response()->failed($request->validator->errors(), 422);
    }
    $dataInput = $request->only([
        'id_transaksi',
        'keterangan',
        'status',
    ]);
    $dataItem = $this->pembatalanHelper->createPembatalan($dataInput);

    if (!$dataItem) {
        return response()->failed($dataItem['error']);
    }

    return response()->success($dataItem, 'Data Pembatalan berhasil disimpan');
  }

  public function destroy($id)
  {
    $dataItem = $this->pembatalanHelper->deletePembatalan($id);
    if (!$dataItem) {
        return response()->failed(['Mohon maaf data Pembatalan tidak ditemukan']);
    }
    // dd($dataItem);
    return response()->success(['Data Berhasil Dihapus']);
}
}
