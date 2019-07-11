<?php

  class waktu{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_waktu=''){
      $sql = "select * from waktu";
      if($kode_waktu!=''){
        $sql = "select * from waktu where kode_waktu = '$kode_waktu'";
      }
      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_waktu = null, $waktu_mulai = null, $waktu_sampai = null, $hari = null,$pesan = true){
        $sql = "insert into waktu(kode_waktu, waktu_mulai, waktu_sampai, hari) values ('$kode_waktu', '$waktu_mulai', '$waktu_sampai', $hari)";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Lokasi']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Lokasi']);
          }
          header("location:/tb_pbd_sp/view/management/waktu");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Lokasi ".$nama;
          }else{
            echo "Gagal Menambahkan Lokasi";
          }
        }
    }

    function update($last_kode_waktu, $kode_waktu, $waktu_mulai = null, $waktu_sampai = null, $hari = null){

        $data = mysqli_fetch_assoc($this->data($last_kode_waktu));

        $sql = "update waktu SET kode_waktu='$kode_waktu' ";

        if($waktu_mulai != null){
            $sql .= ",waktu_mulai='$waktu_mulai' ";
        }

        if($waktu_sampai != null){
            $sql .= ",waktu_sampai='$waktu_sampai' ";
        }

        if($hari != null){
            $sql .= ",hari=$hari ";
        }

        $kode_waktu = $data['kode_waktu'];
        $sql .= " WHERE kode_waktu = '$kode_waktu'";
        if($kode_waktu==''){
          array_push($_SESSION['pesan'],['eror','Data Lokasi Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Lokasi']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Lokasi']);
        }
        // echo mysqli_error($this->koneksi);
        header("location:/tb_pbd_sp/view/management/waktu");
    }

    function delete($kode_waktu = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_waktu));
        if($data != null){
            $sql = "delete FROM `waktu` WHERE kode_waktu = '$kode_waktu'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Lokasi']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Lokasi']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_waktu tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/management/waktu");
    }

    function empty()
    {
      $sql = "TRUNCATE `waktu`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }
  }

?>
