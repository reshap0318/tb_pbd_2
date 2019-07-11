<?php

  class satkerSeeder
  {

    private $satker = [
      ['L1','Batusangkar'],
      ['L2','Padang']
    ];

    function __construct()
    {
        include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/controller/koneksi.php';
        include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/satker.php';
        $satker = new satker($conn);

        $satker->empty();

        foreach ($this->satker as $data) {
          $satker->store($data[0],$data[1],false);
        }
    }

  }

?>
