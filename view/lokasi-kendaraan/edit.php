<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';

include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan_satker.php';
$parkir = new kendaraan_satker($conn);
?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Lokasi Kendaraan <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/lokasi-kendaraan">Lokasi Kendaraan</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Lokasi Kendaraan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/kendaraan_satkerController.php?aksi=update" method="post" novalidate>
            <?php
              $kode_parkir = $_GET['kode_parkir'];
              foreach ($parkir->data($kode_parkir) as $data) {
            ?>
            <input type="hidden" name="last_kode_parkir" value="<?php echo $kode_parkir; ?>">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/lokasi-kendaraan/_field.php'; ?>
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
