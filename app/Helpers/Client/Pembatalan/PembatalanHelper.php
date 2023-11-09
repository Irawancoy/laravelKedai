<?php  

namespace App\Helpers\Client\Pembatalan;

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

     public function getById(int $pembatalanId):object
     {
     return $this->pembatalanModel->getById($pembatalanId);
     }


     public function createPembatalan(array $dataInput)
     {
          try{
               $pembatalan = $this->pembatalanModel->createPembatalan($dataInput);
               return $pembatalan;
          }catch(\Throwable $th){
               return $th;
          }
        
     }

     public function deletePembatalan(int $pembatalanId)
     {
        try{
               $pembatalan = $this->pembatalanModel->deletePembatalan($pembatalanId);
               return $pembatalan;
          }catch(\Throwable $th){
               return $th;
          }    
        }
     }
