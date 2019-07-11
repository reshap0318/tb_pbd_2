<?php

  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';

  $aksi = 'login';
  $username = null;
  $password = null;
  $status = null;
  $link = '/tb_pbd_sp/view/';

  if($aksi=='login'){
    if(isset($_POST['username'])){
      $username = $_POST['username'];
    }
    else{
      $status = 'eror';
      array_push($_SESSION['pesan'],[$status,'Username Tidak Boleh Kosong']);
    }

    if(isset($_POST['password'])){
      $password = md5($_POST['password']);
    }
    else{
      $status = 'eror';
      array_push($_SESSION['pesan'],[$status,'Password Tidak Boleh Kosong']);
    }


    if($status!='eror'){

      $sql = "select * from users where username='$username' AND password='$password'";
      $eksekusi = mysqli_query($conn,$sql);

      foreach ($eksekusi as $data) {
        $_SESSION['status'] = 1;
        $status = 1;
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['hak_akses'] = $data['hak_akses'];
        $_SESSION['kode'] = '0';
      }

      $status = 'berhasil';
      array_push($_SESSION['pesan'],[$status,'Berhasil Login']);

      if($status==0){
        $link = '/tb_pbd_sp/view/auth/login.php';
        $status = 'eror';
        array_push($_SESSION['pesan'],[$status,'Username Atau Password Salah']);
      }
    }
    else{
      $link = '/tb_pbd_sp/view/auth/login.php';
      $status = 'eror';
      array_push($_SESSION['pesan'],[$status,'Terjadi Eror']);
    }
  }
  else{
    $link = '/tb_pbd_sp/view/auth/login.php';
    $status = 'eror';
    array_push($_SESSION['pesan'],[$status,'Link Tidak ditemukan']);
  }

  header('location:'.$link);
  // echo "status = ".$status."<br>Pesan = ".implode(" | ",$pesan);
  // return ['status'=>$status,'pesan'=>$pesan];

?>
