<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['id'])){echo $data['id'];} ?>"  id="kode_parkir" name="kode_parkir" placeholder="ex : AA1" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<input type="hidden" name="kode_satker" value="<?php echo $kode_satker; ?>">

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Waktu Datang</label>
    <div class="col-sm-10">
        <input type="datetime-local" class="form-control" value="<?php if(isset($data['datang'])){echo date('Y-m-d h:s', strtotime($data['datang']));} ?>"  id="datang" name="datang" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Waktu Keluar</label>
    <div class="col-sm-10">
        <input type="datetime-local" class="form-control" value="<?php if(isset($data['keluar'])){echo date('Y-m-d h:s', strtotime($data['keluar']));} ?>"  id="keluar" name="keluar" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kendaraan</label>
    <div class="col-sm-10">
      <select class="form-control" name="kode_kendaraan" required>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan.php';
          $kendaraan = new kendaraan($conn);

          foreach ($kendaraan->data() as $sat) {
              echo '<option value="'.$sat['kode_kendaraan'].'">'.$sat['plat_no'].'</option>';
          }
        ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>
