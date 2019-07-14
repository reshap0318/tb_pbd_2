<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan_kursi.php';
  $kursi = new kendaraan_kursi($conn);

  if($_SESSION['status'] == 1){
    if($_SESSION['hak_akses'] == 3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }else{
    array_push($_SESSION['pesan'],['eror','Anda Belum Login, Silakan Login Terlebih Dahulu']);
    header("location:/tb_pbd_sp/view/auth/login.php");
  }

  $aksi = null;
  $link = '/tb_pbd_sp/view/management/kendaraan-kursi';

  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }

  if($aksi=='create'){
    $kursi->store($_POST['kode_kursi'],$_POST['nama'],$_POST['kode_kendaraan']);
  }

  elseif($aksi=='update'){
    $kursi->update($_POST['last_kode_kursi'],$_POST['kode_kursi'],$_POST['nama'],$_POST['kode_kendaraan']);
  }

  elseif($aksi=='delete'){
    $kursi->delete($_POST['kode_kursi']);
  }
?>
