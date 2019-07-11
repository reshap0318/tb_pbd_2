<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';

include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/satker.php';
$satker = new satker($conn);
?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Edit Satuan Kerja <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/management/satuan-kerja">Satuan Kerja</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Satuan Kerja
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/satkerController.php?aksi=update" method="post" novalidate>
            <?php
              $kode_satker = $_GET['kode_satker'];
              foreach ($satker->data($kode_satker) as $data) {
            ?>
            <input type="hidden" value="<?php echo $kode_satker;?>"  id="last_kode_satker" name="last_kode_satker">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/management/satuan-kerja/_field.php'; ?>
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
