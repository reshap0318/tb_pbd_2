<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';

include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/detail_keberangkatan.php';
$detail_keberangkatan = new detail_keberangkatan($conn);
?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Edit Detail Keberangkatan <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/detail-keberangkatan">Detail Keberangkatan</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Detail Keberangkatan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/detail_keberangkatanController.php?aksi=update" method="post" novalidate>
            <?php
              $kode_pemesanan = $_GET['kode_pemesanan'];
              $kode_kursi = $_GET['kode_kursi'];
              foreach ($detail_keberangkatan->data($kode_pemesanan, $kode_kursi) as $data) {
            ?>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kursi</label>
                <div class="col-sm-10">
                  <select class="form-control js-example-basic-single" name="kode_kursi" required>
                    <option value="">-- pilihan --</option>
                    <?php
                      include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan_kursi.php';
                      $kursi = new kendaraan_kursi($conn);

                      foreach ($kursi->kursit_pesan($kode_pemesanan, $kode_kursi) as $sat) {
                        if($sat['kode_kursi'] == $data['kode_kursi']){
                          echo '<option value="'.$sat['kode_kursi'].'" selected>'.$sat['nama'].'</option>';
                        }else{
                          echo '<option value="'.$sat['kode_kursi'].'">'.$sat['nama'].'</option>';
                        }
                      }
                    ?>
                  </select>
                  <span class="messages popover-valid"></span>
                </div>
            </div>
            <input type="hidden" value="<?php echo $kode_pemesanan;?>"  id="last_kode_pemesanan" name="last_kode_pemesanan">
            <input type="hidden" value="<?php echo $kode_kursi;?>"  id="last_kode_kursi" name="last_kode_kursi">
            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/detail-keberangkatan/_field.php'; ?>
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
