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
              <li class="breadcrumb-item active">DataTables Penjualan</li>
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
                    <a href="<?= base_url('penjualan/tambah') ?>" type="button" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>Tambah</a>
                </div>
              </div>

              
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover" id="example2">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Barang Penjualan</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Tanggal Jual</th>
                    <th>Harga Barang</th>
                    <th>Harga Penjualan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $no = 1;  
                  foreach($data_penjualan as $row): ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_pelanggan ?></td>
                    <td><?= $row->nama_produk ?></td>
                    <td><?= $row->ukuran_bouquet ?></td>
                    <td><?= $row->jumlah ?></td>
                    <td><?= $row->tanggal_jual ?></td>
                    <td><?php echo format_rupiah($row->harga_bouquet);  ?></td>
                    <td><?php echo format_rupiah($row->harga_penjualan);  ?></td>
                    <td>
                    <a href="<?=base_url('penjualan/lihatData/'.$row->id)?>" class="btn btn-primary btn-sm">Ubah</a>
                    <a href="<?=base_url('penjualan/bayar/'.$row->id)?>" class="btn btn-primary btn-sm">Bayar</a>
                    <!-- <a href="<?=base_url('pembayaran2/index')?>" class="btn btn-primary btn-sm">Bayar</a> -->
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
