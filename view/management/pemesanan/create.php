<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php'; ?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Create Lokasi <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/management/waktu">Waktu</a>
<li class="breadcrumb-item"><a href="#!">Create</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Create Lokasi
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/waktuController.php?aksi=create" method="post" novalidate>

            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/management/waktu/_field.php'; ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>
