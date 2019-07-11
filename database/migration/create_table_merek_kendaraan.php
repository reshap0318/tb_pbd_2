<?php

  class create_table_merek_kendaraan
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE merek_kendaraan ( kode_merek VARCHAR(1) NOT NULL, nama VARCHAR(8) NOT NULL, PRIMARY KEY (kode_merek));";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table Merek Kendaraan<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table Merek Kendaraan";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `merek_kendaraan`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table Merek Kendaraan<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table Merek Kendaraan<br>";
          }
      }

  }


?>
