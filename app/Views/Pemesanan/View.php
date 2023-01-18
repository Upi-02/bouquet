<!-- Tambahan Extend Layout -->
<?= $this->extend('Templates/all');  ?>
<!-- Akhir Tambahan Extend Layout -->

<!-- Awal section konten -->
<?= $this->Section('konten');  ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= esc($title) ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380" hidden></canvas>

      
      <div class="alert alert-success" role="alert">
          <?php 
            $session = session();
            echo "Selamat datang ".$session->get('user_name');
          ?>
      </div>

      <!-- Tambahan Sweet Alert -->
      <?php 
        // jika session status_dml ada isinya maka tampilkan alert menggunakan sweet alert
        if(session()->has("status_dml")){
          ?>
              <script>
                  Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?=session("status_dml");?>'
                  });
              </script>
          <?php
        }
      ?>
      
      <!-- Akhir Tambahan Sweet Alert -->

      <!-- Tambahan Alert Jika Sukses DML -->
          <?php
              if(session()->has("status_dml")){
                ?>
                <div class="row">
                  <div class="col">
                    <div class="alert alert-primary" role="alert">
                      <b><?=session("status_dml");?></b>
                    </div>
                  </div>  
                </div>  
                <?php
              }
          ?>
      <!-- Akhir Alert Jika Sukses DML -->

      <!-- Tambahan untuk card -->
      <div class="row">
      <?php
              $i = 1;
              foreach($datakosan as $row):
                if(fmod($i,3)==0){
                  ?> 
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nama']." (ID = ".$row['id_kos'].")";?>
                                      <span class="badge bg-primary rounded-pill"><?=$infokosan[$i-1][1]?></span>
                                      <span class="badge bg-success rounded-pill"><?=$infokosan[$i-1][2]?></span>
                                      <span class="badge bg-danger rounded-pill"><?=$infokosan[$i-1][3]?></span>
                                    </h5>
                                    <p class="card-text"><?= $row['alamat'].' ('.$row['telepon'].')';?>
                                    </p>
                                    
                                    <a href="<?= base_url('pemesanan/viewKamar/'.$row['id_kos'].'/'.$row['nama']) ?>" class="btn btn-primary">Pesan Kamar</a>
                                    <a href="<?= base_url('pemesanan/bayarKamar/'.$row['id_kos'].'/'.$row['nama']) ?>" class="btn btn-success">Bayar Kamar</a>
                                </div>
                            </div>
                        </div>
                        <p>
                      </div>  
                      <div class="row">
                  <?php
                }else{
                  ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nama']." (ID = ".$row['id_kos'].")";?>
                                      <span class="badge bg-primary rounded-pill"><?=$infokosan[$i-1][1]?></span>
                                      <span class="badge bg-success rounded-pill"><?=$infokosan[$i-1][2]?></span>
                                      <span class="badge bg-danger rounded-pill"><?=$infokosan[$i-1][3]?></span>
                                    </h5>
                                    <p class="card-text"><?= $row['alamat'].' ('.$row['telepon'].')';?>
                                    </p>
                                    <a href="<?= base_url('pemesanan/viewKamar/'.$row['id_kos'].'/'.$row['nama']) ?>" class="btn btn-primary">Pesan Kamar</a>
                                    <a href="<?= base_url('pemesanan/bayarKamar/'.$row['id_kos'].'/'.$row['nama']) ?>" class="btn btn-success">Bayar Kamar</a>
                                </div>
                            </div>
                        </div>

                      
                  <?php
                } 
                $i = $i + 1; 
              endforeach;    
              //echo count($koskosan);
        ?>
            </div>   
      <!-- Akhir tambahan untuk card -->

    </main>
  </div>
</div>

<?= $this->endSection('konten');  ?>
<!-- Akhir section konten -->    