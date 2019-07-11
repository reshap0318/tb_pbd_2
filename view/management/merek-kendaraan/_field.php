<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode Merek</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['kode_merek'])){echo $data['kode_merek'];} ?>"  id="kode_merek" name="kode_merek" placeholder="ex : 1" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : Avanza" required>
        <span class="messages popover-valid"></span>
    </div>
</div>
