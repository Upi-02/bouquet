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
                <h3 class="card-title">Form Tambah Penjualan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?=base_url('penjualan/tambah')?>" method="post" novalidate>
                <div class="card-body">
                <div class="form-group row">
                <label for="id_penghuni" class="col-sm-2 col-form-label">Pilih Pelanggan</label>
                  <div class="col-sm-3">
                        <select class="form-control" aria-label="Default select example" id="id_pelanggan" name="id_pelanggan">
                        
                        <option value="" selected disabled>--Pilih Pelanggan--</option>
                            <?php
                                //looping penghuni
                                foreach($pelanggan as $row):
                                    $id_pelanggan = $row->id;
                                    $nama = $row->nama;
                                    $kode = $row->kode;
                                    if(set_value('id_pelanggan')==$id_pelanggan){
                                      ?>
                                        <option value="<?= $id_pelanggan ?>" selected><?= $nama.' ('.$kode.')'?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_pelanggan ?>"><?= $nama.' ('.$kode.')' ?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback" id="errorpelanggan"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('id_pelanggan')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('id_pelanggan').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorpelanggan').innerHTML = "<?=$validation->getError('id_pelanggan'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_pelanggan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorpelanggan').innerHTML = "";
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
                        <select class="form-control" aria-label="Default select example" id="id_produk" name="id_produk">
                        <option value="" selected disabled>--Pilih Produk--</option>
                            <?php
                                //looping penghuni
                                foreach($produk as $row):
                                    $id_produk = $row->id;
                                    $nama = $row->nama;
                                    $kode = $row->kode;
                                    $harga = $row->harga;
                                    if(set_value('id_produk')==$id_produk){
                                      ?>
                                        <option value="<?= $id_produk ?>" selected><?= $nama.' ('.$kode.')'?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_produk ?>"><?= $nama.' ('.$kode.')'?></option>
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
                                    document.getElementById('id_produk').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorproduk').innerHTML = "<?=$validation->getError('id_produk'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('id_produk').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorproduk').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                <label for="id_produk" class="col-sm-2 col-form-label">Pilih Ukuran</label>
                  <div class="col-sm-3">
                        <select class="form-control" aria-label="Default select example" id="keterangan" name="keterangan">
                        <option value="" selected disabled>--Pilih Ukuran--</option>
                            <option value="Kecil">Kecil</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Besar">Besar</option>                 
                        </select>
                        <div class="invalid-feedback" id="errorketerangan"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('keterangan')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('keterangan').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorketerangan').innerHTML = "<?=$validation->getError('keterangan'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('keterangan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorketerangan').innerHTML = "";
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Jual</label>
                     <div class="input-group col-sm-2">
                        <input type="date" class="form-control tanggal_jual" id="tanggal_jual" name="tanggal_jual" value="<?= set_value('tanggal_jual')?>">
                        <span class="input-group-append">
                            <button type="button" onclick="shows()" class="btn btn-primary btn-flat"><i class="fa fa-calendar"></i></button>
                        </span>
                        <div class="invalid-feedback" id="errortanggal"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('tanggal_jual')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('tanggal_jual').setAttribute("class", "form-control is-invalid tanggal_jual");
                                    document.getElementById('errortanggal').innerHTML = "<?=$validation->getError('tanggal_jual'); ?>";

                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('tanggal_jual').setAttribute("class", "form-control is-valid tanggal_jual");
                                    document.getElementById('errortanggal').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                                <?php
                            }
                        }?> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Bouquet</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= set_value('harga')?>" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Penjualan</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" id="harga_penjualan" name="harga_penjualan" placeholder="Harga Penjualan" value="<?= set_value('harga_penjualan')?>"required readonly>
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
