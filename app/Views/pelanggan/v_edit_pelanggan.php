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
                <h3 class="card-title">Form Ubah Pelanggan</h3>
              </div>
              <!-- /.card-header -->
              <!-- Looping data kosan -->
                <?php 
                    foreach ($data_pelanggan as $row) { 
                        $id = $row->id;
                        $kode = $row->kode; 
                        $nama = $row->nama; 
                        $email = $row->email; 
                        $no_tlp = $row->no_tlp; 
                        $alamat = $row->alamat; 
                    }
                ?>
              <!-- form start -->
              <form action="<?=base_url('pelanggan/update')?>" method="post">
              <?= csrf_field() ?>
                <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2">
                      <input type="hidden" class="form-control" id="id" name="id" value="<?=$id?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Pelanggan</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="kode" name="kode" value="<?=$kode?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-10">
                        <?php
                            //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                            if(strlen(set_value('nama'))>0){
                            $nama = set_value('nama');
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                     <div class="col-sm-10">
                        <?php
                            //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                            if(strlen(set_value('email'))>0){
                            $email = set_value('email');
                            }
                        ?>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?=$email?>">
                        <div class="invalid-feedback" id="erroremail"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('email')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('email').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('erroremail').innerHTML = "<?=$validation->getError('email'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('email').setAttribute("class", "form-control is-valid");
                                    document.getElementById('erroremail').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                                <?php
                            }
                        }?> 
                    </div>
                </div>
                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">No Telepon</label>
                     <div class="col-sm-10">
                        <?php
                                //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                                if(strlen(set_value('no_tlp'))>0){
                                $no_tlp = set_value('no_tlp');
                                }
                        ?>
                        <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="<?=$no_tlp?>" placeholder="No Telepon">
                        <div class="invalid-feedback" id="errortlp"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('no_tlp')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('no_tlp').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('errortlp').innerHTML = "<?=$validation->getError('no_tlp'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('no_tlp').setAttribute("class", "form-control is-valid");
                                    document.getElementById('errortlp').innerHTML = "";
                                    // serta tambahkan div class invalid
                                </script>
                                <?php
                            }
                        }?> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                     <div class="col-sm-10">
                        <?php
                                    //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                                    if(strlen(set_value('alamat'))>0){
                                    $alamat = set_value('alamat');
                                    }
                        ?>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat ..."><?= $alamat ?></textarea>
                        <div class="invalid-feedback" id="alamattlp"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('alamat')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('alamat').setAttribute("class", "form-control is-invalid");
                                    document.getElementById('alamattlp').innerHTML = "<?=$validation->getError('alamat'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('alamat').setAttribute("class", "form-control is-valid");
                                    document.getElementById('alamattlp').innerHTML = "";
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
                
                <div class="col-md-12">
                      <?php
                          if(isset($validation)){
                      ?>
                          <div class="alert alert-danger d-flex align-items-center" role="alert">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                              </svg>
                              <div>
                                  <?=$validation->listErrors();?>
                              </div>
                          </div>
                      <?php
                          }
                      ?>
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