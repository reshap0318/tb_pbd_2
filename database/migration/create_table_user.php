<?php

  class create_table_user
  {

      private $koneksi;

      function __construct($conn){
        $this->koneksi = $conn;
        $this->drop();
        $this->create();
      }

      function create()
      {
        $sql = "CREATE TABLE users ( nik CHAR(16) NOT NULL, nama VARCHAR(30) NOT NULL, username VARCHAR(10) NOT NULL, kota_lahir VARCHAR(20), tanggal_lahir DATE, alamat VARCHAR(300) NOT NULL, no_telp VARCHAR(13) NOT NULL, status VARCHAR(1) NOT NULL, kode_satker CHAR(2) NOT NULL, PRIMARY KEY (nik));ALTER TABLE users ADD CONSTRAINT satker_users_fk FOREIGN KEY (kode_satker) REFERENCES satker (kode_satker) ON DELETE cascade ON UPDATE cascade;";
        if(!mysqli_query($this->koneksi,$sql)){
          echo "<br>Gagal Membuat Table User<br>".mysqli_error($this->koneksi);
        }else{
          echo "<br>Berhasil Membuat Table User";
        }
      }

      function drop()
      {
          $sql = "DROP TABLE `users`";
          if(!mysqli_query($this->koneksi,$sql)){
            echo "Gagal Menghapus Table User<br>".mysqli_error($this->koneksi)."<br>";
          }else{
            echo "Berhasil Menghapus Table User<br>";
          }
      }

  }


?>
