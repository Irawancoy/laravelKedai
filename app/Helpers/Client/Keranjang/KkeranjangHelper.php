<?php 

namespace App\Helpers\Client\Keranjang;

use App\Models\Client\KeranjangModel;
use App\Models\Client\DetKeranjangRuanganModel;
use App\Models\Client\DetKeranjangMenuModel;

class KkeranjangHelper 
{
     protected $keranjangModel;

     public function __construct()
     {
         $this->keranjangModel = new KeranjangModel();
     }

 
     public function createKeranjang(array $payload): array
     {
    //    return $payload;
         try {
            
     // dd($payload);
             $keranjang = $this->keranjangModel->store($payload);
     
             $this->createDetailKeranjangMenu($keranjang, $payload['detail_menu']);
             $this->createDetailKeranjangRuangan($keranjang, $payload['detail_ruangan']);
          //    dd($keranjang);
     
             return [
                 'status' => true,
                 'data' => $keranjang
             ];
         } catch (\Throwable $th) {
             return [
                 'status' => false,
                 'error' => $th->getMessage().' '.$th->getLine().' '.$th->getFile()
             ];
         }
     }
     
     private function createDetailKeranjangMenu($keranjang, $menu)
     {
         foreach ($menu as $menuItem) {
             $detKeranjangMenu = new DetKeranjangMenuModel([
           
                 'id_menu' => $menuItem['id_menu'],
                 'jumlah' => $menuItem['jumlah'],
             ]);
             $keranjang->detailMenu()->save($detKeranjangMenu);
         }
     }
     
   private function createDetailKeranjangRuangan($keranjang, $ruangan)
{
    // dd($ruangan);
    foreach ($ruangan as $ruanganItem) {
        $detKeranjangRuangan = new DetKeranjangRuanganModel([
            'id_ruangan' => $ruanganItem['id_ruangan'],
        ]);
        $keranjang->detailRuangan()->save($detKeranjangRuangan);
    }

}

public function updateKeranjang($keranjangId, array $payload): array
{
     try {
          $keranjang = $this->keranjangModel->find($keranjangId);
     
          if (!$keranjang) {
               return [
                    'status' => false,
                    'error' => 'Keranjang tidak ditemukan'
               ];
          }
     
          $keranjang->update([
               'harga_ruang' => $payload['harga_ruang'],
               'tamu' => $payload['tamu'],
               'total' => $payload['total'],
               'id_customer' => $payload['id_customer'],
          ]);
     
          $this->updateDetailKeranjangMenu($keranjang, $payload['menu']);
          $this->updateDetailKeranjangRuangan($keranjang, $payload['ruangan']);
     
          return [
               'status' => true,
               'data' => $keranjang
          ];
     } catch (\Throwable $th) {
          return [
               'status' => false,
               'error' => $th->getMessage()
          ];
     }
}

private function updateDetailKeranjangMenu($keranjang, $menu){
     $keranjang->detailMenu()->delete();
     $this->createDetailKeranjangMenu($keranjang, $menu);
     
}

private function updateDetailKeranjangRuangan($keranjang, $ruangan){
     $keranjang->detailRuangan()->delete();
     $this->createDetailKeranjangRuangan($keranjang, $ruangan);
}

 
     public function getKeranjangById($keranjangId):object
     {
          return $this->keranjangModel->getById($keranjangId);
     }

     public function getAllKeranjang():object
     {

         return $this->keranjangModel->getAll();
     }

 public function getKeranjangByCustomer($customerId):object
 {
        return $this->keranjangModel->getByCustomer($customerId);
     
 }
 
     public function deleteKeranjang($keranjangId)
     {
        // dd($keranjangId);
     try{
        $this->keranjangModel->deleteKeranjang($keranjangId);
        return true;
     }catch(\Throwable $th){
        return false;
     }
     }



     
 }
 
 
