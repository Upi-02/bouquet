<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= esc($title) ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables Peralatan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <!-- Tambahan Sweet Alert -->
          <?php 
            // jika session status_dml ada isinya maka tampilkan alert menggunakan sweet alert
            if(session()->has("pesan")){
              ?>
                  <script>
                      Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '<?=session("pesan");?>'
                      });
                  </script>
              <?php
            }
          ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                <div class="card-tools">
                    <a href="<?= base_url('peralatan/tambah') ?>" type="button" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>Tambah</a>
                </div>
              </div>

              
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover" id="example2">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Peralatan</th>
                    <th>Nama Peralatan</th>
                    <th>Harga</th>
                    <th>Tanggal Beli</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $no = 1;  
                  foreach($data_peralatan as $row): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kode'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?php echo format_rupiah($row['harga']);?></td>
                    <td><?= $row['tanggal_beli'] ?></td>
                    <td><?= word_limiter($row['keterangan'], 10);  ?></td>
                    <td>
                    <a href="<?=base_url('peralatan/lihatData/'.$row['id'])?>" class="btn btn-primary btn-sm">Ubah</a>
                    <button type="button" class="confirm-delete btn btn-danger btn-sm" value="<?= $row['id']; ?>">Hapus</button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Akhir Jquery Masking -->
  <script>
        $(document).ready(function(){
          $('.confirm-delete').click(function (e){
            e.preventDefault();
            var id = $(this).val();
              swal({
                title: "Apakah anda yakin?",
                text: "Setelah dihapus, Anda tidak akan dapat memulihkan file imajiner ini!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  $.ajax({
                    url: "/peralatan/hapus/"+id,
                    success: function(response) {
                      swal({
                        title: response.status,
                        text: response.status_text,
                        icon: response.status_icon,
                        buttons: "OK",
                      }).then((confirmed) => {
                          window.location.reload();
                      });
                    }
                  });
                } else {
                  // swal("Your imaginary file is safe!");
                }
              });
          });
        });
    </script>