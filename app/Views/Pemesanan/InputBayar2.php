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

        <!-- Awal dari from button pay midtrans -->
        <div class="row">
          <?php
            $attributes = ['id' => 'payment-form'];
          ?>
        <?= form_open('pemesanan/finishingPembayaranPG', $attributes) ?>
        <input type="hidden" name="result_type" id="result-type" value="">
        <input type="hidden" name="result_data" id="result-data" value="">
        <input type="hidden" name="id_pemesanan" id="id_pemesanan" value="<?=$id_pesan?>">
        <input type="hidden" name="id_kos" id="id_kos" value="<?=$id_kos?>">
        <input type="hidden" name="besar_bayar" id="besar_bayar" value="<?=$besar_bayar?>">

              <button id="pay-button" class="btn btn-primary">Bayar</button>  
            </form>
        </div>
        <!-- Akhir dari form button pay midtrans -->
     
    </main>
  </div>
</div>

<!-- Tambahan Script Midtrans -->
    <!-- Bootstrap JS -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="<?= base_url('dashboard/dashboard.js') ?>"></script>
    
        <script>
            $(document).ready(function(){
                // Format mata uang.
                $('#besar_bayar').mask('0,000,000,000,000,000', {reverse: true});			
                
            })
        </script> 

    <!-- Javascript Payment Gateway -->
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <?php
        // jika sdh diset
        //if(isset($snapToken)){
        ?>
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<<APP CLIENT ANDA>>"></script>
            <script type="text/javascript">
    
                $('#pay-button').click(function (event) {
                event.preventDefault();
                $(this).attr("disabled", "disabled");
                
                var idpesan = "<?=$id_pesan?>";
                var besar_bayar = "<?=$besar_bayar?>";    

                $.ajax({
                type: 'POST',  
                url: '<?=base_url()?>/pemesanan/buattoken/'+idpesan+'/'+besar_bayar,
                data : {
                    idpesan: idpesan, 
                    besar_bayar: besar_bayar
                },
                cache: false,

                success: function(data) {
                    //location = data;

                    console.log('token = '+data);
                    
                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type,data){
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {
                    
                    onSuccess: function(result){
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result){
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result){
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                    });
                }
                });
            });

    </script>
<!-- Akhir tambahan script midtrans -->


<?= $this->endSection('konten');  ?>
<!-- Akhir section konten -->