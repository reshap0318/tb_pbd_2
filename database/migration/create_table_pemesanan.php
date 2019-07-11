<?php

  class create_table_pemesanan
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE pemesanan ( kode_pemesanan CHAR(3) NOT NULL, tanggal DATETIME DEFAULT now() NOT NULL, kode_kendaraan VARCHAR(2) NOT NULL, kode_lokasi VARCHAR(1) NOT NULL, kode_waktu VARCHAR(1) NOT NULL, PRIMARY KEY (kode_pemesanan));ALTER TABLE pemesanan ADD CONSTRAINT lokasi_pemesanan_fk FOREIGN KEY (kode_lokasi) REFERENCES lokasi (kode_lokasi) ON DELETE cascade ON UPDATE cascade; ALTER TABLE pemesanan ADD CONSTRAINT waktu_pemesanan_fk FOREIGN KEY (kode_waktu) REFERENCES waktu (kode_waktu) ON DELETE cascade ON UPDATE cascade;";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table Pemesanan<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table Pemesanan";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `pemesanan`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table Pemesanan<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table Pemesanan<br>";
          }
      }

  }


?>
