<?php

namespace App\Helpers\Client\Keranjang;

use App\Models\Client\KeranjangModel;
use App\Models\Client\DetKeranjangMenuModel;

class DetKeranjangMenu 
{
     private $model;
     private $parent;

     public function __construct(KeranjangModel  $item)
     {
          $this->parent=$item;
          $this->model=new DetKeranjangMenuModel();
     }


     public function prepare(array $detail): array
     {

          $data=[];
          // dd($detail);
          foreach ($detail as $key => $value) {
               $data[$key]['id']=$value['id']>0 ?$value['id']:null;
               $data[$key]['id_keranjang']=$this->parent->id;
               $data[$key]['id_menu']=$value['id_menu'];
               $data[$key]['jumlah_menu']=$value['jumlah_menu'];
               $data[$key]['total_harga']=$value['total_harga'];
          }
          // dd($data);
          return $data;
     }

     public function getAll(): object
     {
          return $this->model->getAll($this->parent->id);
     }

     public function groupById(): array
     {
          $detail=$this->getAll();
          $data=[];
          foreach($detail as $val){
               $data[$val->id]=[
                    'id'=>$val['id'],
                    'id_keranjang'=>$val['id_keranjang'],
                    'id_menu'=>$val['id_menu'],
                    'jumlah_menu'=>$val['jumlah_menu'],
                    'total_harga'=>$val['total_harga'],
               ];
               dd($data);
               
          }
          return $data;
     }

     public function create(array $payload): bool
     {
          // dd($payload[0]['id_keranjang']);
        
         if(isset($payload[0]['id_keranjang']))
         {
          // dd($payload);
          $newDetail = $this->prepare($payload);
          // dd($newDetail);
          $this->model->store((array)$newDetail);
          return true;
         }
           return false;
     }

     public function update(array $payload): bool
     {
          $newDetail = $this->prepare($payload);
          $this->model->update((array)$newDetail);
          return true;
     }

     public function delete(array $payload): bool
     {
          $this->model->delete($payload);
          return true;
     }


}


