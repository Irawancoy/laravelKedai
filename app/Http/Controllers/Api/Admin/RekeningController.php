<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Rekening\RekeningHelper;
use App\Http\Resources\Admin\Rekening\RekeningResource;
use App\Http\Resources\Admin\Rekening\DetailResource;
use App\Http\Resources\Admin\Rekening\RekeningCollection;
use App\Http\Requests\admin\Rekening\RekeningRequest;

class RekeningController extends Controller
{
    protected $rekening;

public function __construct()
{
    $this->rekening=new RekeningHelper();
    
}
public function index()
{
  
    $items = $this->rekening->getAll();
    return response()->success(new RekeningCollection($items));
}

public function store(RekeningRequest $request)
{
    
    
    /**
    * Menampilkan pesan error ketika validasi gagal
    * pengaturan validasi bisa dilihat pada class app/Http/request/User/CreateRequest
    */
    if (isset($request->validator) && $request->validator->fails()) {
        return response()->failed($request->validator->errors(), 422);
    }
    // dd($request);

    $dataInput = $request->only(['nama_pemilik','nama_bank','nomor_rekening']);
   
    $dataItem = $this->rekening->create($dataInput);
    // dd($dataItem);
    if (!$dataItem['status']) {
        return response()->failed($dataItem['error'], 422);
    }

    return response()->success($dataItem, 'Data item berhasil disimpan');

}
public function show($id)
{

    $dataItem = $this->rekening->getById($id);

    if (empty($dataItem)) {
        return response()->failed(['Data item tidak ditemukan']);
    }

    return response()->success(new DetailResource($dataItem));
}
public function update(RekeningRequest $request)
{
    /**
     * Menampilkan pesan error ketika validasi gagal
     * pengaturan validasi bisa dilihat pada class app/Http/request/User/UpdateRequest
     */
    if (isset($request->validator) && $request->validator->fails()) {
        return response()->failed($request->validator->errors());
    }

    $dataInput = $request->only(['nama_pemilik','nama_bank','nomor_rekening','id']);
    // dd($dataInput);
    $dataItem = $this->rekening->update($dataInput,$dataInput['id']);
    if (!$dataItem['status']) {
        return response()->failed($dataItem['error']);
    }

    return response()->success(new RekeningResource($dataItem['data']), 'Data item berhasil diperbarui');
}
public function destroy($id)
{
    $dataItem = $this->rekening->delete($id);

    if (!$dataItem) {
        return response()->failed(['Mohon maaf data item tidak ditemukan']);
    }
    // dd($dataItem);
    return response()->success(['Data Berhasil Dihapus']);
}

}
