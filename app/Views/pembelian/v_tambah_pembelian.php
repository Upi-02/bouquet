<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=base_url('pembelian/tambah')?>" method="post" novalidate>
                <div class="card-body">
                <div class="form-group row">
                <label for="id_penghuni" class="col-sm-2 col-form-label">Pilih Supplier</label>
                  <div class="col-sm-3">
                        <select class="form-control" aria-label="Default select example" id="id_supplier" name="id_supplier">
                        
                        <option value="" selected disabled>--Pilih supplier--</option>
                            <?php
                                //looping supplier
                                foreach($supplier as $row):
                                    $id_supplier = $row->id;
                                    $nama = $row->nama;
                                    $kode = $row->kode;
                                    if(set_value('id_supplier')==$id_supplier){
                                      ?>
                                        <option value="<?= $id_supplier ?>" selected><?= $nama.' ('.$kode.')'?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_supplier ?>"><?= $nama.' ('.$kode.')' ?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback" id="errorsupplier"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_supplier')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_supplier').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorsupplier').innerHTML = "<?=$validation->getError('id_supplier'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_supplier').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorsupplier').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                <label for="id_produk" class="col-sm-2 col-form-label">Pilih Produk</label>
                  <div class="col-sm-3">
                        <select class="form-control" aria-label="Default select example" id="id_produk_belian" name="id_produk">
                        <option value="" selected disabled>--Pilih Produk--</option>
                            <?php
                                //looping produk
                                foreach($produk as $row):
                                    $id_produk = $row->id;
                                    $nama = $row->nama;
                                    $kode = $row->kode;
                                    $harga = $row->harga;
                                    $keterangan = $row->keterangan;
                                    if(set_value('id_produk')==$id_produk){
                                      ?>
                                        <option value="<?= $id_produk ?>" selected><?= $nama.' ('.$keterangan.')'?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_produk ?>"><?= $nama.' ('.$keterangan.')'?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback" id="errorproduk"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_produk')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_produk_belian').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorproduk').innerHTML = "<?=$validation->getError('id_produk'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_produk_belian').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorproduk').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah</label>
                     <div class="col-sm-6">
                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="<?= set_value('jumlah')?>">
                        <div class="invalid-feedback" id="errorjumlah"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('jumlah')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('jumlah').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorjumlah').innerHTML = "<?=$validation->getError('jumlah'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('jumlah').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorjumlah').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                    </div>
                    <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal_beli" placeholder="" name="tanggal_beli" value="">
                    <div class="invalid-feedback" id="errortanggal_beli"></div>
                    <?php
                    // contoh mendapatkan error per komponen
                    if(isset($validation)){
                      if($validation->getError('tanggal_beli')) {?>
                          <script>
                              // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                              document.getElementById('tanggal_beli').setAttribute("class", "form-control is-invalid");
                              document.getElementById('errortanggal_beli').innerHTML = "<?=$validation->getError('tanggal_beli'); ?>";
                              // serta tambahkan div class invalid
                          </script>
                      <?php 
                      }else{
                          // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                          ?>
                          <script>
                              // modifikasi elemen class input form untuk nama_kos menjadi is valid
                              document.getElementById('tanggal_beli').setAttribute("class", "form-control is-valid");
                              document.getElementById('errortanggal_beli').innerHTML = "";
                              // serta tambahkan div class invalid
                          </script>
                          <?php
                      }
                  } ?>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Bouquet</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= set_value('harga')?>" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Pembelian</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="harga_pembelian" name="harga_pembelian" placeholder="Harga pembelian" value="<?= set_value('harga_penjualan')?>" required readonly>
                    </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
