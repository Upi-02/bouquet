<!-- Tambahan Extend Layout -->
<?= $this->extend('Templates/all');  ?>
<!-- Akhir Tambahan Extend Layout -->

<!-- Awal section konten -->
<?= $this->Section('konten');  ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Pindah Kamar Kos <?= $namakos?></h1>
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
    <p>
    <ul class="list-group list-group-horizontal">
      <?php
              $i = 1; $lantai = 0; $awal = 1;
              foreach($kamar as $row): 
                    //echo $i;
                    //menset attribut warna pada tombol, jika kosong diberi warna merah
                    if($row->status=='Kosong'){
                        $atr = "list-group-item list-group-item-danger";
                        $atr2 = "btn btn-danger btn-sm";
                        $atr3 = "btn btn-danger btn-sm";
                        $tombol = "Kamar Tujuan";
                    }elseif($row->id_kamar == $idkamar_lama){
                        $atr = "list-group-item list-group-item-success";
                        $atr2 = "btn btn-success btn-sm";
                        $atr3 = "btn btn-dark btn-sm disabled";
                        $tombol = "Kamar Asal";
                    }
                    else{
                        $atr = "list-group-item list-group-item-success";
                        $atr2 = "btn btn-success btn-sm";
                        $atr3 = "btn btn-light btn-sm disabled";
                        $tombol = "Terisi";
                    }

                    //memberi tanda garis panjang jika berbeda lantai
                    if($lantai!=$row->lantai){
                            //perkecualian pada iterasi yg pertama
                            if($i==1){
                                ?>
                                    <li class="<?= $atr?>">
                                        <b>Kamar <?= $row->nomer.' (Lt'.$row->lantai.')'?><br>
                                        <?= $row->nama?><br>
                                        <?= $row->tgl_selesai?></b><br><br>
                                        <a href="<?= base_url('pemesanan/proses_pindah/'.$idkamar_lama.'/'.$row->id_kamar.'/'.$row->id_kos.'/'.$namakos) ?>" class="<?= $atr3?>" role="button"><?=$tombol?></a>
                                    </li>
                                <?php
                                $lantai=$row->lantai;
                            }else{
                                //kalau bukan yang pertama, maka ganti baris dan ul karena beda lantai
                                $lantai=$row->lantai;
                                $i = 1;
                                ?>
                                    </ul>    <p> <hr>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="<?= $atr?>">
                                            <b>Kamar <?= $row->nomer.' (Lt'.$row->lantai.')'?><br>
                                            <?= $row->nama?><br>
                                            <?= $row->tgl_selesai?></b><br><br>
                                            <a href="<?= base_url('pemesanan/proses_pindah/'.$idkamar_lama.'/'.$row->id_kamar.'/'.$row->id_kos.'/'.$namakos) ?>" class="<?= $atr3?>" role="button"><?=$tombol?></a>
                                        </li>
                                <?php
                            }


                    }else{
                            //cek apakah sudah lebih dari 5 kalau iya dipindah ke bawah, tambah ul lagi
                            if(fmod($i,5)==0){
                        ?>
                            </ul>
                            <ul class="list-group list-group-horizontal">
                                <li class="<?= $atr?>">
                                    <b>Kamar <?= $row->nomer.' (Lt'.$row->lantai.')'?><br>
                                    <?= $row->nama?><br>
                                    <?= $row->tgl_selesai?></b><br><br>
                                    <a href="<?= base_url('pemesanan/proses_pindah/'.$idkamar_lama.'/'.$row->id_kamar.'/'.$row->id_kos.'/'.$namakos) ?>" class="<?= $atr3?>" role="button"><?=$tombol?></a>
                                </li>
                        <?php
                            }
                            else{
                                ?>
                                    <li class="<?= $atr?>">
                                        <b>Kamar <?= $row->nomer.' (Lt'.$row->lantai.')'?><br>
                                        <?= $row->nama?><br>
                                        <?= $row->tgl_selesai?></b><br><br>
                                        <a href="<?= base_url('pemesanan/proses_pindah/'.$idkamar_lama.'/'.$row->id_kamar.'/'.$row->id_kos.'/'.$namakos) ?>" class="<?= $atr3?>" role="button"><?=$tombol?></a>
                                    </li>
                                <?php
                            }
                        $i = $i + 1;
                    }
                     
                endforeach;    
              ?>		
	</ul>
    </main>
  </div>
</div>

<?= $this->endSection('konten');  ?>
<!-- Akhir section konten -->