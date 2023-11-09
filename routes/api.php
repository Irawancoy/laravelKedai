<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\LayananController;
use App\Http\Controllers\Api\Admin\MenuController;
use App\Http\Controllers\Api\Admin\KategoriMenuController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\RekapController;
use App\Http\Controllers\client\AuthCustomerController ;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\ProsedurController;
use App\Http\Controllers\Client\KeranjangController;
use App\Http\Controllers\Client\UserController as ClientUserController;
use App\Http\Controllers\Api\Admin\TentangKamiController;
use App\Http\Controllers\Client\TransaksiController;
use App\Http\Controllers\Api\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\Client\PembatalanController;
use App\Http\Controllers\Api\Admin\PembatalanController as AdminPembatalanController;
use App\Http\Controllers\Api\Admin\RekeningController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(function () {
    Route::prefix('admin/auth')->group(function () {

        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
     
    });
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::prefix('admin')->group(function () {


            Route::get('/home', [DashboardController::class, 'index']);
     
                Route::get('/layanan', [LayananController::class, 'index']);
                Route::post('/layanan', [LayananController::class, 'store']);
                Route::get('/layanan/{id}', [LayananController::class, 'show']);
                Route::put('/layanan/{id}', [LayananController::class, 'update']);
                Route::delete('/layanan/{id}', [LayananController::class, 'destroy']);

                Route::get('/menu', [MenuController::class, 'index']);
                Route::post('/menu', [MenuController::class, 'store']);
                Route::get('/menu/{id}', [MenuController::class, 'show']);
                Route::put('/menu/{id}', [MenuController::class, 'update']);
                Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

                Route::get('/user', [UserController::class, 'index']);
                Route::post('/user', [UserController::class, 'store']);
                Route::get('/user/{id}', [UserController::class, 'show']);
                Route::put('/user/{id}', [UserController::class, 'update']);
                Route::delete('/user/{id}', [UserController::class, 'destroy']);

                Route::get('/slider', [SliderController::class, 'index']);
                Route::post('/slider', [SliderController::class, 'store']);
                Route::get('/slider/{id}', [SliderController::class, 'show']);
                Route::put('/slider/{id}', [SliderController::class, 'update']);
                Route::delete('/slider/{id}', [SliderController::class, 'destroy']);

                Route::get('/prosedur', [ProsedurController::class, 'index']);
                Route::post('/prosedur', [ProsedurController::class, 'store']);
                Route::get('/prosedur/{id}', [ProsedurController::class, 'show']);
                Route::put('/prosedur/{id}', [ProsedurController::class, 'update']);
                Route::delete('/prosedur/{id}', [ProsedurController::class, 'destroy']);

                Route::get('/tentang-kami', [TentangKamiController::class, 'index']);
                Route::post('/tentang-kami', [TentangKamiController::class, 'store']);
                Route::get('/tentang-kami/{id}', [TentangKamiController::class, 'show']);
                Route::put('/tentang-kami/{id}', [TentangKamiController::class, 'update']);
                Route::delete('/tentang-kami/{id}', [TentangKamiController::class, 'destroy']);

                Route::get('/transaksi', [AdminTransaksiController::class, 'index']);
                Route::get('/transaksi/{id}', [AdminTransaksiController::class, 'show']);
                Route::put('/transaksi/{id}',[AdminTransaksiController::class, 'update']);
                Route::delete('/transaksi/{id}', [AdminTransaksiController::class, 'destroy']);

                Route::get('/pembatalan',[AdminPembatalanController::class, 'index']);
                Route::get('/pembatalan/{id}',[AdminPembatalanController::class, 'show']);
                Route::put('/pembatalan/{id}',[AdminPembatalanController::class,'update']);
                Route::delete('/pembatalan/{id}',[AdminPembatalanController::class,'destroy']);
                Route::get('/rekening', [RekeningController::class, 'index']);
                Route::post('/rekening', [RekeningController::class, 'store']);
                Route::get('/rekening/{id}', [RekeningController::class, 'show']);
                Route::put('/rekening/{id}', [RekeningController::class, 'update']);
                Route::delete('/rekening/{id}', [RekeningController::class, 'destroy']);



                
          Route::get('/rekap-transaksi', [RekapController::class, 'rekapTransaksi']);
          Route::get('/rekapAll', [RekapController::class, 'rekapAllTransaksi']);
                

        });

            
    
    });
    Route::prefix('client/auth')->group(function () {

        Route::post('/register', [AuthCustomerController::class, 'register']);
        Route::post('/login', [AuthCustomerController::class, 'login']);
        Route::post('/logout', [AuthCustomerController::class, 'logout']);
        Route::post('/refresh', [AuthCustomerController::class, 'refresh']);
        Route::get('/profile', [AuthCustomerController::class, 'profile'])->middleware('auth.api');

        
     
    });
  

    Route::group(['middleware' => ['auth.api']], function () {
        Route::prefix('client')->group(function () {
        Route::put('/user/{id}', [ClientUserController::class, 'update']);
        Route::get('/keranjang', [KeranjangController::class, 'index']);
        Route::get('/keranjang-customer/{id}', [KeranjangController::class, 'showByCustomer']);
        Route::get('/keranjang/{id}', [KeranjangController::class, 'show']);
        Route::post('/keranjang', [KeranjangController::class, 'store']);
        Route::put('/keranjang/{id}', [KeranjangController::class, 'update']);
        Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy']);


// Route::post('/transaksi/{id}', [TransaksiController::class, 'createFromKeranjang']);

        Route::get('/transaksi', [TransaksiController::class, 'index']);
        Route::get('/transaksi-customer/{id}', [TransaksiController::class, 'showByCustomer']);
        Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);
        Route::post('/transaksi', [TransaksiController::class, 'store']);
        Route::get('/rekening', [RekeningController::class, 'index']);


        Route::get('/pembatalan', [PembatalanController::class, 'index']);
        Route::post('/pembatalan', [PembatalanController::class, 'store']);
        Route::delete('/pembatalan/{id}', [PembatalanController::class, 'destroy']);

});

});

Route::prefix('client')->group(function () {
Route::get ('/slider', [SliderController::class, 'index']);
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);
Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/layanan/{id}', [LayananController::class, 'show']);
Route::get('/prosedur', [ProsedurController::class, 'index']);
Route::get('/tentang-kami', [TentangKamiController::class, 'index']);
});


});

