<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal</label>
    <div class="col-sm-10">
        <input type="date" class="form-control" value="<?php if(isset($data['tanggal'])){echo $data['tanggal'];} ?>"  id="tanggal" name="tanggal" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Lokasi</label>
    <div class="col-sm-10">
      <select class="form-control js-example-basic-single" name="kode_lokasi" required>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/lokasi.php';
          $lokasi = new lokasi($conn);

          foreach ($lokasi->data() as $sat) {
            if($sat['kode_lokasi'] == $data['kode_lokasi']){
              echo '<option value="'.$sat['kode_lokasi'].'" selected>'.$sat['nama'].'</option>';
            }else{
              echo '<option value="'.$sat['kode_lokasi'].'">'.$sat['nama'].'</option>';
            }
          }
        ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Waktu</label>
    <div class="col-sm-10">
      <select class="form-control js-example-basic-single" name="kode_waktu" required>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/waktu.php';
          $waktu = new waktu($conn);

          foreach ($waktu->data() as $sat) {
            if($sat['kode_waktu'] == $data['kode_waktu']){
              echo '<option value="'.$sat['kode_waktu'].'" selected>'.$sat['waktu_mulai'].' - '.$sat['waktu_sampai'].' #'.$helper->hari(1).'</option>';
            }else{
              echo '<option value="'.$sat['kode_waktu'].'">'.$sat['waktu_mulai'].' - '.$sat['waktu_sampai'].' #'.$helper->hari(1).'</option>';
            }
          }
        ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Sopir</label>
    <div class="col-sm-10">
      <select class="form-control js-example-basic-single" name="nik" required>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/user.php';
          $user = new user($conn);

          foreach ($user->data('',3) as $sat) {
              if($sat['nik'] == $data['nik']){
                echo '<option value="'.$sat['nik'].'" selected>'.$sat['nama'].'</option>';
              }else{
                echo '<option value="'.$sat['nik'].'">'.$sat['nama'].'</option>';
              }
          }
        ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>

<input type="hidden" name="kode_satker" value="<?php echo $kode_satker; ?>">
