<?php

  class create_table_lokasi
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE lokasi ( kode_lokasi VARCHAR(1) NOT NULL, nama VARCHAR(4) NOT NULL, asal VARCHAR(15) NOT NULL, tujuan VARCHAR(15) NOT NULL, jarak DECIMAL(3,2) NOT NULL, harga INT NOT NULL, PRIMARY KEY (kode_lokasi));";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table Lokasi<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table Lokasi";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `lokasi`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table Lokasi<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table Lokasi<br>";
          }
      }

  }


?>
