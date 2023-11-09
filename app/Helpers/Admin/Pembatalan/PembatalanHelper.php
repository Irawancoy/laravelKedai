<?php 

namespace App\Helpers\Admin\Pembatalan;

use App\Models\Client\PembatalanModel;


class PembatalanHelper
{
     protected $pembatalanModel;

     public function __construct()
     {
         $this->pembatalanModel = new PembatalanModel();
     }

     public function getAll():object
     {
        return $this->pembatalanModel->getAll();
        
     }
     public function getById(int $id):object
     {
         return $this->pembatalanModel->getById($id);
         
     }

     public function updatePembatalan(array $payload,int $id):array
     {
        try{
          $this->pembatalanModel->updatePembatalan($payload,$id);
          $updatePembatalan = $this->pembatalanModel->getById($id);
          return [
               'status' => true,
               'data' => $updatePembatalan
           ];
       } catch (\Throwable $th) {
           return [
               'status' => false,
               'error' => $th->getMessage()
           ];
        }
     }
     public function delete(int $id): bool
     {
         try {
             $this->pembatalanModel->deletePembatalan($id);
             return true;
         } catch (\Throwable $th) {
             return false;
         }
     }
 
}