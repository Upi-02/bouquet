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
              <li class="breadcrumb-item active">DataTables Pembelian</li>
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
                <div class="card-tools">
                    <a href="<?= base_url('pembelian/tambah') ?>" type="button" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>Tambah</a>
                </div>
              </div>

              
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover" id="example2">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Barang Pembelian</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Tanggal Beli</th>
                    <th>Harga Barang</th>
                    <th>Harga Pembelian</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $no = 1;  
                  foreach($data_pembelian as $row): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_supplier ?></td>
                    <td><?= $row->nama_produk ?></td>
                    <td><?= $row->keterangan ?></td>
                    <td><?= $row->jumlah ?></td>
                    <td><?= $row->tanggal_beli ?></td>
                    <td><?php echo format_rupiah($row->harga_bouquet);  ?></td>
                    <td><?php echo format_rupiah($row->harga_pembelian);  ?></td>
                    <td>
                    <a href="<?=base_url('pembelian/lihatData/'.$row->id)?>" class="btn btn-primary btn-sm">Ubah</a>
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
