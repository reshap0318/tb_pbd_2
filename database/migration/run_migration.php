<?php

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_user.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_satker.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_bensin.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_kendaraan_kursi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_kendaraan_satker.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_kendaraan.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_lokasi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_merek_kendaraan.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_pemesanan_detail.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_pemesanan.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/database/migration/create_table_waktu.php';

  // $satker = new create_table_satker($conn);
  // $lokasi = new create_table_lokasi($conn);
  // $waktu = new create_table_waktu($conn);
  // $user = new create_table_user($conn);
  // $merek = new create_table_merek_kendaraan($conn);
  // $bensin = new create_table_bensin($conn);
  // $kendaraan = new create_table_kendaraan($conn);
  // $pemesanan = new create_table_pemesanan($conn);
  // $kendaraan_satker = new create_table_kendaraan_satker($conn);
  // $kendaraan_kursi = new create_table_kendaraan_kursi($conn);
  // $pemesanan_detail = new create_table_pemesanan_detail($conn);
?>
