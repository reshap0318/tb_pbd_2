<?php

  class lokasi{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_lokasi=''){
      $sql = "select * from lokasi";
      if($kode_lokasi!=''){
        $sql = "select * from lokasi where kode_lokasi = '$kode_lokasi'";
      }
      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_lokasi = null, $nama = null, $asal = null, $tujuan = null, $jarak = null, $harga = null,$pesan = true){
        $sql = "insert into lokasi(kode_lokasi, nama, asal, tujuan, jarak, harga) values ('$kode_lokasi', '$nama', '$asal', '$tujuan', $jarak, $harga)";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Lokasi']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Lokasi']);
          }
          header("location:/tb_pbd_sp/view/management/lokasi");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Lokasi ".$nama;
          }else{
            echo "Gagal Menambahkan Lokasi";
          }
        }
    }

    function update($last_kode_lokasi,$kode_lokasi, $nama = null, $asal = null, $tujuan = null, $jarak = null, $harga = null){

        $data = mysqli_fetch_assoc($this->data($last_kode_lokasi));

        $sql = "update lokasi SET kode_lokasi='$kode_lokasi' ";

        if($nama != null){
            $sql .= ",nama='$nama' ";
        }

        if($asal != null){
            $sql .= ",asal='$asal' ";
        }

        if($tujuan != null){
            $sql .= ",tujuan='$tujuan' ";
        }

        if($jarak != null){
            $sql .= ",jarak='$jarak' ";
        }

        if($harga != null){
            $sql .= ",harga=$harga ";
        }

        $kode_lokasi = $data['kode_lokasi'];
        $sql .= " WHERE kode_lokasi = '$kode_lokasi'";
        if($kode_lokasi==''){
          array_push($_SESSION['pesan'],['eror','Data Lokasi Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Lokasi']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Lokasi']);
        }
        header("location:/tb_pbd_sp/view/management/lokasi");
    }

    function delete($kode_lokasi = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_lokasi));
        if($data != null){
            $sql = "delete FROM `lokasi` WHERE kode_lokasi = '$kode_lokasi'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Lokasi']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Lokasi']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_lokasi tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/management/lokasi");
    }

    function empty()
    {
      $sql = "TRUNCATE `lokasi`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }
  }

?>
