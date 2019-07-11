<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';

include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan.php';
$kendaraan = new kendaraan($conn);
?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Edit Kendaraan <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/management/kendaraan">Kendaraan</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Kendaraan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/kendaraanController.php?aksi=update" method="post" novalidate>
            <?php
              $kode_kendaraan = $_GET['kode_kendaraan'];
              foreach ($kendaraan->data($kode_kendaraan) as $data) {
            ?>
            <input type="hidden" value="<?php echo $kode_kendaraan;?>"  id="last_kode_kendaraan" name="last_kode_kendaraan">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/management/kendaraan/_field.php'; ?>
            <?php } ?>
            <div class="row">
                <label class="col-sm-2"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>
