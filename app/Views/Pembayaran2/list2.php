<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>  
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
    <title>Bayar Bouquet</title>
</head>
<body>
    <!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="<?= base_url('assets/brand/logo_bouquet.jpeg') ?>" alt="" width="30" height="24" class="d-inline-block align-top">
      Bouquet
    </a>
  </div>
</nav>


<div class="container mt-5">
    <form id="payment-form" method="post" action="<?=base_url()?>/pembayaran2/finish"> 
      <input type="hidden" name="result_type" id="result-type" value=""></div>
      <input type="hidden" name="result_data" id="result-data" value=""></div>
        
        <div class="container">
            <div class="form-group">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" readonly>
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="byr" id="byr" readonly>
               
            </div>
            <br>
            <button id="pay-button" class="btn btn-primary">Bayar</button>  
        </div>
    </form>
    <br>
    <div class='container'>
      <table class="table table-striped">
        <thead>
            <tr>
              <th scope="col">OrderId</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Jenis</th>
              <th scope="col">Waktu</th>
              <th scope="col">VA Number</th>
              <th scope="col">Status</th>
              <th scope="col">PDF</th>
            </tr>
        </thead>
        <tbody>
        <?php
          foreach($bouquet as $ks){
            ?>
              <tr>
            <?php
                  echo '<td>'.$ks->order_id.'</td>';
                  echo '<td>'.$ks->gross_amount.'</td>';
                  echo '<td>'.$ks->payment_type.'</td>';
                  echo '<td>'.$ks->transaction_time.'</td>';
                  echo '<td>'.$ks->va_number.'</td>';
                  if($ks->status_code==200){
                    echo "<td><span class='badge rounded-pill bg-primary'>Success</span></td>";
                  }elseif($ks->status_code==201){
                    echo "<td><span class='badge rounded-pill bg-warning text-dark'>Pending</span></td>";
                  }elseif($ks->status_code==202){
                    echo "<td><span class='badge rounded-pill bg-danger'>Denied</span></td>";
                  }
                  else{
                    echo "<td><span class='badge rounded-pill bg-dark'>Failure</span></td>";
                  }
                  echo "<td><a href='".$ks->pdf_url."' target='_blank' class='btn btn-success btn-sm'>Unduh</td>";

            ?>
              </tr>
          <?php
          }
        ?>
        </tbody>
      </table>
    </div>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-X_3ouQa8yOkbT11J"></script>
<script type="text/javascript">
  
    $('#pay-button').click(function (event) {
      event.preventDefault();
      $(this).attr("disabled", "disabled");
    
    var nama = $('#nama').val();
    var byr = $('#byr').val();    
    console.log('nama = '+nama);
    console.log('byr = '+byr);

    $.ajax({
      type: 'POST',  
      url: '<?=base_url()?>/pembayaran2/token',
      data : {
          nama: nama, 
          byr: byr
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

</body>
</html>