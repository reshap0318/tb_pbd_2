<?php

  class detail_keberangkatan{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($kode_pemesanan='', $kode_kursi='' ,$nama='', $no_telp='', $jemput='', $antar='', $biaya_tambahan='', $relation = false){
      $sql = "select * from pemesanan_detail where kode_pemesanan <> '0'";

      if($relation){
        $sql = "select pemesanan_detail.kode_pemesanan, kendaraan_kursi.nama as kursi, pemesanan_detail.kode_kursi,pemesanan_detail.nama, no_telp, jemput, antar, biaya_tambahan from pemesanan_detail join pemesanan on pemesanan_detail.kode_pemesanan = pemesanan.kode_pemesanan join kendaraan_kursi on pemesanan_detail.kode_kursi = kendaraan_kursi.kode_kursi where pemesanan_detail.kode_pemesanan <> '0'";
      }

      if($kode_pemesanan!=''){
        $sql .= " and pemesanan_detail.kode_pemesanan = '$kode_pemesanan'";
      }

      if($kode_kursi!=''){
        $sql .= " and pemesanan_detail.kode_kursi = '$kode_kursi'";
      }

      if($nama!=''){
        $sql .= " and pemesanan_detail.nama = '$nama'";
      }

      if($no_telp!=''){
        $sql .= " and pemesanan_detail.no_telp = '$no_telp'";
      }

      if($jemput!=''){
        $sql .= " and pemesanan_detail.jemput = '$jemput'";
      }

      if($antar!=''){
        $sql .= " and pemesanan_detail.antar = '$antar'";
      }

      $data = mysqli_query($this->koneksi,$sql);
      return $data;
    }

    function store($kode_pemesanan=null, $kode_kursi=null ,$nama=null, $no_telp=null, $jemput=null, $antar=null, $biaya_tambahan=null,$pesan = true){
        $sql = "insert into pemesanan_detail(kode_pemesanan, kode_kursi, nama, no_telp, jemput, antar, biaya_tambahan) values ('$kode_pemesanan', '$kode_kursi', '$nama','$no_telp', '$jemput', '$antar',$biaya_tambahan)";

        if(!$biaya_tambahan){
          $sql = "insert into pemesanan_detail(kode_pemesanan, kode_kursi, nama, no_telp, jemput, antar) values ('$kode_pemesanan', '$kode_kursi', '$nama','$no_telp', '$jemput', '$antar')";
        }
        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan Pemesanan Travel']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan Pemesanan Travel']);
          }
          // echo $sql;
          // echo mysqli_error($this->koneksi);
          header("location:/tb_pbd_sp/view/detail-keberangkatan?kode_pemesanan=$kode_pemesanan");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data Pemesanan Travel ";
          }else{
            echo "Gagal Menambahkan Jadwal Pemesanan Travel";
          }
        }
    }

    function update($last_kode_pemesanan, $last_kode_kursi, $kode_pemesanan=null, $kode_kursi=null ,$nama=null, $no_telp=null, $jemput=null, $antar=null, $biaya_tambahan=null,$pesan = true){

        $data = mysqli_fetch_assoc($this->data($last_kode_pemesanan, $last_kode_kursi));

        $sql = "update pemesanan_detail SET kode_pemesanan='$kode_pemesanan' ";

        if($kode_kursi != null){
            $sql .= ",kode_kursi='$kode_kursi' ";
        }

        if($nama != null){
            $sql .= ",nama='$nama' ";
        }

        if($no_telp != null){
            $sql .= ",no_telp='$no_telp' ";
        }

        if($jemput != null){
            $sql .= ",jemput='$jemput' ";
        }

        if($antar != null){
            $sql .= ",antar='$antar' ";
        }

        if($biaya_tambahan != null){
            $sql .= ",biaya_tambahan='$biaya_tambahan' ";
        }

        $kode_pemesanan = $data['kode_pemesanan'];
        $kode_kursi = $data['kode_kursi'];
        $sql .= " WHERE kode_pemesanan = '$kode_pemesanan' and kode_kursi = '$kode_kursi'";

        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah Pemesanan Travel']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah Pemesanan Travel']);
        }
        header("location:/tb_pbd_sp/view/detail-keberangkatan?kode_pemesanan=$kode_pemesanan");
    }

    function delete($kode_pemesanan = '', $kode_kursi = '')
    {
        $data = mysqli_fetch_assoc($this->data($kode_pemesanan, $kode_kursi));
        if($data != null){
            $sql = "delete FROM `pemesanan_detail` WHERE kode_pemesanan = '$kode_pemesanan' and kode_kursi = '$kode_kursi'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus Pemesanan Travel']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus Pemesanan Travel']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','kode_pemesanan tidak ditemukan']);
        }
        // echo mysqli_error($this->koneksi);
        header("location:/tb_pbd_sp/view/detail-keberangkatan?kode_pemesanan=$kode_pemesanan");
    }

    function empty()
    {
      $sql = "TRUNCATE `pemesanan_detail`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }

    function uang_masuk($kode_pemesanan)
    {
        $sql = "SELECT pemesanan.kode_pemesanan, lokasi.harga,COUNT(pemesanan_detail.kode_pemesanan) as normal, sum(pemesanan_detail.biaya_tambahan) as tambahan from pemesanan_detail RIGHT join pemesanan on pemesanan_detail.kode_pemesanan = pemesanan.kode_pemesanan JOIN lokasi on pemesanan.kode_lokasi = lokasi.kode_lokasi  where pemesanan_detail.kode_pemesanan = '$kode_pemesanan' GROUP BY pemesanan.kode_pemesanan";
        $data = mysqli_query($this->koneksi,$sql);
        return $data;
    }
  }

?>
