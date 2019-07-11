<?php

  class create_table_kendaraan_kursi
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE kendaraan_kursi ( kode_kursi VARCHAR(3) NOT NULL, nama VARCHAR(5) NOT NULL, kode_kendaraan VARCHAR(2) NOT NULL, PRIMARY KEY (kode_kursi));";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table Kursi Mobil<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table Kursi Mobil";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `kendaraan_kursi`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table Kursi Mobil<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table Kursi Mobil<br>";
          }
      }

  }


?>
