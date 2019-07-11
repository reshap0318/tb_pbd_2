<?php
  session_start();
  session_destroy();
  header('location:/tb_pbd_sp/view/auth/login.php');
?>
