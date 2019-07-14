<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php'; ?>
<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Create Jadwal Keberangkatan <?php endblock() ?>
<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="/tb_pbd_sp/view/jadwal-keberangkatan">Jadwal Keberangkatan</a>
<li class="breadcrumb-item"><a href="#!">Create</a>
<?php endblock() ?>
<?php startblock('breadcrumb-title') ?>
Create Jadwal Keberangkatan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
        <form id="second" action="/tb_pbd_sp/controller/jadwal_keberangkatanController.php?aksi=create" method="post" novalidate>
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

                      foreach ($kendaraan->data_d_lokasi($kode_satker) as $sat) {
                          echo '<option value="'.$sat['kode_kendaraan'].'">'.$sat['plat_no'].'</option>';
                      }
                    ?>
                  </select>
                  <span class="messages popover-valid"></span>
                </div>
            </div>

            <?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/jadwal-keberangkatan/_field.php'; ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>
