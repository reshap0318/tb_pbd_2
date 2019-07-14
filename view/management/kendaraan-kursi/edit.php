<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';

include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan_kursi.php';
$kursi = new kendaraan_kursi($conn);
?>
<?php

  if(isset($hak_akses)){
    if($hak_akses!=1){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Edit Kursi <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/management/kendaraan-kursi">Kursi</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Kursi
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/kendaraan_kursiController.php?aksi=update" method="post" novalidate>
            <?php
              $kode_kursi = $_GET['kode_kursi'];
              foreach ($kursi->data($kode_kursi) as $data) {
            ?>
            <input type="hidden" value="<?php echo $kode_kursi;?>"  id="last_kode_kursi" name="last_kode_kursi">
            <input type="hidden" name="kode_kendaraan" value="<?php echo $data['kode_kendaraan'];?>" readonly>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/management/kendaraan-kursi/_field.php'; ?>
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
