<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan_kursi.php';
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan.php';

$kursi = new kendaraan_kursi($conn);
$kendaraan = new kendaraan($conn);
?>

<?php
  if(isset($hak_akses)){
    if($hak_akses!=1){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }
  $kode_kendaraan = $_GET['kode_kendaraan'];
  $kendaraan = mysqli_fetch_assoc($kendaraan->data($kode_kendaraan,true));

?>
<?php startblock('title') ?> Kursi Management - <?php echo $kendaraan['plat_no']; ?> <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Kursi Management</a>
<li class="breadcrumb-item"><a href="#!"><?php echo $kendaraan['plat_no']; ?></a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Kursi Management - <?php echo $kendaraan['plat_no']; ?>
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
    <div class="card-block">
      <div class="dt-responsive table-responsive" cellpadding="10">
          <table class="table nowrap">
            <tr>
              <td style="width:200px">Kode Kendaraan</td>
              <td>: <?php echo $kendaraan['kode_kendaraan']; ?> </td>
              <td style="width:200px"></td>
              <td style="width:200px">Minyak Full</td>
              <td>: <?php echo $kendaraan['minyak_full']; ?> L</td>
            </tr>
            <tr>
              <td style="width:200px">Plat No</td>
              <td>: <?php echo $kendaraan['plat_no']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Jarak 1L Minyak</td>
              <td>: <?php echo $kendaraan['m_1l']; ?> KM/L</td>
            </tr>
            <tr>
              <td style="width:200px">No Mesin</td>
              <td>: <?php echo $kendaraan['no_mesin'];?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Kondisi</td>
              <td>: <?php echo $helper->kondisi($kendaraan['kondisi']); ?></td>
            </tr>
            <tr>
              <td style="width:200px">No Rangka</td>
              <td>: <?php echo $kendaraan['no_rangka']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px">Merek</td>
              <td>: <?php echo $kendaraan['merek']; ?></td>
            </tr>
            <tr>
              <td style="width:200px">Bensin</td>
              <td>: <?php echo $kendaraan['bensin']; ?></td>
              <td style="width:200px"></td>
              <td style="width:200px"></td>
              <td></td>
            </tr>
          </table>
      </div>
    </div>
</div>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblkursi" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th>Kode</th>
                      <th>Nama</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  foreach ($kursi->data('',false, $kendaraan['kode_kendaraan']) as $data) {
                ?>
                  <tr>
                      <td><?php echo $data['kode_kursi'];?></td>
                      <td><?php echo $data['nama'];?></td>
                      <td style="width:100px">
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd_sp/view/management/kendaraan-kursi/edit.php?kode_kursi=<?php echo $data['kode_kursi']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus('<?php echo $data['kode_kursi']; ?>')">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
          <form class="" id="formdelete" style="display:none" action="/tb_pbd_sp/controller/kendaraan_kursiController.php?aksi=delete" method="post">
            <input type="text" name="kode_kursi" value="" id="delete_id">
          </form>
      </div>
  </div>
</div>

<div class="text-center">
  <a href="/tb_pbd_sp/view/management/kendaraan" class="btn btn-warning waves-effect waves-light">Back</a>
</div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tblkursi').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
        {
            text: 'Tambah Kursi Kendaraan <?php echo $kendaraan['plat_no']; ?>',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd_sp/view/management/kendaraan-kursi/create.php?kode_kendaraan=<?php echo $kendaraan['kode_kendaraan']; ?>");
            }
        },
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
    function hapus(id) {
      if(confirm('yakin ingin menghapus data ini?') == true){
        document.getElementById('delete_id').value = id;
        document.getElementById('formdelete').submit();
      }
    }
  </script>
<?php endblock() ?>
