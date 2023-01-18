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
                <h3 class="card-title">Form Ubah Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <!-- Looping data kosan -->
                <?php 
                    foreach ($data_pembelian as $row) {
                        $id = $row->id;
                        $id_supplier = $row->id_supplier;
                        $id_produk = $row->id_produk; 
                        $kode_supplier = $row->kode_supplier;
                        $kode_produk = $row->kode_produk;
                        $nama_supplier = $row->nama_supplier;
                        $nama_produk = $row->nama_produk;
                        $ukuran_bouquet = $row->ukuran_bouquet; 
                        $harga_bouquet = $row->harga_bouquet;
                        $harga_pembelian = $row->harga_pembelian;
                        $jumlah = $row->jumlah;
                        $tanggal_beli = $row->tanggal_beli;
                    }
                ?>
              <!-- form start -->
              <form action="<?=base_url('pembelian/update')?>" method="post">
              <?= csrf_field() ?>
                <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2">
                      <input type="hidden" class="form-control" id="id" name="id" value="<?=$id?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Supplier</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="id_supplier" name="id_supplier" value="<?=$nama_supplier.' ('.$kode_supplier.')'?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="id_produk" name="id_produk" value="<?=$nama_produk.' ('.$kode_produk.')'?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <?php
                            //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                            if(strlen(set_value('jumlah'))>0){
                            $jumlah = set_value('jumlah');
                            }
                        ?>
                      <input type="number" class="form-control" id="jumlah" placeholder="Jumlah" name="jumlah" value="<?=$jumlah?>">
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Beli</label>
                     <div class="input-group col-sm-2">
                        <input type="text" class="form-control tanggal_beli" id="tanggal_beli" name="tanggal_beli" value="<?=$tanggal_beli?>" >
                        <span class="input-group-append">
                            <button type="button" onclick="shows()" class="btn btn-primary btn-flat"><i class="fa fa-calendar"></i></button>
                        </span>
                        <div class="invalid-feedback" id="errortanggal"></div>
                        <?php 
                        // contoh mendapatkan error per komponen
                        if(isset($validation)){
                            if($validation->getError('tanggal_beli')) {?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                    document.getElementById('tanggal_beli').setAttribute("class", "form-control is-invalid tanggal_beli");
                                    document.getElementById('errortanggal').innerHTML = "<?=$validation->getError('tanggal_beli'); ?>";
                                    // serta tambahkan div class invalid
                                </script>
                            <?php 
                            }else{
                                // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                                ?>
                                <script>
                                    // modifikasi elemen class input form untuk nama_kos menjadi is valid
                                    document.getElementById('tanggal_beli').setAttribute("class", "form-control is-valid tanggal_beli");
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
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="harga" name="harga" value="<?=$harga_bouquet?>" readonly>                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Pembelian</label>
                     <div class="col-sm-6">
                     <?php
                            //jika set value namakosan tidak kosong maka isi $nama diganti dengan isian dari user
                            if(strlen(set_value('harga_pembelian'))>0){
                            $harga_pembelian = set_value('harga_pembelian');
                            }
                        ?>
                        <input type="text" class="form-control" id="harga_pembelian" name="harga_pembelian" placeholder="Harga Pembelian" value="<?=$harga_pembelian?>" readonly>
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