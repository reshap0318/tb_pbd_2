<?php

  class create_table_satker
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE satker (kode_satker CHAR(2) NOT NULL, nama VARCHAR(14) NOT NULL, PRIMARY KEY (kode_satker));";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table Satuan Kerja<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table Satuan Kerja";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `satker`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table Satuan Kerja<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table Satuan Kerja<br>";
          }
      }

  }


?>
