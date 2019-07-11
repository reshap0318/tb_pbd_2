<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kode Satuan Kerja</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['kode_satker'])){echo $data['kode_satker'];} ?>"  id="kode_satker" name="kode_satker" placeholder="ex : L1" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : Padang" required>
        <span class="messages popover-valid"></span>
    </div>
</div>
