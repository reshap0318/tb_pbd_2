<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/waktu.php';
  $waktu = new waktu($conn);

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
  $link = '/tb_pbd_sp/view/management/waktu';

  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }

  if($aksi=='create'){
    $waktu->store($_POST['kode_waktu'],$_POST['waktu_mulai'],$_POST['waktu_sampai'],$_POST['hari']);
  }

  elseif($aksi=='update'){
    $waktu->update($_POST['last_kode_waktu'],$_POST['kode_waktu'],$_POST['waktu_mulai'],$_POST['waktu_sampai'],$_POST['hari']);
  }

  elseif($aksi=='delete'){
    $waktu->delete($_POST['kode_waktu']);
  }
?>
