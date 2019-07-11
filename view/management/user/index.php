<?php
include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/blank.php';

include $_SERVER['DOCUMENT_ROOT'].'/tb_pbd_sp/model/user.php';
$user = new user($conn);
?>


<?php

  if(isset($hak_akses)){
    if($hak_akses==3){
      array_push($_SESSION['pesan'],['eror','Anda Tidak Memiliki Akses Kesini']);
      header("location:/tb_pbd_sp/view/");
    }
  }

?>
<?php startblock('title') ?> Users Management <?php endblock() ?>

<?php startblock('breadcrumb-link') ?>
<li class="breadcrumb-item"><a href="#!">Users Management</a>
<?php endblock() ?>

<?php startblock('breadcrumb-title') ?>
Users Management
<?php endblock() ?>

<?php startblock('content') ?>
<div class="card">
  <div class="card-block">
      <div class="dt-responsive table-responsive">
          <table id="tableuser" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                  <tr>
                      <th style="width:20px" class="text-center">NO</th>
                      <th>Username</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th style="width:100px">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $no=0;
                  foreach ($user->data() as $data) {
                ?>
                  <tr>
                      <td style="width:20px" class="text-center"><?php echo ++$no;?></td>
                      <td><?php echo $data['username'];?></td>
                      <td><?php echo $data['nama']?></td>
                      <td><?php if($data['hak_akses'] == 1 ){echo "Admin";}elseif($data['hak_akses'] == 2){echo "Pemilik";}elseif($data['hak_akses'] == 3){echo "Peminjam";}?></td>
                      <td style="width:100px">
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="/tb_pbd_sp/view/management/user/edit.php?nik=<?php echo $data['nik']; ?>" class="btn btn-primary btn-mini waves-effect waves-light">Edit</a>
                        <?php } ?>
                        <?php if($hak_akses==1 || $hak_akses==2){ ?>
                        <a href="#" class="btn btn-danger btn-mini waves-effect waves-light" onclick="hapus('<?php echo $data['nik']; ?>')">Delete</a>
                        <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
          <form class="" id="formdelete" style="display:none" action="/tb_pbd_sp/controller/userController.php?aksi=delete" method="post">
            <input type="text" name="nik" value="" id="delete_id">
          </form>
      </div>
  </div>
</div>
<?php endblock() ?>

<?php startblock('table') ?>
  <!-- info lebih lanjut bisa di cek di : -->
  <!--editor/assets/pages/data-table/js/data-table-custom.js"-->
  <script type="text/javascript">
      $('#tableuser').DataTable(
        {
        "info":     false,
        dom: 'Bfrtip',
        buttons: [
        {
            text: 'Tambah User',
            className: 'btn-success',
            action: function(e, dt, node, config)
            {
              window.location.assign("/tb_pbd_sp/view/management/user/create.php");
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
