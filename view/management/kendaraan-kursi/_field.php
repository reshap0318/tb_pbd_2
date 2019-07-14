<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode Kursi</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['kode_kursi'])){echo $data['kode_kursi'];} ?>"  id="kode_kursi" name="kode_kursi" placeholder="ex : 01" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : PYK01" required>
        <span class="messages popover-valid"></span>
    </div>
</div>
