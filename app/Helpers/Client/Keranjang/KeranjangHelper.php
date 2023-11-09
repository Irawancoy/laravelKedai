<?php 

namespace App\Helpers\Client\Keranjang;

use App\Models\Client\KeranjangModel;
use App\Repository\CrudInterface;


class KeranjangHelper 
{
    protected $keranjangModel;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
    }

    public function getAll(): object
    {
        return $this->keranjangModel->getAll();
    }


    public function getById(int $id): object
    {
        return $this->keranjangModel->getById(($id));
    }

    public function create(array $payload): array
    {
      try{
      
        $datailMenu=$payload['detail_menu']??[];
    
        unset($payload['detail_menu']);
        // dd($payload['detail_menu']);

        $createItem = $this->keranjangModel->store($payload);

        if(!empty($datailMenu)){
           
         $detail=new DetKeranjangMenu($createItem);
       
            $detail->create($datailMenu);
          
        }

        return [
            'status' => true,
            'data' => $createItem
        ];
        }catch(\Throwable $th){
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }

      }

      public function update(array $payload, int $id): array
     {
        try{
            $detailMenu=$payload['detail_menu']??[];
            unset($payload['detail_menu']);

            $this->keranjangModel->edit($payload, $id);
            $dataDetail = $this->getById($id);
            if(!empty($detailMenu)){
                $detail=new DetKeranjangMenu($dataDetail);
                $detail->update($detailMenu);
            }

            return [
                'status' => true,
                'data' => $this->$dataDetail
            ];
        }catch(\Throwable $th){
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }

     }

    public function delete(int $id): array
    {
        try {
            $this->keranjangModel->drop($id);
            return [
                'status' => true,
                'data' => 'Berhasil menghapus data'
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }
}
    