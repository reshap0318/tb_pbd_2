<?php

  class create_table_pemesanan_detail
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE pemesanan_detail (kode_pemesanan CHAR(3) NOT NULL, kode_kursi VARCHAR(3) NOT NULL, PRIMARY KEY (kode_pemesanan, kode_kursi));";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table Detail Pemesanan<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table Detail Pemesanan";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `pemesanan_detail`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table Detail Pemesanan<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table Detail Pemesanan<br>";
          }
      }

  }


?>
