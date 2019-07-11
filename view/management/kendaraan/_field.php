<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode Kendaraan</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['kode_kendaraan'])){echo $data['kode_kendaraan'];} ?>"  id="kode_kendaraan" name="kode_kendaraan" placeholder="ex : 1" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Plat No</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['plat_no'])){echo $data['plat_no'];} ?>"  id="plat_no" name="plat_no" placeholder="BA 4925 EZ" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Mesin</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['no_mesin'])){echo $data['no_mesin'];} ?>"  id="no_mesin" name="no_mesin" placeholder="ASK3103140123KJLLS" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Rangka</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['no_rangka'])){echo $data['no_rangka'];} ?>"  id="no_rangka" name="no_rangka" placeholder="AS912LKSA3P13K10" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Minyak Full</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" value="<?php if(isset($data['minyak_full'])){echo $data['minyak_full'];} ?>"  id="minyak_full" name="minyak_full" placeholder="22.1" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jarak dalam 1 L</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" value="<?php if(isset($data['m_1l'])){echo $data['m_1l'];} ?>"  id="m_1l" name="m_1l" placeholder="22.1" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kondisi</label>
    <div class="col-sm-10">
        <select class="form-control" name="kondisi" required>
          <option value="1" <?php if(isset($data['kondisi'])){if($data['kondisi']==1){echo "selected";}} ?>>Baik</option>
          <option value="2" <?php if(isset($data['kondisi'])){if($data['kondisi']==2){echo "selected";}} ?>>Rusak Sedikit</option>
          <option value="3" <?php if(isset($data['kondisi'])){if($data['kondisi']==3){echo "selected";}} ?>>Rusak Berat</option>
        </select>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Merek</label>
    <div class="col-sm-10">
      <select class="form-control" name="kode_merek" required>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/merek.php';
          $merek = new merek($conn);

          foreach ($merek->data() as $sat) {
              echo '<option value="'.$sat['kode_merek'].'">'.$sat['nama'].'</option>';
          }
        ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Bensin</label>
    <div class="col-sm-10">
      <select class="form-control" name="kode_bensin" required>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/bensin.php';
          $bensin = new bensin($conn);

          foreach ($bensin->data() as $sat) {
              echo '<option value="'.$sat['kode_bensin'].'">'.$sat['nama'].'</option>';
          }
        ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Sopir</label>
    <div class="col-sm-10">
      <select class="form-control" name="nik" required>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/user.php';
          $user = new user($conn);

          foreach ($user->data() as $sat) {
              echo '<option value="'.$sat['nik'].'">'.$sat['nama'].'</option>';
          }
        ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>
