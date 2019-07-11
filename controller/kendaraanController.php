<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan.php';
  $kendaraan = new kendaraan($conn);

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
  $link = '/tb_pbd_sp/view/management/kendaraan';

  //validasi dan inisiasi
  if(isset($_GET['aksi'])){
    $aksi = $_GET['aksi'];
  }
  if($aksi=='create'){
    $kendaraan->store($_POST['kode_kendaraan'], $_POST['plat_no'], $_POST['no_mesin'], $_POST['no_rangka'], $_POST['minyak_full'],$_POST['m_1l'],$_POST['kondisi'],$_POST['kode_merek'],$_POST['kode_bensin'],$_POST['nik']);
  }

  elseif($aksi=='update'){
    $kendaraan->update($_POST['last_kode_kendaraan'],$_POST['kode_kendaraan'], $_POST['plat_no'], $_POST['no_mesin'], $_POST['no_rangka'], $_POST['minyak_full'],$_POST['m_1l'],$_POST['kondisi'],$_POST['kode_merek'],$_POST['kode_bensin'],$_POST['nik']);
  }

  elseif($aksi=='delete'){
    $kendaraan->delete($_POST['kode_kendaraan']);
  }
?>
