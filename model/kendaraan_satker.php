<?php

  class kendaraan_satker{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_parkir='', $kode_satker='',$relation = false){
      $sql = "select * from kendaraan_satker";

      if($relation){
        $sql = "select id, kendaraan.plat_no, satker.nama as satker, datang, keluar from kendaraan_satker join kendaraan on kendaraan_satker.kode_kendaraan = kendaraan.kode_kendaraan join satker on kendaraan_satker.kode_satker = satker.kode_satker";
      }

      if($kode_satker!=''){
        $sql .= " where satker.kode_satker = '$kode_satker'";
      }

      if($kode_parkir!=''){
        $sql .= " where id = '$kode_parkir'";
      }

      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_parkir = null, $kode_kendaraan = null, $kode_satker = null, $datang = null, $keluar = null,$pesan = true){
        $sql = "insert into kendaraan_satker(id, kode_kendaraan, kode_satker, datang, keluar) values ('$kode_parkir', '$kode_kendaraan', '$kode_satker', '$datang', '$keluar')";

        if(!$keluar){
          $sql = "insert into kendaraan_satker(id, kode_kendaraan, kode_satker, datang) values ('$kode_parkir', '$kode_kendaraan', '$kode_satker', '$datang')";
        }

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Posisi Kendaraan']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Posisi Kendaraan']);
          }
          header("location:/tb_pbd_sp/view/lokasi-kendaraan");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Posisi Kendaraan ".$nama;
          }else{
            echo "Gagal Menambahkan Posisi Kendaraan";
          }
        }
    }

    function update($last_kode_parkir,$kode_parkir, $kode_kendaraan = null, $kode_satker = null, $datang = null, $keluar = null){

        $data = mysqli_fetch_assoc($this->data($last_kode_parkir));

        $sql = "update kendaraan_satker SET id='$kode_parkir' ";

        if($kode_kendaraan != null){
            $sql .= ",kode_kendaraan='$kode_kendaraan' ";
        }

        if($kode_satker != null){
            $sql .= ",kode_satker='$kode_satker' ";
        }

        if($datang != null){
            $sql .= ",datang='$datang' ";
        }

        if($keluar != null){
            $sql .= ",keluar='$keluar' ";
        }

        $kode_parkir = $data['id'];
        $sql .= " WHERE id = '$kode_parkir'";
        if($kode_parkir==''){
          array_push($_SESSION['pesan'],['eror','Data Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Posisi Kendaraan']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Posisi Kendaraan']);
        }
        // echo $sql;
        // echo mysqli_error($this->koneksi);
        header("location:/tb_pbd_sp/view/lokasi-kendaraan");
    }

    function delete($kode_parkir = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_parkir));
        if($data != null){
            $sql = "delete FROM `kendaraan_satker` WHERE id = '$kode_parkir'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Posisi Kendaraan']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Posisi Kendaraan']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_parkir tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/lokasi-kendaraan");
    }

    function empty()
    {
      $sql = "TRUNCATE `kendaraan_satker`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }

    function keluar($id)
    {
        $sql = "update kendaraan_satker set keluar = now() where id = '$id'";
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Mengeluarkan Posisi Kendaraan']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Mengeluarkan Posisi Kendaraan']);
        }
        header("location:/tb_pbd_sp/view/lokasi-kendaraan");
    }
  }

?>
