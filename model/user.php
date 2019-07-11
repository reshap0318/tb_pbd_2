<?php

  class user{

    private $koneksi;

    function __construct($conn){
      $this->koneksi = $conn;
  	}

    function data($nik=''){

      $sql = "select * from users";
      if($nik!=''){
        $sql = "select * from users where nik = '$nik'";
      }

      $data = mysqli_query($this->koneksi,$sql);

      return $data;
    }

    function store($nik = null, $nama = null, $username = null, $password = null, $kota_lahir = null, $tanggal_lahir = null, $alamat = null, $no_telp = null, $hak_akses = null, $kode_satker = null,$pesan = true){
        $password = md5($password);
        $sql = "insert into users(nik, nama, username, password, kota_lahir, tanggal_lahir, alamat, no_telp, hak_akses, kode_satker) values ('$nik', '$nama', '$username', '$password', '$kota_lahir', '$tanggal_lahir', '$alamat', '$no_telp', '$hak_akses', '$kode_satker')";

        if($pesan){
          if(!mysqli_query($this->koneksi,$sql)){
            array_push($_SESSION['pesan'],['eror','Gagal Menambahkan User']);
            array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
          }else{
            array_push($_SESSION['pesan'],['berhasil','Berhasil Menambahkan User']);
          }
          header("location:/tb_pbd_sp/view/management/user");
        }else{
          if(mysqli_query($this->koneksi,$sql)){
            echo "<br>Berhasil Menambahkan Data User ".$nama;
          }else{
            echo "Gagal Menambahkan User";
          }
        }
    }

    function update($last_nik,$nik, $nama = null, $username = null, $password = null, $kota_lahir = null, $tanggal_lahir = null, $alamat = null, $no_telp = null, $hak_akses = null, $kode_satker = null){

        $data = mysqli_fetch_assoc($this->data($last_nik));

        $sql = "update users SET nik='$nik' ";

        if($nama != null){
            $sql .= ",nama='$nama' ";
        }

        if($username != null){
            $sql .= ",username='$username' ";
        }

        if($password != null){
          $password = md5($password);
          $sql .= ",password='$password' ";
        }

        if($kota_lahir != null){
            $sql .= ",kota_lahir='$kota_lahir' ";
        }

        if($tanggal_lahir != null){
            $sql .= ",tanggal_lahir='$tanggal_lahir' ";
        }

        if($tanggal_lahir != null){
            $sql .= ",tanggal_lahir='$tanggal_lahir' ";
        }

        if($alamat != null){
            $sql .= ",alamat='$alamat' ";
        }

        if($no_telp != null){
            $sql .= ",no_telp='$no_telp' ";
        }

        if($hak_akses != null){
          $sql .= ",hak_akses=$hak_akses ";
        }

        if($kode_satker != null){
          $sql .= ",kode_satker='$kode_satker'";
        }

        $nik = $data['nik'];
        $sql .= " WHERE nik = '$nik'";
        if($nik==''){
          array_push($_SESSION['pesan'],['eror','Data User Tidak Ditemukan']);
        }
        if(!mysqli_query($this->koneksi,$sql)){
          array_push($_SESSION['pesan'],['eror','Gagal Merubah User']);
          array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
        }else{
          array_push($_SESSION['pesan'],['berhasil','Berhasil Merubah User']);
        }
        header("location:/tb_pbd_sp/view/management/user");
    }

    function delete($nik = '')
    {
        $data = mysqli_fetch_assoc($this->data($nik));
        if($data != null){
            $sql = "delete FROM `users` WHERE nik = '$nik'";
            if(!mysqli_query($this->koneksi,$sql)){
              array_push($_SESSION['pesan'],['eror','Gagal Menghapus User']);
              array_push($_SESSION['pesan'],['eror',mysqli_error($this->koneksi)]);
            }else{
              array_push($_SESSION['pesan'],['berhasil','Berhasil Menghapus User']);
            }
        }else{
            array_push($_SESSION['pesan'],['eror','nik tidak ditemukan']);
        }
        header("location:/tb_pbd_sp/view/management/user");
    }

    function empty()
    {
      $sql = "TRUNCATE `users`";
      if(mysqli_query($this->koneksi,$sql)){
        echo "berhasil Membersihkan data<br>";
      }else{
        echo "Gagal Membersihkan data<br>".mysqli_error($this->koneksi)."<br>";
      }
    }
  }

?>
