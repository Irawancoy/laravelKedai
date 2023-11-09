<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Rekap\RekapHelper;
use App\Helpers\Admin\Transaksi\TransaksiHelper;
use App\Http\Resources\client\Transaksi\TransaksiCollection;

class RekapController extends Controller
{
    protected $rekapHelper;
protected $transaksiHelper;

    public function __construct()
    {
        $this->rekapHelper = new RekapHelper();
        $this->transaksiHelper = new TransaksiHelper();
    }

  public function rekapTransaksi(){
        $data=$this->rekapHelper->getTransaksi();
        return response()->json($data);
  }

  public function  rekapAllTransaksi(){
    $data=$this->transaksiHelper->getAll();
    return response()->success(new TransaksiCollection($data));
  }


    
}
