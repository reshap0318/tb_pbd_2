<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/detail_keberangkatan.php';
  $detail = new detail_keberangkatan($conn);

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
  $link = '/tb_pbd_sp/view/detail-keberangkatan';

  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }

  if($aksi=='create'){
    $detail->store($_POST['kode_pemesanan'],$_POST['kode_kursi'],$_POST['nama'],$_POST['no_telp'],$_POST['jemput'],$_POST['antar'], $_POST['biaya_tambahan']);
  }

  elseif($aksi=='update'){
    $detail->update($_POST['last_kode_pemesanan'],$_POST['last_kode_kursi'],$_POST['kode_pemesanan'],$_POST['kode_kursi'],$_POST['nama'],$_POST['no_telp'],$_POST['jemput'],$_POST['antar'], $_POST['biaya_tambahan']);
  }

  elseif($aksi=='delete'){
    $detail->delete($_POST['kode_pemesanan'],$_POST['kode_kursi']);
  }
?>
