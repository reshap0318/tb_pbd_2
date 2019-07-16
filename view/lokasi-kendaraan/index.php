<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/kendaraan_satker.php';
$parkir = new kendaraan_satker($conn);
?>

<?php
  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }
?>
<?php startblock('title') ?> Lokasi Kendaraan <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Lokasi Kendaraan</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Lokasi Kendaraan
<?php endblock() ?>

<?php startblock('content') ?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/view/lokasi-kendaraan/_filter.php'; ?>

<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tblparkir" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Kode</th>
                      <th>Plat No</th>
                      <th>Satker</th>
                      <th>Datang</th>
                      <th>Keluar</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  if($hak_akses==1){
                    $datas = $parkir->data('',$satkers,$plat_no,$datang,$keluar,true);
                  }else{
                    $datas = $parkir->data('',$kode_satker,$plat_no,$datang,$keluar,true);
                  }
                  foreach ($datas as $data) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['id'];?></td>
                      <td><?php echo $data['plat_no'];?></td>
                      <td><?php echo $data['satker'];?></td>
                      <td><?php echo $data['datang'];?></td>
                      <td><?php echo $data['keluar'];?></td>
                      <td style="width:100px">
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd_sp/view/lokasi-kendaraan/edit.php?kode_parkir=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){
                          if(!$data['keluar']){?>
                        <a href="/tb_pbd_sp/controller/kendaraan_satkerController.php?aksi=keluar&kode_parkir=<?php echo $data['id']; ?>" class="btn btn-warning btn-mini waves-effect waves-light">Keluar</a>
                        <?php
                            }
                          }
                        ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus('<?php echo $data['id']; ?>')">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
          <form class="" id="formdelete" style="display:none" action="/tb_pbd_sp/controller/kendaraan_satkerController.php?aksi=delete" method="post">
            <input type="text" name="kode_parkir" value="" id="delete_id">
          </form>
                </div>
            </div>
          </div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tblparkir').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
        {
            text: 'Tambah Lokasi Kendaraan',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd_sp/view/lokasi-kendaraan/create.php");
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
