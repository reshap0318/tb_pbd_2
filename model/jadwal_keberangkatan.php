<?php

  class jadwal_keberangkatan{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_pemesanan='', $tanggal='' ,$kode_kendaraan='', $kode_lokasi='', $kode_waktu='', $kode_satker='', $relation = false){
      $sql = "select * from pemesanan where kode_pemesanan <> '0'";

      if($relation){
        $sql = "select kode_pemesanan, tanggal, kendaraan.plat_no, waktu_mulai, waktu_sampai, waktu.hari, lokasi.nama as lokasi, satker.nama as satker from pemesanan join lokasi on pemesanan.kode_lokasi = lokasi.kode_lokasi join kendaraan on pemesanan.kode_kendaraan = kendaraan.kode_kendaraan join satker on pemesanan.kode_satker = satker.kode_satker join waktu on pemesanan.kode_waktu = waktu.kode_waktu where kode_pemesanan <> '0'";
      }

      if($kode_pemesanan!=''){
        $sql .= " and pemesanan.kode_pemesanan = '$kode_pemesanan'";
      }

      if($tanggal){
        $sql .= " and pemesanan.tanggal = '$tanggal'";
      }

      if($kode_kendaraan){
        $sql .= " and pemesanan.kode_kendaraan = '$kode_kendaraan'";
      }

      if($kode_lokasi){
        $sql .= " and pemesanan.kode_lokasi = '$kode_lokasi'";
      }

      if($kode_waktu){
        $sql .= " and pemesanan.kode_waktu = '$kode_waktu'";
      }

      if($kode_satker){
        $sql .= " and pemesanan.kode_satker = '$kode_satker'";
      }

      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_pemesanan = null, $tanggal = null, $kode_kendaraan = null,$kode_lokasi = null, $kode_waktu = null, $kode_satker = null,$pesan = true){
        $sql = "insert into pemesanan(kode_pemesanan, tanggal, kode_kendaraan, kode_lokasi, kode_waktu, kode_satker) values ('$kode_pemesanan', '$tanggal', '$kode_kendaraan','$kode_lokasi', '$kode_waktu', '$kode_satker')";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Jadwal Keberangkatan']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Jadwal Keberangkatan']);
          }
          header("location:/tb_pbd_sp/view/jadwal-keberangkatan");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Jadwal Keberangkatan ";
          }else{
            echo "Gagal Menambahkan Jadwal Keberangkatan";
          }
        }
    }

    function update($last_kode_pemesanan, $kode_pemesanan = null, $tanggal = null, $kode_kendaraan = null,$kode_lokasi = null, $kode_waktu = null, $kode_satker = null,$pesan = true){

        $data = mysqli_fetch_assoc($this->data($last_kode_pemesanan));

        $sql = "update pemesanan SET kode_pemesanan='$kode_pemesanan' ";

        if($tanggal != null){
            $sql .= ",tanggal='$tanggal' ";
        }

        if($kode_kendaraan != null){
            $sql .= ",kode_kendaraan='$kode_kendaraan' ";
        }

        if($kode_lokasi != null){
            $sql .= ",kode_lokasi='$kode_lokasi' ";
        }

        if($kode_waktu != null){
            $sql .= ",kode_waktu='$kode_waktu' ";
        }

        if($kode_satker != null){
            $sql .= ",kode_satker='$kode_satker' ";
        }

        $kode_pemesanan = $data['kode_pemesanan'];
        $sql .= " WHERE kode_pemesanan = '$kode_pemesanan'";
        if($kode_pemesanan==''){
          array_push($_SESSION['pesan'],['eror','Data Jadwal Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Jadwal Keberangkatan']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Jadwal Keberangkatan']);
        }
        header("location:/tb_pbd_sp/view/jadwal-keberangkatan");
    }

    function delete($kode_pemesanan = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_pemesanan));
        if($data != null){
            $sql = "delete FROM `pemesanan` WHERE kode_pemesanan = '$kode_pemesanan'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Pemesanan']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Pemesanan']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_pemesanan tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/jadwal-keberangkatan");
    }

    function empty()
    {
      $sql = "TRUNCATE `pemesanan`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }
  }

?>
