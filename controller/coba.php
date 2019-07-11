<?php
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/user.php';
  $user = new user($conn);

  // $user->store('reshap0318','12345678','Reinaldo Shandev Pratama',1);
  // $row = $user->data();
  // echo $row['hak_akses'];
  // $user->update('reshap0320','','Reinaldo Shandev Pratama');
  // $user->delete('reshap0318');
	$_SESSION['pesan'] = [];
?>
