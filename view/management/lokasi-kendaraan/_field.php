<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode Waktu</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['kode_waktu'])){echo $data['kode_waktu'];} ?>"  id="kode_waktu" name="kode_waktu" placeholder="ex : 1" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Waktu Mulai</label>
    <div class="col-sm-10">
        <input type="time" class="form-control" value="<?php if(isset($data['waktu_mulai'])){echo $data['waktu_mulai'];} ?>"  id="waktu_mulai" name="waktu_mulai" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Waktu Akhir</label>
    <div class="col-sm-10">
        <input type="time" class="form-control" value="<?php if(isset($data['waktu_sampai'])){echo $data['waktu_sampai'];} ?>"  id="waktu_sampai" name="waktu_sampai" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Hari</label>
    <div class="col-sm-10">
        <select class="form-control" name="hari" required>
          <option value="1" <?php if(isset($data['hari'])){if($data['hari']==1){echo "selected";}} ?>>Senin</option>
          <option value="2" <?php if(isset($data['hari'])){if($data['hari']==2){echo "selected";}} ?>>Selasa</option>
          <option value="3" <?php if(isset($data['hari'])){if($data['hari']==3){echo "selected";}} ?>>Rabu</option>
          <option value="4" <?php if(isset($data['hari'])){if($data['hari']==4){echo "selected";}} ?>>Kamis</option>
          <option value="5" <?php if(isset($data['hari'])){if($data['hari']==5){echo "selected";}} ?>>Jumat</option>
          <option value="6" <?php if(isset($data['hari'])){if($data['hari']==6){echo "selected";}} ?>>Sabtu</option>
          <option value="7" <?php if(isset($data['hari'])){if($data['hari']==7){echo "selected";}} ?>>Minggu</option>
        </select>
        <span class="messages popover-valid"></span>
    </div>
</div>
