<?php
  $kode_pemesanan = '';
  $tanggal = '';
  $kode_lokasi = '';
  $kode_waktu = '';
  $plat_no = '';

  if(isset($_GET['kode_pemesanan'])){
    if($_GET['kode_pemesanan']!=null){
      $kode_pemesanan = $_GET['kode_pemesanan'];
    }
  }

  if(isset($_GET['tanggal'])){
    if($_GET['tanggal']!=null){
      $tanggal = $_GET['tanggal'];
    }
  }

  if(isset($_GET['kode_lokasi'])){
    if($_GET['kode_lokasi']!='all'){
      $kode_lokasi = $_GET['kode_lokasi'];
    }
  }

  if(isset($_GET['kode_waktu'])){
    if($_GET['kode_waktu']!='all'){
      $kode_waktu = $_GET['kode_waktu'];
    }
  }

  if(isset($_GET['plat_no'])){
    if($_GET['plat_no']!=null){
      $plat_no = $_GET['plat_no'];
    }
  }
?>

<div class="card">
  <div class="card-block">
    <form class="col-md-12" action="/tb_pbd_sp/view/jadwal-keberangkatan/index.php" method="get">
      <div class="row">
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">kode</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" value="<?php if(isset($_GET['kode_pemesanan'])){echo $_GET['kode_pemesanan'];} ?>" name="kode_pemesanan" placeholder="kode Pemesanan ">
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">Tanggal</label>
          <div class="col-sm-8">
              <input type="date" class="form-control" value="<?php if(isset($_GET['tanggal'])){echo $_GET['tanggal'];} ?>" name="tanggal" placeholder="Tanggal">
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-4 text-right">
          <label class="col-sm-4 col-form-label">Plat No</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" value="<?php if(isset($_GET['plat_no'])){echo $_GET['plat_no'];} ?>" name="plat_no" placeholder="Plat Nomor">
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-6 text-right">
          <label class="col-sm-4 col-form-label">Lokasi</label>
          <div class="col-sm-8">
              <select class="form-control " name="kode_lokasi">
                <option value="all">All</option>
                <?php
                  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/lokasi.php';
                  $lokasi = new lokasi($conn);

                  foreach ($lokasi->data() as $sat) {
                    if($kode_lokasi==$sat['kode_lokasi']){
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
        <div class="form-group row col-sm-6 text-right">
          <label class="col-sm-4 col-form-label">Waktu</label>
          <div class="col-sm-8">
              <select class="form-control " name="kode_waktu">
                <option value="all">All</option>
                <?php
                  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/waktu.php';
                  $waktu = new waktu($conn);

                  foreach ($waktu->data() as $sat) {
                    if($kode_waktu==$sat['kode_waktu']){
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
        <div class="form-group row col-sm-12 text-center">
          <button type="submit" class="btn btn-success col-sm-12">Cari</button>
        </div>
      </div>
    </form>
  </div>
</div>
