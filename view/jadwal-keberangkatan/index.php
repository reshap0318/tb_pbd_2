<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/jadwal_keberangkatan.php';
$jadwal_keberangkatan = new jadwal_keberangkatan($conn);
?>

<?php
  if(isset($hak_akses)){
    if($hak_akses>3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }
?>
<?php startblock('title') ?> Jadwal keberangkatan <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Jadwal keberangkatan</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Jadwal keberangkatan
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tbkjdwl" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Kode</th>
                      <th>Tanggal</th>
                      <th>Kendaraan</th>
                      <th>Lokasi</th>
                      <th>Waktu</th>
                      <th>Satuan Kerja</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  foreach ($jadwal_keberangkatan->data('','','','','',$kode_satker,true) as $data) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['kode_pemesanan'];?></td>
                      <td><?php echo $data['tanggal'];?></td>
                      <td><?php echo $data['plat_no'];?></td>
                      <td><?php echo $data['lokasi'];?></td>
                      <td><?php echo $data['waktu_mulai'].' - '.$data['waktu_sampai'].' #'.$helper->hari($data['hari']);?></td>
                      <td><?php echo $data['satker'];?></td>
                      <td style="width:100px">
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd_sp/view/jadwal-keberangkatan/edit.php?kode_pemesanan=<?php echo $data['kode_pemesanan']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2 || $hak_akses==3){ ?>
                        <a href="/tb_pbd_sp/view/detail-keberangkatan/index.php?kode_pemesanan=<?php echo $data['kode_pemesanan']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Detail</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus('<?php echo $data['kode_pemesanan']; ?>')">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
          <form class="" id="formdelete" style="display:none" action="/tb_pbd_sp/controller/jadwal_keberangkatanController.php?aksi=delete" method="post">
            <input type="text" name="kode_pemesanan" value="" id="delete_id">
          </form>
                </div>
            </div>
          </div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tbkjdwl').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
      <?php if($hak_akses==1 || $hak_akses==2){ ?>
        {
            text: 'Tambah Jadwal keberangkatan',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd_sp/view/jadwal-keberangkatan/create.php");
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
    function hapus(id) {
      if(confirm('yakin ingin menghapus data ini?') == true){
        document.getElementById('delete_id').value = id;
        document.getElementById('formdelete').submit();
      }
    }
  </script>
<?php endblock() ?>
