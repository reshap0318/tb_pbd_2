<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';

include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/jadwal_keberangkatan.php';
$jadwal_keberangkatan = new jadwal_keberangkatan($conn);
?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Edit Jadwal Keberangkatan <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/jadwal-keberangkatan">Jadwal Keberangkatan</a>
<li class="breadcrumb-item"><a href="#!">Edit</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Edit Jadwal Keberangkatan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/jadwal_keberangkatanController.php?aksi=update" method="post" novalidate>
            <?php
              $kode_pemesanan = $_GET['kode_pemesanan'];
              foreach ($jadwal_keberangkatan->data($kode_pemesanan) as $data) {
            ?>
            <input type="hidden" value="<?php echo $kode_pemesanan;?>"  id="last_kode_pemesanan" name="last_kode_pemesanan">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php if(isset($data['kode_pemesanan'])){echo $data['kode_pemesanan'];} ?>"  id="kode_pemesanan" name="kode_pemesanan" placeholder="ex : 1" required>
                    <span class="messages popover-valid"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kendaraan</label>
                <div class="col-sm-10">
                  <select class="form-control js-example-basic-single" name="kode_kendaraan" required placeholder="-- pilihan --">
                    <option value="">-- pilihan --</option>
                    <?php
                      include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan.php';
                      $kendaraan = new kendaraan($conn);

                      foreach ($kendaraan->data_d_lokasi($kode_satker, $data['kode_kendaraan']) as $sat) {
                        if($sat['kode_kendaraan'] == $data['kode_kendaraan']){
                          echo '<option value="'.$sat['kode_kendaraan'].'" selected>'.$sat['plat_no'].'</option>';
                        }else{
                          echo '<option value="'.$sat['kode_kendaraan'].'">'.$sat['plat_no'].'</option>';
                        }
                      }
                    ?>
                  </select>
                  <span class="messages popover-valid"></span>
                </div>
            </div>

            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/jadwal-keberangkatan/_field.php'; ?>
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
