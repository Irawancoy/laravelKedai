<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\Pembatalan\PembatalanHelper;
use App\Http\Resources\client\Pembatalan\PembatalanCollection;
use App\Http\Resources\client\Pembatalan\PembatalanResource ;
use App\Http\Resources\client\Pembatalan\DetailResource;;

class PembatalanController extends Controller
{
   protected $pembatalanHelper;

   public function __construct()
   {
       $this->pembatalanHelper =new PembatalanHelper;
   }

    public function index()
    {
         $pembatalan = $this->pembatalanHelper->getAll();
         return new PembatalanCollection($pembatalan);
    }

    public function show($id)
    {
        $pembatalan = $this->pembatalanHelper->getById($id);
        return new PembatalanResource($pembatalan);
    }


    public function update(Request $request)
    {
        $pembatalan=$request->only(['id','status']);
        $pembatalan = $this->pembatalanHelper->updatePembatalan($pembatalan,$pembatalan['id']);
        if(!$pembatalan){
            return response()->failed($pembatalan['error']);
        }
        return response()->success(new PembatalanResource($pembatalan['data']),"Pembatalan berhasil diupdate");
      
    }

    public function destroy($id)
    {
        $pembatalan = $this->pembatalanHelper->delete($id);
        if(!$pembatalan){
            return response()->failed($pembatalan['error']);
        }
        return response()->success("Pembatalan berhasil dihapus");
    }

}
