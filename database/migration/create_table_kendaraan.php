<?php

  class create_table_kendaraan
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE kendaraan (kode_kendaraan VARCHAR(2) NOT NULL, plat_no VARCHAR(7) NOT NULL, no_mesin VARCHAR(16) NOT NULL, no_rangka VARCHAR(16) NOT NULL, minyak_full DECIMAL(3,2) NOT NULL, M_1L DECIMAL(3,2) NOT NULL, kondisi INT NOT NULL, kode_merek VARCHAR(1) NOT NULL, kode_bensin VARCHAR(1) NOT NULL, nik CHAR(16) NOT NULL, PRIMARY KEY (kode_kendaraan));ALTER TABLE kendaraan ADD CONSTRAINT users_mobil_fk FOREIGN KEY (nik) REFERENCES users (nik) ON DELETE cascade ON UPDATE cascade;";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table Kendaraan<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table Kendaraan";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `kendaraan`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table Kendaraan<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table Kendaraan<br>";
          }
      }

  }


?>
