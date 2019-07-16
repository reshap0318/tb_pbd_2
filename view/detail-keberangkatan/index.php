<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/detail_keberangkatan.php';
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/jadwal_keberangkatan.php';
$detail_keberangkatan = new detail_keberangkatan($conn);
$berangkat = new jadwal_keberangkatan($conn);
?>

<?php
  if(isset($hak_akses)){
    if($hak_akses>3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }
  $kode_pemesanan = $_GET['kode_pemesanan'];
  if($hak_akses==1){
    $keberangkatan = mysqli_fetch_assoc($berangkat->data($kode_pemesanan,'','','','','', true));
  }elseif($hak_akses==2){
    $keberangkatan = mysqli_fetch_assoc($berangkat->data($kode_pemesanan,'','','','',$kode_satker, true));
  }elseif($hak_akses==3){
    $keberangkatan = mysqli_fetch_assoc($berangkat->data($kode_pemesanan,'','','','','', true,$nik));
  }

  $uang = mysqli_fetch_assoc($detail_keberangkatan->uang_masuk($kode_pemesanan));
?>
<?php startblock('title') ?> Detail keberangkatan <?php echo $keberangkatan['plat_no']; ?> <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Detail keberangkatan <?php echo $keberangkatan['plat_no']; ?></a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Detail keberangkatan <?php echo $keberangkatan['plat_no']; ?>
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
      <div class="dt-responsive table-responsive" cellpadding="10">
          <table class="table nowrap">
            <tr>
              <td style="width:200px">Kode Pemesanan</td>
              <td>: <?php echo $keberangkatan['kode_pemesanan']; ?> </td>
              <td style="width:200px"></td>
              <td style="width:200px">Tanggal</td>
              <td>: <?php echo $keberangkatan['tanggal']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Plat No</td>
              <td>: <?php echo $keberangkatan['plat_no']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Lokasi</td>
              <td>: <?php echo $keberangkatan['lokasi']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Waktu</td>
              <td>: <?php echo $keberangkatan['waktu_mulai'].' - '.$keberangkatan['waktu_sampai'].' #'.$helper->hari($keberangkatan['hari']);?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Satuan Kerja</td>
              <td>: <?php echo $keberangkatan['satker']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Sopir</td>
              <td>: <?php echo $keberangkatan['sopir'];?></td>
              <td style="width:200px"></td>
              <td style="width:200px"></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="5" class="text-center">
                Keuangan Masuk
              </td>
            </tr>
            <tr>
              <td style="width:200px">Normal</td>
              <td>: <?php echo $helper->rp($uang['normal']*$uang['harga']); ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Tambahan</td>
              <td>: <?php echo $helper->rp($uang['tambahan']); ?></td>
            </tr>
            <tr>
              <td colspan="5" class="text-center">
                Total
              </td>
            </tr>
            <tr>
              <td colspan="5" class="text-center">
                <label class="label label-lg label-info"><?php echo $helper->rp($uang['normal']*$uang['harga']+$uang['tambahan']); ?></label>
              </td>
            </tr>
          </table>
      </div>
    </div>
</div>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tbldtl" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Kode Kursi</th>
                      <th>Nama</th>
                      <th>No Telp</th>
                      <th>Jemput</th>
                      <th>Antar</th>
                      <th>Biaya Tambahan</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  foreach ($detail_keberangkatan->data($keberangkatan['kode_pemesanan'],'','','','','','',true) as $data) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['kursi'];?></td>
                      <td><?php echo $data['nama'];?></td>
                      <td><?php echo $data['no_telp'];?></td>
                      <td><?php echo $data['jemput'];?></td>
                      <td><?php echo $data['antar'];?></td>
                      <td><?php echo $data['biaya_tambahan'];?></td>
                      <td style="width:100px">
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd_sp/view/detail-keberangkatan/edit.php?kode_pemesanan=<?php echo $data['kode_pemesanan']; ?>&kode_kursi=<?php echo $data['kode_kursi']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus('<?php echo $data['kode_pemesanan']; ?>','<?php echo $data['kode_kursi']; ?>')">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
          <form class="" id="formdelete" style="display:none" action="/tb_pbd_sp/controller/detail_keberangkatanController.php?aksi=delete" method="post">
            <input type="text" name="kode_pemesanan" value="" id="delete_id">
            <input type="text" name="kode_kursi" value="" id="delete_ids">
          </form>
      </div>
  </div>
</div>
<div class="text-center">
  <a href="/tb_pbd_sp/view/jadwal-keberangkatan" class="btn btn-warning waves-effect waves-light">Back</a>
</div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tbldtl').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
      <?php if($hak_akses==1 || $hak_akses==2){ ?>
        {
            text: 'Tambah Detail keberangkatan',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd_sp/view/detail-keberangkatan/create.php?kode_pemesanan=<?php echo $keberangkatan['kode_pemesanan']; ?>");
            }
        },
      <?php } ?>
        {
            extend: 'copy',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3]
            }
        },
        {
            extend: 'print',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3]
            }
        },
        {
            extend: 'excel',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3]
            }
        },
        {
            extend: 'pdf',
            className: 'btn-inverse',
            exportOptions: {
                columns: [0, 1, 2, 3]
            }
        }]
      });
  </script>

  <script type="text/javascript">
    function hapus(id, ed) {
      if(confirm('yakin ingin menghapus data ini?') == true){
        document.getElementById('delete_id').value = id;
        document.getElementById('delete_ids').value = ed;
        document.getElementById('formdelete').submit();
      }
    }
  </script>
<?php endblock() ?>
