<?php

  class kendaraan_kursi{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_kursi='', $relation = false, $kode_kendaraan = null){
      $sql = "select * from kendaraan_kursi";

      if($relation){
        $sql = "select kode_kursi, nama, kendaraan.plat_no from kendaraan_kursi join kendaraan on kendaraan_kursi.kode_kendaraan = kendaraan.kode_kendaraan";
      }

      if($kode_kursi!=''){
        $sql .= " where kode_kursi = '$kode_kursi'";
      }

      if($kode_kendaraan){
        $sql .= " where kode_kendaraan = '$kode_kendaraan'";
      }
      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_kursi = null, $nama = null, $kode_kendaraan = null,$pesan = true){
        $sql = "insert into kendaraan_kursi(kode_kursi, nama, kode_kendaraan) values ('$kode_kursi', '$nama', '$kode_kendaraan')";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Kursi']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Kursi']);
          }
          header("location:/tb_pbd_sp/view/management/kendaraan-kursi?kode_kendaraan=$kode_kendaraan");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Kursi ".$nama;
          }else{
            echo "Gagal Menambahkan Lokasi";
          }
        }
    }

    function update($last_kode_kursi, $kode_kursi, $nama = null, $kode_kendaraan = null,$pesan = true){

        $data = mysqli_fetch_assoc($this->data($last_kode_kursi));

        $sql = "update kendaraan_kursi SET kode_kursi='$kode_kursi' ";

        if($nama != null){
            $sql .= ",nama='$nama' ";
        }

        if($kode_kendaraan != null){
            $sql .= ",kode_kendaraan='$kode_kendaraan' ";
        }

        $kode_kursi = $data['kode_kursi'];
        $sql .= " WHERE kode_kursi = '$kode_kursi'";
        if($kode_kursi==''){
          array_push($_SESSION['pesan'],['eror','Data Lokasi Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Kursi']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Kursi']);
        }
        header("location:/tb_pbd_sp/view/management/kendaraan-kursi?kode_kendaraan=$kode_kendaraan");
    }

    function delete($kode_kursi = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_kursi));
        $kode_kendaraan = $data['kode_kendaraan'];
        if($data != null){
            $sql = "delete FROM `kendaraan_kursi` WHERE kode_kursi = '$kode_kursi'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Kursi']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Kursi']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_kursi tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/management/kendaraan-kursi?kode_kendaraan=$kode_kendaraan");
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

    function kursit_pesan($kode_pemesanan, $kode_kursi='')
    {
      $sql = "select * from kendaraan_kursi where kode_kursi not in (select kode_kursi from pemesanan_detail where kode_pemesanan = '$kode_pemesanan')";

      if($kode_kursi){
        $sql = "select * from kendaraan_kursi where kode_kursi not in (select kode_kursi from pemesanan_detail where kode_pemesanan = '$kode_pemesanan') or kode_kursi = $kode_kursi";
      }

      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }
  }

?>
