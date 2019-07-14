<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan_satker.php';
  $parkir = new kendaraan_satker($conn);

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
  $link = '/tb_pbd_sp/view/jadwal-keberangkatan';

  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }

  if($aksi=='create'){
    $parkir->store($_POST['kode_parkir'],$_POST['kode_kendaraan'],$_POST['kode_satker'], $_POST['datang'], $_POST['keluar']);
  }

  elseif($aksi=='update'){
    $parkir->update($_POST['last_kode_parkir'],$_POST['kode_parkir'],$_POST['kode_kendaraan'],$_POST['kode_satker'], $_POST['datang'], $_POST['keluar']);
  }

  elseif($aksi=='delete'){
    $parkir->delete($_POST['kode_parkir']);
  }

  elseif($aksi=='keluar'){
    $parkir->keluar($_GET['kode_parkir']);
  }
?>
