<?php
namespace App\Models\Admin;
 use Illuminate\Database\Eloquent\Model;
     use Illuminate\Support\Facades\DB;

class DashboardModel extends Model
{
     public function getDay(){
          $query ="select CURDATE() as tanggal,
          SUM(CASE WHEN tanggal_sewa=CURDATE()THEN t_transaksi.total ELSE 0 END) as total
          FROM t_transaksi
          WHERE status_pelunasan='1' AND deleted_at is null";

          return DB::select($query);
          
     }

     public function getKemarin(){
          $query="select DATE_SUB(CURDATE(), INTERVAL 1 DAY) as tanggal,
          SUM(CASE WHEN tanggal_sewa=DATE_SUB(CURDATE(), INTERVAL 1 DAY) THEN t_transaksi.total ELSE 0 END) as total
          FROM t_transaksi
          WHERE status_pelunasan='1' AND deleted_at is null";
          return DB::select($query);
     }
public function getBulan($bulan,$tahun)
{
     $tahun=date('Y');
     
     // dd($queryTahun);
     $query="select MONTHNAME('2023-".$bulan."-01') as nama_bulan,
SUM(CASE WHEN MONTH(tanggal_sewa)=".$bulan." AND YEAR(tanggal_sewa)=".$tahun." THEN t_transaksi.total ELSE 0 END) as total
     FROM t_transaksi 
     WHERE status_pelunasan='1' AND deleted_at is null";
    
     return DB::selectOne($query);
  
}
public function getTahunIni()
{
$query="select YEAR(CURDATE()) as tahun,
SUM(CASE WHEN YEAR(tanggal_sewa)=YEAR(CURDATE()) THEN t_transaksi.total ELSE 0 END) as total
FROM t_transaksi
WHERE status_pelunasan='1' AND deleted_at is null";

     return DB::select($query);
}
public function getTahunKemarin(){
     $query="select YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) as tahun,
     SUM(CASE WHEN YEAR(tanggal_sewa)=YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) THEN t_transaksi.total ELSE 0 END) as total
     FROM t_transaksi
     WHERE status_pelunasan='1' AND deleted_at is null";
     return DB::select($query);
}

public function cash(){
     $query="select COALESCE(COUNT(*), 0) AS jumlah
             FROM t_transaksi
             WHERE jenis_transaksi = 'Cash' AND status_pelunasan='1' AND deleted_at is null";
          
     return DB::select($query);
   }
   
   public function dp(){
     $query="select COALESCE(COUNT(*), 0) AS jumlah
             FROM t_transaksi
             WHERE jenis_transaksi = 'Dp' AND status_pelunasan='1' AND deleted_at is null";
     return DB::select($query);
   }
   
}

