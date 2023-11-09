<?php  
namespace App\Helpers\Admin\Transaksi;

use App\Models\Client\TransaksiModel;


class TransaksiHelper
{
     protected $transaksiModel;

     public function __construct()
     {
         $this->transaksiModel = new TransaksiModel();
     }

     public function getAll():object
     {
          return $this->transaksiModel->getAll();
     }

     public function getTransaksiById($id):object
     {
          return $this->transaksiModel->getById($id);
     }

     public function updateTransaksi(array $payload ,int $id):array
     {
          try{
               $this->transaksiModel->edit($payload, $id);

               $dataTransaksi=$this->getTransaksiById($id);

               return [
                    'status' => true,
                    'data' => $dataTransaksi
               ];
          }catch(\Throwable $th){
               return [
                    'status' => false,
                    'error' => $th->getMessage().' '.$th->getLine().' '.$th->getFile()
               ];

          }

     }

     public function deleteTransaksi($keranjangId )
     {
          try{
               $this->transaksiModel->deleteTransaksi($keranjangId);
               return true;
          }catch(\Throwable $th){
               return false;
          }
     }
}

