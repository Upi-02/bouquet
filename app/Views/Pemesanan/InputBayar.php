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

        <!-- Awal input form  -->
        <div class="row">
          <?php
            $attributes = ['id' => 'payment-form'];
          ?>
        <?= form_open('pemesanan/prosesbayarkamar', $attributes) ?>
        <input type="hidden" id="id_pemesanan" name="id_pemesanan" value="<?= $id_pesan?>">
        <input type="hidden" id="no_kuitansi" name="no_kuitansi" value="<?= $nokuitansi?>">
        <input type="hidden" id="nama_kos" name="nama_kos" value="<?= $nama_kos?>">
        <input type="hidden" name="result_type" id="result-type" value="">
        <input type="hidden" name="result_data" id="result-data" value="">
        
                <div class="mb-3 row">
                    <label for="namakosan" class="col-sm-2 form-label">Nama Kosan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namakosan" name="namakosan" value="<?= $nama_kos?>" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kamar" class="col-sm-2 form-label">Kamar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kamar" name="kamar" value="<?= $infokamar?>" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tgl_bayar" class="col-sm-2 form-label">Tanggal Bayar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= $tanggal?>" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="hargakamar" class="col-sm-2 form-label">Harga Kamar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="hargakamar" name="hargakamar" value="<?= $harga_deal?>" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="totalbayar" class="col-sm-2 form-label">Total Bayar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="totalbayar" name="totalbayar" value="<?= $totalbayar?>" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sisa_bayar" class="col-sm-2 form-label">Sisa Bayar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sisa_bayar" name="sisa_bayar" value="<?= $sisa_bayar?>" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="besar_bayar" class="col-sm-2 form-label">Pembayaran</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="besar_bayar" name="besar_bayar" value="<?= set_value('besar_bayar')?>" placeholder="Diisi dengan besar pembayaran">
                        <div class="invalid-feedback" id="errorbesar_bayar"></div>
                    </div>
                    <?php 
                    // contoh mendapatkan error per komponen
                    if(isset($validation)){
                        if($validation->getError('besar_bayar')) {?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-invalid
                                document.getElementById('besar_bayar').setAttribute("class", "form-control is-invalid");
                                document.getElementById('errorbesar_bayar').innerHTML = "<?=$validation->getError('besar_bayar'); ?>";
                                // serta tambahkan div class invalid
                            </script>
                        <?php 
                        }else{
                            // tidak ada error di nama_kos maka nilai is-invalid dihapuskan
                            ?>
                            <script>
                                // modifikasi elemen class input form untuk nama_kos menjadi is-valid
                                document.getElementById('besar_bayar').setAttribute("class", "form-control is-valid");
                                document.getElementById('errorbesar_bayar').innerHTML = "";
                                // serta tambahkan div class is valid
                            </script>
                            <?php
                        }
                    }?>

                </div>
                <?php
                 
                    echo "<button type='submit' class='btn btn-primary'>Submit</button>";
                  
                ?>
                
            </form>
        </div>
        <!-- Akhir input form -->
     
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