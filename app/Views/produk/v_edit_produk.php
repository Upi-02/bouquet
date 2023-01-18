<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ubah Data</li>
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
                <h3 class="card-title">Form Ubah Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- Looping data kosan -->
                <?php 
                    foreach ($data_produk as $row) {
                        $id = $row->id;
                        $kode = $row->kode; 
                        $nama = $row->nama; 
                        $harga = $row->harga; 
                        $keterangan = $row->keterangan;
                    }
                ?>
              <!-- form start -->
              <form action="<?=base_url('produk/update')?>" method="post">
              <?= csrf_field() ?>
                <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2">
                      <input type="hidden" class="form-control" id="id" name="id" value="<?=$id?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Produk</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="kode" name="kode" value="<?=$kode?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <?php
                            //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                            if(strlen(set_value('nama'))>0){
                            $nama_kos = set_value('nama');
                            }
                        ?>
                      <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?=$nama?>">
                      <div class="invalid-feedback" id="errornama"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('nama')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('nama').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errornama').innerHTML = "<?=$validation->getError('nama'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                    document.getElementById('nama').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errornama').innerHTML = "";
                                    // serta tambahkan div class is valid
                                </script>
                                <?php
                            }
                        }?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga</label>
                     <div class="col-sm-10">
                        <?php
                            //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                            if(strlen(set_value('harga'))>0){
                            $email = set_value('harga');
                            }
                        ?>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?=$harga?>">
                        <div class="invalid-feedback" id="errorharga"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('harga')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('harga').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errorharga').innerHTML = "<?=$validation->getError('harga'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('harga').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorharga').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                                <?php
                            }
                        }?> 
                    </div>
                </div>
                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                     <div class="col-sm-10">
                        <?php
                                    //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                                    if(strlen(set_value('keterangan'))>0){
                                    $alamat = set_value('keterangan');
                                    }
                        ?>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan ..."><?= $keterangan ?></textarea>
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
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('keterangan').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errorketerangan').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                                <?php
                            }
                        }?>
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