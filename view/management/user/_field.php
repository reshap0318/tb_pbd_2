<input type="hidden" name="last_nik" value="<?php if(isset($data['nik'])){echo $data['nik'];} ?>">
<div class="form-group row">
    <label class="col-sm-2 col-form-label">NIK</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nik'])){echo $data['nik'];} ?>"  id="nik" name="nik" placeholder="ex : 1301980603001" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : Reinaldo Shandev Pratama" required>
        <span class="messages popover-valid"></span>
  </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['username'])){echo $data['username'];} ?>"  id="username" name="username" placeholder="ex : 1611522012" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">password</label>
    <div class="col-sm-10">
        <input type="password" class="form-control" value=""  id="password" name="password" placeholder="*******" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tempat Lahir</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['kota_lahir'])){echo $data['kota_lahir'];} ?>"  id="kota_lahir" name="kota_lahir" placeholder="ex : Padang">
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
    <div class="col-sm-10">
        <input type="date" class="form-control" value="<?php if(isset($data['tanggal_lahir'])){echo $data['tanggal_lahir'];} ?>"  id="tanggal_lahir" name="tanggal_lahir">
        <span class="messages popover-valid"></span>
  </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Telphone</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['no_telp'])){echo $data['no_telp'];} ?>"  id="no_telp" name="no_telp" placeholder="No Telphone">
        <span class="messages popover-valid"></span>
  </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
        <textarea name="alamat" rows="8" cols="80" class="form-control" placeholder="Alamat"><?php if(isset($data['alamat'])){echo $data['alamat'];} ?></textarea>
        <span class="messages popover-valid"></span>
  </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Satuan Kerja</label>
    <div class="col-sm-10">
      <select class="form-control" name="kode_satker" required>
        <?php
          include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/satker.php';
          $satker = new satker($conn);

          foreach ($satker->data() as $sat) {
              echo '<option value="'.$sat['kode_satker'].'">'.$sat['nama'].'</option>';
          }
        ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Hak Akses</label>
    <div class="col-sm-10">
      <select class="form-control" name="hak_akses" required>
        <?php if($hak_akses==1){ ?>
        <option value="1" <?php if(isset($data['hak_akses'])){if($data['hak_akses']==1){echo "selected";}} ?>>Admin</option>
        <?php } ?>
      </select>
      <span class="messages popover-valid"></span>
    </div>
</div>
