<?php

  class bensin{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_bensin=''){
      $sql = "select * from bensin";
      if($kode_bensin!=''){
        $sql = "select * from bensin where kode_bensin = '$kode_bensin'";
      }
      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_bensin = null, $nama = null, $harga = null,$pesan = true){
        $sql = "insert into bensin(kode_bensin, nama, harga) values ('$kode_bensin', '$nama', $harga)";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Bensin']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Bensin']);
          }
          header("location:/tb_pbd_sp/view/management/bensin");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Bensin ".$nama;
          }else{
            echo "Gagal Menambahkan Bensin";
          }
        }
    }

    function update($last_kode_bensin,$kode_bensin, $nama = null, $harga = null){

        $data = mysqli_fetch_assoc($this->data($last_kode_bensin));

        $sql = "update bensin SET kode_bensin='$kode_bensin' ";

        if($nama != null){
            $sql .= ",nama='$nama' ";
        }

        if($harga != null){
            $sql .= ",harga='$harga' ";
        }

        $kode_bensin = $data['kode_bensin'];
        $sql .= " WHERE kode_bensin = '$kode_bensin'";
        if($kode_bensin==''){
          array_push($_SESSION['pesan'],['eror','Data Bensin Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Bensin']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Bensin']);
        }
        header("location:/tb_pbd_sp/view/management/bensin");
    }

    function delete($kode_bensin = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_bensin));
        if($data != null){
            $sql = "delete FROM `bensin` WHERE kode_bensin = '$kode_bensin'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Bensin']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Bensin']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_bensin tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/management/bensin");
    }

    function empty()
    {
      $sql = "TRUNCATE `bensin`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }
  }

?>
