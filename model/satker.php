<?php

  class satker{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_satker=''){
      $sql = "select * from satker";
      if($kode_satker!=''){
        $sql = "select * from satker where kode_satker = '$kode_satker'";
      }
      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_satker = null, $nama = null, $pesan = true){
        $sql = "insert into satker(kode_satker, nama) values ('$kode_satker', '$nama')";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Satuan Kerja']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Satuan Kerja']);
          }
          header("location:/tb_pbd_sp/view/management/satuan-kerja");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Satuan Kerja ".$nama;
          }else{
            echo "Gagal Menambahkan Satuan Kerja";
          }
        }
    }

    function update($last_kode_satker,$kode_satker, $nama = null){

        $data = mysqli_fetch_assoc($this->data($last_kode_satker));

        $sql = "update satker SET kode_satker='$kode_satker' ";

        if($nama != null){
            $sql .= ",nama='$nama' ";
        }

        $kode_satker = $data['kode_satker'];
        $sql .= " WHERE kode_satker = '$kode_satker'";
        if($kode_satker==''){
          array_push($_SESSION['pesan'],['eror','Data Satuan Kerja Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Satuan Kerja']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Satuan Kerja']);
        }
        header("location:/tb_pbd_sp/view/management/satuan-kerja");
    }

    function delete($kode_satker = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_satker));
        if($data != null){
            $sql = "delete FROM `satker` WHERE kode_satker = '$kode_satker'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Satuan Kerja']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Satuan Kerja']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_satker tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/management/satuan-kerja");
    }

    function empty()
    {
      $sql = "TRUNCATE `satker`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }
  }

?>
