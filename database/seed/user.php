<?php

  class userSeeder
  {

    private $user = [
      ['1611522012','Reinaldo Shandev Pratama',1,'L1'],
      ['1611521006','Annisa Aulia Khaira',1,'L2']
    ];

    function __construct()
    {
        include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
        include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/user.php';
        $user = new user($conn);

        $user->empty();
        foreach ($this->user as $data) {
          $user->store($data[0],$data[1],$data[0],$data[0],null, null, null, null, $data[2],$data[3],false);
        }
    }

  }

?>
