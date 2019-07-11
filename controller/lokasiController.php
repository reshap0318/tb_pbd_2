<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/lokasi.php';
  $lokasi = new lokasi($conn);

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
  $link = '/tb_pbd_sp/view/management/lokasi';

  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }

  if($aksi=='create'){
    $lokasi->store($_POST['kode_lokasi'],$_POST['nama'],$_POST['asal'],$_POST['tujuan'], $_POST['jarak'],$_POST['harga']);
  }

  elseif($aksi=='update'){
    $lokasi->update($_POST['last_kode_lokasi'],$_POST['kode_lokasi'],$_POST['nama'],$_POST['asal'],$_POST['tujuan'], $_POST['jarak'],$_POST['harga']);
  }

  elseif($aksi=='delete'){
    $lokasi->delete($_POST['kode_lokasi']);
  }
?>
