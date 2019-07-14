<input type="hidden" name="kode_pemesanan" value="<?php echo $_GET['kode_pemesanan']; ?>">

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['nama'])){echo $data['nama'];} ?>"  id="nama" name="nama" placeholder="ex : Reinaldo Shandev Pratama" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Telp</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['no_telp'])){echo $data['no_telp'];} ?>"  id="no_telp" name="no_telp" placeholder="ex : 082267846262" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jemput</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['jemput'])){echo $data['jemput'];} ?>"  id="jemput" name="jemput" placeholder="ex : sikohaa" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Antar</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php if(isset($data['antar'])){echo $data['antar'];} ?>"  id="antar" name="antar" placeholder="ex : situhaa" required>
        <span class="messages popover-valid"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Biaya Tambahan</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" value="<?php if(isset($data['biaya_tambahan'])){echo $data['biaya_tambahan'];}else{ echo "0";} ?>"  id="biaya_tambahan" name="biaya_tambahan" min="0" required>
        <span class="messages popover-valid"></span>
    </div>
</div>
