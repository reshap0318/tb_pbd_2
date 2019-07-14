<?php

class helper{

    function kondisi($status)
    {
        if($status == 1){
          return "Baik";
        }elseif($status == 2){
          return "Rusak Sedikit";
        }elseif($status == 3){
          return "Rusak Berat";
        }else{
          return "Error Data salah masuk";
        }
    }

    function hari($day)
    {
        $hari = 'Tidak Terdifinisikan';
        if($day == 1){
          $hari = 'Senin';
        }elseif($day == 2){
          $hari = 'Selasa';
        }elseif($day == 3){
          $hari = 'Rabu';
        }elseif($day == 4){
          $hari = 'Kamis';
        }elseif($day == 5){
          $hari = 'Jumat';
        }elseif($day == 6){
          $hari = 'Sabtu';
        }elseif($day == 7){
          $hari = 'Minggu';
        }
        return $hari;
    }

    function rp($uang)
    {
      return "Rp. ".number_format( $uang,2,",",".");
    }
}
?>
