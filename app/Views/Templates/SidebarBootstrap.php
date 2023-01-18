<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>

          <?php 
             $session = session();
             if($session->get('kelompok')!='analis')
             {
          ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span data-feather="database"></span>
                        Masterdata
                        </a>
                        <ul class="ms-3 dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="<?=base_url('kos/view')?>">Kosan</a></li>
                          <li><a class="dropdown-item" href="<?=base_url('penghuni/view2')?>">Penghuni</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span data-feather="shopping-cart"></span>
                        Transaksi
                        </a>
                        <ul class="ms-3 dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="<?=base_url('pemesanan/view')?>">Pemesanan</a></li>
                          <li><a class="dropdown-item" href="<?=base_url('pemesanan/view')?>">Pembayaran</a></li>
                          <li><a class="dropdown-item" href="<?=base_url('pembayaran')?>">Pembayaran</a></li>
                          <li><a class="dropdown-item" href="<?=base_url('pemodalan/view')?>">Pemodalan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span data-feather="file"></span>
                        Laporan
                        </a>
                        <ul class="ms-3 dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="<?=base_url('laporan/bukubesar')?>">Buku Besar</a></li>
                          <li><a class="dropdown-item" href="<?=base_url('laporan/jurnalumum')?>">Jurnal Umum</a></li>
                          <li><a class="dropdown-item" href="<?=base_url('laporan/viewKuitansi')?>">Kuitansi</a></li>
                          <li><a class="dropdown-item" href="<?= base_url('laporan/viewDtSiswa') ?>">Siswa</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span data-feather="pie-chart"></span>
                        Grafik
                        </a>
                        <ul class="ms-3 dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="<?=base_url('grafik/batang')?>">Batang</a></li>
                          <li><a class="dropdown-item" href="<?=base_url('grafik/pie')?>">Pie Chart</a></li>
                          <li><a class="dropdown-item" href="<?=base_url('grafik/line')?>">Line Chart</a></li>
                        </ul>
                    </li>

          <?php 
              }
              else if($session->get('kelompok')=='analis')
              {
              ?>
                    <li class="nav-item">
                      <a class="nav-link" href="#">
                        <span data-feather="bar-chart"></span>
                        Analisis Data
                      </a>
                    </li>
              <?php
              }
          ?>

                  <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/berita')?>">
                        <span data-feather="camera"></span>
                        Berita
                      </a>
                    </li>

        </ul>
        

      </div>
    </nav>