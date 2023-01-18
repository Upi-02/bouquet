<!-- Tambahan Extend Layout -->
<?= $this->extend('Templates/all');  ?>
<!-- Akhir Tambahan Extend Layout -->

<!-- Awal section konten -->
<?= $this->Section('konten');  ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Pembayaran Kosan: <?= $namakos;?>, Lantai: <?= $lantai;?>, Kamar: <?= $nomer;?></h1>
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

        <div class="row">
        <?= form_open('pemesanan/add/'.$id_kamar.'/'.$namakos) ?>
        <input type="hidden" id="id_kamar" name="id_kamar" value="<?= $id_kamar?>">
        <input type="hidden" id="namakos" name="namakos" value="<?= $namakos?>">
        <input type="hidden" id="idkos" name="idkos" value="<?= $id?>">


        
                <div class="mb-3 row">
                <label for="id_penghuni" class="col-sm-2 col-form-label">Pilih Penghuni</label>
                  <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="id_penghuni" name="id_penghuni">
                            <?php
                                //looping penghuni
                                foreach($penghuni as $row):
                                    $id_penghuni = $row->id;
                                    $nama = $row->nama;
                                    $ktp = $row->ktp;
                                    if(set_value('id_penghuni')==$id_penghuni){
                                      ?>
                                        <option value="<?= $id_penghuni ?>" selected><?= $nama.' ('.$ktp.')'?></option>
                                      <?php
                                    }else{
                                      ?>
                                        <option value="<?= $id_penghuni ?>"><?= $nama.' ('.$ktp.')' ?></option>
                                      <?php
                                    }
                                endforeach;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                  <label for="jenis_kos" class="col-sm-2 col-form-label">Tanggal Mulai Kos</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="<?= set_value('tgl_mulai')?>" placeholder="Diisi dengan tanggal" onchange="myFunction()">
                    <div class="invalid-feedback" id="errortgl_mulai"></div>            
                  </div>
                </div>      

                <?php 
                    // contoh mendapatkan error per komponen tanggal mulai
                    if(isset($validation)){
                        if($validation->getError('tgl_mulai')) {?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_mulai menjadi is-invalid
                                document.getElementById('tgl_mulai').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errortgl_mulai').innerHTML = "<?=$validation->getError('tgl_mulai'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php 
                        }else{
                            // tidak ada error di tgl_mulai maka nilai is-invalid dihapuskan
                            ?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_mulai menjadi is-valid
                                document.getElementById('tgl_mulai').setAttribute("class", "form-control is-valid");
                                document.getElementById('errortgl_mulai').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                            <?php
                        }
                    }?>
                
                <div class="mb-3 row">
                  <label for="jenis_kos" class="col-sm-2 col-form-label">Tanggal Selesai Kos</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="<?= set_value('tgl_selesai')?>" readonly>
                  </div>
                </div> 

                <div class="mb-3 row">
                  <label for="jenis_kos" class="col-sm-2 col-form-label">Jangka Waktu Kos</label>
                  <div class="col-sm-10">
                      <select class="form-select" aria-label="Default select example" id="durasi" name="durasi" onchange="myFunction()">
                          <?php
                              $l1=""; $l2 = ""; $l3 = "";
                              if(set_value('durasi')==1){$l3="selected";}
                              elseif(set_value('durasi')==6){$l2="selected";}
                              else{$l1="selected";}
                          ?>
                          <option value="1" <?= $l3 ?>>1 Bulan</option>
                          <option value="6" <?= $l2 ?>>6 Bulan</option>
                          <option value="12"<?= $l1 ?>>12 Bulan</option>
                      </select>  
                  </div>
                </div> 

                <div class="mb-3 row">
                  <label for="jenis_kos" class="col-sm-2 col-form-label">Harga Awal</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga_awal" name="harga_awal" value="<?= number_format($harga)?>" readonly>
                  </div>
                </div>          
                
                <div class="mb-3 row">
                  <label for="jenis_kos" class="col-sm-2 col-form-label">Harga Jadi</label>
                  <div class="col-sm-10">
                   <input type="text" class="form-control" id="harga_deal" name="harga_deal" onchange="myFunction()" placeholder="Diisi harga kesepakatan">
                   <div class="invalid-feedback" id="errorharga_deal"></div> 
                  </div>
                </div> 

                <?php 
                    // contoh mendapatkan error per komponen harga_deal
                    if(isset($validation)){
                        if($validation->getError('harga_deal')) {?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_mulai menjadi is-invalid
                                document.getElementById('harga_deal').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errorharga_deal').innerHTML = "<?=$validation->getError('harga_deal'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php 
                        }else{
                            // tidak ada error di harga_deal maka nilai is-invalid dihapuskan
                            ?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_mulai menjadi is-valid
                                document.getElementById('harga_deal').setAttribute("class", "form-control is-valid");
                                document.getElementById('errorharga_deal').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                            <?php
                        }
                    }?>

                <div class="mb-3 row">
                  <label for="jenis_kos" class="col-sm-2 col-form-label">Pembayaran DP/Pelunasan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="besar_bayar" name="besar_bayar" value="<?= set_value('besar_bayar')?>" onchange="myFunction()" placeholder="Diisi dengan besar pembayaran">
                    <div class="invalid-feedback" id="errorbesar_bayar"></div> 
                  </div>
                </div>                 

                <?php 
                    // contoh mendapatkan error per komponen besar_bayar
                    if(isset($validation)){
                        if($validation->getError('besar_bayar')) {?>
                            <script>
                                // modifikasi elemen class input form untuk besar_bayar menjadi is-invalid
                                document.getElementById('besar_bayar').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errorbesar_bayar').innerHTML = "<?=$validation->getError('besar_bayar'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php 
                        }else{
                            // tidak ada error di besar_bayar maka nilai is-invalid dihapuskan
                            ?>
                            <script>
                                // modifikasi elemen class input form untuk tgl_mulai menjadi is-valid
                                document.getElementById('besar_bayar').setAttribute("class", "form-control is-valid");
                                document.getElementById('errorbesar_bayar').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                            <?php
                        }
                    }?>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

     
    </main>
  </div>
