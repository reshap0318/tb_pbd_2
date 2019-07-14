<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/jadwal_keberangkatan.php';
  $jadwal_keberangkatan = new jadwal_keberangkatan($conn);

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
    $jadwal_keberangkatan->store($_POST['kode_pemesanan'],$_POST['tanggal'],$_POST['kode_kendaraan'], $_POST['kode_lokasi'],$_POST['kode_waktu'],$_POST['kode_satker']);
  }

  elseif($aksi=='update'){
    $jadwal_keberangkatan->update($_POST['last_kode_pemesanan'],$_POST['kode_pemesanan'],$_POST['tanggal'],$_POST['kode_kendaraan'], $_POST['kode_lokasi'],$_POST['kode_waktu'],$_POST['kode_satker']);
  }

  elseif($aksi=='delete'){
    $jadwal_keberangkatan->delete($_POST['kode_pemesanan']);
  }
?>
