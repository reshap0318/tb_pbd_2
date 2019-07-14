<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php'; ?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

  $kode_pemesanan = $_GET['kode_pemesanan'];

?>
<?php startblock('title') ?> Create Detail Keberangkatan <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/detail-keberangkatan/index.php?kode_pemesanan=<?php echo $kode_pemesanan ?>">Detail Keberangkatan</a>
<li class="breadcrumb-item"><a href="#!">Create</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Create Detail Keberangkatan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/detail_keberangkatanController.php?aksi=create" method="post" novalidate>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kursi</label>
                <div class="col-sm-10">
                  <select class="form-control js-example-basic-single" name="kode_kursi" required>
                    <option value="">-- pilihan --</option>
                    <?php
                      include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan_kursi.php';
                      $kursi = new kendaraan_kursi($conn);

                      foreach ($kursi->kursit_pesan($_GET['kode_pemesanan']) as $sat) {
                          echo '<option value="'.$sat['kode_kursi'].'">'.$sat['nama'].'</option>';
                      }
                    ?>
                  </select>
                  <span class="messages popover-valid"></span>
                </div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/detail-keberangkatan/_field.php'; ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>
