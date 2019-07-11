<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode Bensin</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['kode_bensin'])){echo $data['kode_bensin'];} ?>"  id="kode_bensin" name="kode_bensin" placeholder="ex : 1" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : Pertamax" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Harga</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" value="<?php if(isset($data['harga'])){echo $data['harga'];} ?>"  id="harga" name="harga" placeholder="ex : 6000" required min="0">
        <span class="messages popover-valid"></span>
    </div>
</div>
