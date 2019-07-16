<?php
  $satkers = '';
  $plat_no = '';
  $datang = '';
  $keluar = '';

  if(isset($_GET['datang'])){
    if($_GET['datang']!=null){
      $datang = $_GET['datang'];
    }
  }

  if(isset($_GET['keluar'])){
    if($_GET['keluar']!=null){
      $keluar = $_GET['keluar'];
    }
  }

  if(isset($_GET['plat_no'])){
    if($_GET['plat_no']!=null){
      $plat_no = $_GET['plat_no'];
    }
  }

  if(isset($_GET['kode_satker'])){
    if($_GET['kode_satker']!='all'){
      $satkers = $_GET['kode_satker'];
    }
  }
?>

<div class="card">
  <div class="card-block">
    <form class="col-md-12" action="/tb_pbd_sp/view/lokasi-kendaraan/index.php" method="get">
      <div class="row">

        <div class="form-group row col-sm-6 text-right">
          <label class="col-sm-4 col-form-label">Satuan Kerja</label>
          <div class="col-sm-8">
              <select class="form-control " name="kode_satker">
                <option value="all">All</option>
                <?php
                  include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/satker.php';
                  $satker = new satker($conn);
                  if($hak_akses==1){
                    $datas = $satker->data();
                  }else{
                    $datas = $satker->data($kode_satker);
                  }
                  foreach ($datas as $sat) {
                    if($satkers==$sat['kode_satker']){
                      echo '<option value="'.$sat['kode_satker'].'" selected>'.$sat['nama'].'</option>';
                    }else{
                      echo '<option value="'.$sat['kode_satker'].'">'.$sat['nama'].'</option>';
                    }
                  }
                ?>
              </select>
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-6 text-right">
          <label class="col-sm-4 col-form-label">Plat No</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" value="<?php if(isset($_GET['plat_no'])){echo $_GET['plat_no'];} ?>" name="plat_no" placeholder="Plat Nomor">
              <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-6 text-right">
          <label class="col-sm-4 col-form-label">Datang</label>
          <div class="col-sm-8">
            <input type="date" class="form-control" value="<?php if(isset($_GET['datang'])){echo $_GET['datang'];} ?>" name="datang" placeholder="Waktu Datang">
            <span class="messages popover-valid"></span>
          </div>
        </div>
        <div class="form-group row col-sm-6 text-right">
          <label class="col-sm-4 col-form-label">Keluar</label>
          <div class="col-sm-8">
            <input type="date" class="form-control" value="<?php if(isset($_GET['keluar'])){echo $_GET['keluar'];} ?>" name="keluar" placeholder="Waktu Keluar">
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
