<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan.php';
$kendaraan = new kendaraan($conn);
?>

<?php
  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }
?>
<?php startblock('title') ?> Kendaraan Management <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Kendaraan Management</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Kendaraan Management
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblkendaraan" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th>Kode</th>
                      <th>Plat No</th>
                      <th>Full (L)</th>
                      <th>1L/Meter</th>
                      <th>Kondisi</th>
                      <th>Merek</th>
                      <th>Bensin</th>
                      <th>Sopir</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  foreach ($kendaraan->data() as $data) {
                ?>
                  <tr>
                      <td><?php echo $data['kode_kendaraan'];?></td>
                      <td><?php echo $data['plat_no'];?></td>
                      <td><?php echo $data['minyak_full'];?></td>
                      <td><?php echo $data['m_1l'];?></td>
                      <td><?php echo $data['kondisi'];?></td>
                      <td><?php echo $data['kode_merek'];?></td>
                      <td><?php echo $data['kode_bensin'];?></td>
                      <td><?php echo $data['nik'];?></td>
                      <td style="width:100px">
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd_sp/view/management/kendaraan/edit.php?kode_kendaraan=<?php echo $data['kode_kendaraan']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd_sp/view/management/kendaraan/edit.php?kode_kendaraan=<?php echo $data['kode_kendaraan']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Kursi</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus('<?php echo $data['kode_kendaraan']; ?>')">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
          <form class="" id="formdelete" style="display:none" action="/tb_pbd_sp/controller/kendaraanController.php?aksi=delete" method="post">
            <input type="text" name="kode_kendaraan" value="" id="delete_id">
          </form>
                </div>
            </div>
          </div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tblkendaraan').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
        {
            text: 'Tambah Kendaraan',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd_sp/view/management/kendaraan/create.php");
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
