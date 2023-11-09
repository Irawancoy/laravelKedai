<?php  
namespace App\Helpers\Client\Transaksi;

use App\Models\Client\TransaksiModel;
use App\Models\Client\DetTransaksiRuanganModel;
use App\Models\Client\DetTransaksiMenuModel;

class TransaksiHelper
{

    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
    }

 public function createTransaksi(array $payload):array
 {
        try {
            // dd($payload['foto_ktp']);
            // var_dump($payload['foto_ktp']);
            if(!empty($payload['foto_ktp'])) {
                // $payload['foto_ktp'] = $payload['foto_ktp']->store('/upload/fotoMenu');
                $payload['foto_ktp']->store('/public/upload/fotoKTP');
                $fotodb = $payload['foto_ktp']->store('/upload/fotoKTP');
                $payload['foto_ktp'] = $fotodb;
    
            }
         
            $transaksi = $this->transaksiModel->store($payload);
    //   pebuatan nomor struk

            $transaksi->no_struk = 'OP-'.date('Ymd').'-'.$transaksi->id_transaksi;
            $transaksi->save();
    
            $this->createDetailTransaksiMenu($transaksi, $payload['detail_menu']);
            $this->createDetailTransaksiRuangan($transaksi, $payload['detail_ruangan']);
    
            return [
                'status' => true,
                'data' => $transaksi
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage().' '.$th->getLine().' '.$th->getFile()
            ];
        }
 }
 public function createDetailTransaksiMenu($transaksi, $menu)
 {
     foreach ($menu as $menuItem) {
         $detTransaksiMenu = new DetTransaksiMenuModel([
             'id_menu' => $menuItem['id_menu'],
             'jumlah' => $menuItem['jumlah'],
         ]);
         $transaksi->detailMenu()->save($detTransaksiMenu);
     }
 }

    private function createDetailTransaksiRuangan($transaksi, $ruangan)
    {
// var_dump($ruangan);
foreach ($ruangan as $ruanganItem) {
    // var_dump($ruanganItem);
        $detTransaksiRuangan = new DetTransaksiRuanganModel([
            'id_ruangan' => $ruanganItem['id_ruangan'],
        ]);
        $transaksi->detailRuangan()->save($detTransaksiRuangan);
    }
}

public function getTransaksiByCustomer($customerId):object
{
    return $this->transaksiModel->getByCustomer($customerId);
}

public function getTransaksiById($id):object
{
    return $this->transaksiModel->getById($id);
}

    public function getAll():object
    {
        return $this->transaksiModel->getAll();
    }

   

    


    


   
}