</div>


<script>
        //untuk fungsi number format di javascript
        function number_format (number, decimals, decPoint, thousandsSep) { 
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''

            var toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec)
                return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || ''
                s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }

        //fungsi untuk mengganti nilai sesuai dengan pilihan user
        function myFunction(){
            //memilih elemen 
            var tgl_selesai = document.getElementById("tgl_selesai"); 
            var tgl_awal = document.getElementById("tgl_mulai"); 
            var tgl_selesai2 = document.getElementById("tgl_selesai2");
            var durasi = document.getElementById("durasi").value; //mengambil elemen durasi
            var harga_awal = document.getElementById("harga_awal"); //mengambil elemen harga_awal

            //menghilangkan karakter selian numerik
            //harga_awal_bersih =harga_awal.value.replaceAll(".", "");
            harga_awal_bersih = "<?php echo $harga; ?>";

            var pembagi = 1;
            if(Number(durasi)==6){
              pembagi = 2; //harga per tahun dibagi 2
            }else if(Number(durasi)==1){
              pembagi = 12; //harga per tahun dibagi 12
            }

            //membagi harga dasar dengan pembagi
            harga_awal.setAttribute("value", number_format(Math.round(harga_awal_bersih/pembagi)) );
            harga_awal.innerHTML = harga_awal_bersih/pembagi;

            //menambahkan nilai penambahan tanggal awal dengan durasi yang dipilih lalu diisikan sbg atribut value di input form tgl_selesai
            var dt = new Date(tgl_awal.value); 
            dt.setMonth( dt.getMonth() + Number(durasi) );
            tgl_selesai.setAttribute("value", dt.toISOString().substring(0, 10)); 



            //mengambil substring dari hasil toISOString berupa string 2021-09-05T00:00:00.000Z

            //var idx = document.getElementById("idx");
            //idx.innerHTML = dt.toISOString();
            //idx.innerHTML = durasi;
        }
</script>

<?= $this->endSection('konten');  ?>
<!-- Akhir section konten -->