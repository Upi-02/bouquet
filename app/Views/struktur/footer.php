<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


 


<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('plugins/chart.js/Chart.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('plugins/sparklines/sparkline.js')?>"></script>
<!-- JQVMap -->
<script src="<?= base_url('plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?= base_url('plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('plugins/jquery-knob/jquery.knob.min.js')?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('plugins/moment/moment.min.js')?>"></script>
<!-- datetimepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<!-- Summernote -->
<script src="<?= base_url('plugins/summernote/summernote-bs4.min.js')?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('dist/js/adminlte.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('dist/js/demo.js') ?> "></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('dist/js/pages/dashboard.js') ?>"></script>
<!-- Jquery Masking -->
<script src="<?= base_url('jquery/jquery.mask.js')?>"></script>
<script>
  $(function() {

    var total_amount = function() {
      var sum = 0;
      var harga = $('#harga').val();
      $('#jumlah').each(function() {
        var jumlah = $(this).val();
        if (jumlah != 0) {
          sum = jumlah * harga;
        }else if(jumlah == 0) {
          sum = "Jumlah Tidak Boleh Kosong";
        }
      });

      $('#harga_penjualan').val(sum);
      $('#harga_pembelian').val(sum);
      
      
    }

    $('#jumlah').keyup(function(){
      total_amount();
    })
    
  })
</script>
<script>
  $('#id_produk').on('change', (event) => {
      getProduk(event.target.value).then(barang => {
          $('#harga').val(barang.harga);
      });
  });
  $('#id_produk_belian').on('change', (event) => {
      getBelian(event.target.value).then(barang => {
          $('#harga').val(barang.harga);
      });
  });


  async function getProduk(id) {
    let response = await fetch('api/penjualan/'+id);
    let data = await response.json();

    return data;
  }
  async function getBelian(id) {
    let response = await fetch('api/pembelian/'+id);
    let data = await response.json();

    return data;
  }

</script>
<script>
  function show(){
    $(".tanggal_beli").datepicker({
      format: "yyyy-dd-mm",
      autoclose:true,
      isDisabled:true,
    });
    $(".tanggal_beli").datepicker('show');
  }
</script>
      
      <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
 <!-- Awal Masking -->
 <script>
        $(document).ready(function(){
          // Format mata uang.
          $('#no_tlp').mask('0000-0000-0000', {reverse: true});		
        })
	</script>
    <!-- Akhir Masking -->
</body>
</html>
