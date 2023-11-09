<?php

namespace App\Helpers\Admin\Rekening;

use App\Models\Admin\RekeningModel;
use App\Repository\CrudInterface;

class RekeningHelper
{
    protected $rekeningModel;

    public function __construct()
    {
        $this->rekeningModel = new RekeningModel();
    }


    public function getAll(): object
    {
        return $this->rekeningModel->getAll();
    }

   
    public function getById(int $id): object
    {
        return $this->rekeningModel->getById(($id));
    }

    public function create(array $payload): array
    {
        // dd($payload);
        
        $createItem = $this->rekeningModel->store($payload);
        return [
            'status' => true,
            'data' => $createItem
        ];
       
       
    }

    public function update(array $payload, int $id): array
    {
      
            $this->rekeningModel->edit($payload, $id);

                // $dataItem = $this->getById($updateItem);
                $dataItem = $this->getById($id);
    
    
                return [
                    'status' => true,
                    'data' => $dataItem
                ];
        

    }

    public function delete(int $id): bool
    {
        try {
            $this->rekeningModel->drop($id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}

