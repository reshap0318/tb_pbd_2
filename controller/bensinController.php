<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/bensin.php';
  $bensin = new bensin($conn);

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
  $link = '/tb_pbd_sp/view/management/bensin';

  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }

  if($aksi=='create'){
    $bensin->store($_POST['kode_bensin'],$_POST['nama'],$_POST['harga']);
  }

  elseif($aksi=='update'){
    $bensin->update($_POST['last_kode_bensin'],$_POST['kode_bensin'],$_POST['nama'],$_POST['harga']);
  }

  elseif($aksi=='delete'){
    $bensin->delete($_POST['kode_bensin']);
  }
?>
