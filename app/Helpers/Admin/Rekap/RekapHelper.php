<?php 
namespace App\Helpers\Admin\Rekap;

use App\Models\Admin\RekapModel;
use App\Http\Controllers\Api\Admin\TransaksiController;

class RekapHelper
{
    protected $rekapModel;
    protected $transaksiController;
    public function __construct()
    {
        $this->rekapModel = new RekapModel();
        $this->transaksiController = new TransaksiController();

    }

    public function getTransaksi(){
            $data=[
               'transaksi'=>$this->rekapModel->getAllTransaksi(),
            ];
            return $data;
    }         
    

    }
