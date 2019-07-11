<?php

  class merek{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_merek=''){
      $sql = "select * from merek_kendaraan";
      if($kode_merek!=''){
        $sql = "select * from merek_kendaraan where kode_merek = '$kode_merek'";
      }
      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_merek = null, $nama = null,$pesan = true){
        $sql = "insert into merek_kendaraan(kode_merek, nama) values ('$kode_merek', '$nama')";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Bensin']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Bensin']);
          }
          header("location:/tb_pbd_sp/view/management/merek-kendaraan");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Bensin ".$nama;
          }else{
            echo "Gagal Menambahkan Bensin";
          }
        }
    }

    function update($last_kode_merek,$kode_merek, $nama = null){

        $data = mysqli_fetch_assoc($this->data($last_kode_merek));

        $sql = "update merek_kendaraan SET kode_merek='$kode_merek' ";

        if($nama != null){
            $sql .= ",nama='$nama' ";
        }

        $kode_merek = $data['kode_merek'];
        $sql .= " WHERE kode_merek = '$kode_merek'";
        if($kode_merek==''){
          array_push($_SESSION['pesan'],['eror','Data Bensin Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Bensin']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Bensin']);
        }
        header("location:/tb_pbd_sp/view/management/merek-kendaraan");
    }

    function delete($kode_merek = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_merek));
        if($data != null){
            $sql = "delete FROM `merek_kendaraan` WHERE kode_merek = '$kode_merek'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Bensin']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Bensin']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_merek tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/management/merek-kendaraan");
    }

    function empty()
    {
      $sql = "TRUNCATE `merek_kendaraan`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }
  }

?>
