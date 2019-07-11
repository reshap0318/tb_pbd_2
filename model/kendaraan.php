<?php

  class kendaraan{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_kendaraan=''){
      $sql = "select * from kendaraan";
      if($kode_kendaraan!=''){
        $sql = "select * from kendaraan where kode_kendaraan = '$kode_kendaraan'";
      }
      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_kendaraan = null, $plat_no = null, $no_mesin = null, $no_rangka = null, $minyak_full = null, $m_1l = null, $kondisi = null, $kode_merek = null, $kode_bensin = null, $nik = null, $pesan = true){
        $sql = "insert INTO kendaraan(kode_kendaraan, plat_no, no_mesin, no_rangka, minyak_full, m_1l, kondisi, kode_merek, kode_bensin, nik) values ('$kode_kendaraan', '$plat_no', '$no_mesin', '$no_rangka', $minyak_full, $m_1l, $kondisi, '$kode_merek', '$kode_bensin', '$nik')";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Kendaraan']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Kendaraan']);
          }
          header("location:/tb_pbd_sp/view/management/kendaraan");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Kendaraan ".$nama;
          }else{
            echo "Gagal Menambahkan Kendaraan";
          }
        }
    }

    function update($last_kode_kendaraan, $kode_kendaraan, $plat_no = null, $no_mesin = null, $no_rangka = null, $minyak_full = null, $m_1l = null, $kondisi = null, $kode_merek = null, $kode_bensin = null, $nik = null){

        $data = mysqli_fetch_assoc($this->data($last_kode_kendaraan));

        $sql = "update kendaraan SET kode_kendaraan='$kode_kendaraan' ";

        if($plat_no != null){
            $sql .= ",plat_no='$plat_no' ";
        }

        if($no_mesin != null){
            $sql .= ",no_mesin='$no_mesin' ";
        }

        if($no_rangka != null){
            $sql .= ",no_rangka='$no_rangka' ";
        }

        if($minyak_full != null){
            $sql .= ",minyak_full=$minyak_full ";
        }

        if($m_1l != null){
            $sql .= ",m_1l=$m_1l ";
        }

        if($kondisi != null){
            $sql .= ",kondisi=$kondisi ";
        }

        if($kode_merek != null){
            $sql .= ",kode_merek='$kode_merek' ";
        }

        if($kode_bensin != null){
            $sql .= ",kode_bensin='$kode_bensin' ";
        }

        if($nik != null){
            $sql .= ",nik='$nik' ";
        }

        $kode_kendaraan = $data['kode_kendaraan'];
        $sql .= " WHERE kode_kendaraan = '$kode_kendaraan'";
        if($kode_kendaraan==''){
          array_push($_SESSION['pesan'],['eror','Data Kendaraan Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Kendaraan']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Kendaraan']);
        }
        header("location:/tb_pbd_sp/view/management/kendaraan");
    }

    function delete($kode_kendaraan = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_kendaraan));
        if($data != null){
            $sql = "delete FROM `kendaraan` WHERE kode_kendaraan = '$kode_kendaraan'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Kendaraan']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Kendaraan']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_kendaraan tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/management/kendaraan");
    }

    function empty()
    {
      $sql = "TRUNCATE `kendaraan`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }
  }

?>
