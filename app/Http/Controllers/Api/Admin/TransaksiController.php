<?php 

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Admin\Transaksi\TransaksiHelper;
use App\Http\Resources\client\Transaksi\TransaksiResource;
use App\Http\Resources\client\Transaksi\TransaksiCollection;
use App\Http\Requests\Admin\Transaksi\UpdateRequest;

class TransaksiController extends Controller
{
     private $transaksiHelper;

     public function __construct()
     {
          $this->transaksiHelper = new TransaksiHelper();
     }

     public function index()
     {
      $result=$this->transaksiHelper->getAll();

     return response()->success(new TransaksiCollection($result));
     }


     public function show($transaksiId){
          $dataTransaksi = $this->transaksiHelper->getTransaksiById($transaksiId);
          if(!$dataTransaksi){
              return response()->failed(['Data Transaksi tidak ditemukan']);
          }
          return response()->success(new TransaksiResource($dataTransaksi));
      }
  
  
     public function update(UpdateRequest $request)
     {
     
         $dataInput = $request->only(['status','status_pelunasan','id_transaksi']);
     //     dd($dataInput);
         $dataItem = $this->transaksiHelper->updateTransaksi($dataInput,$dataInput['id_transaksi']);
         if (!$dataItem['status']) {
             return response()->failed($dataItem['error']);
         }
 
         return response()->success(new TransaksiResource($dataItem['data']), 'Data item berhasil diperbarui');
     }

     public function destroy($transaksiId)
     {
          $result = $this->transaksiHelper->deleteTransaksi($transaksiId);
          
          if(!$result){
              return response()->failed(['Data Transaksi tidak ditemukan']);
          }
          return response()->success(null, 'Data Transaksi berhasil dihapus');
     }

}