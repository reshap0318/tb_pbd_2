<?php

  class create_table_kendaraan_satker
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE kendaraan_satker ( kode_satker CHAR(2) NOT NULL, kode_kendaraan VARCHAR(2) NOT NULL, PRIMARY KEY (kode_satker, kode_kendaraan)); ALTER TABLE kendaraan_satker ADD CONSTRAINT satker_kendaraan_satker_fk FOREIGN KEY (kode_satker) REFERENCES satker (kode_satker) ON DELETE cascade ON UPDATE cascade;";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table Lokasi Mobil<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table Lokasi Mobil";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `kendaraan_satker`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table Lokasi Mobil<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table Lokasi Mobil<br>";
          }
      }

  }


?>
