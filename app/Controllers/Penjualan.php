<?php

namespace App\Controllers;

use App\Models\Penjualans;
use App\Models\Pembayaran2Model;
//include produk model di dalam controller

class Penjualan extends BaseController
{   
    public function index()
    {
        helper('text');

        $penjualan_model = model(Penjualans::class);
        $datapenjualan= $penjualan_model->getPenjualan();

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('penjualan/v_penjualan',
                    [
                        'title' => 'Data Penjualan',
                        'data_penjualan' => $datapenjualan,
                    ]
                 );
        echo view('struktur/footer');
    }

    public function tambah()
    {
        $penjualan_model = model(Penjualans::class);
        $pelanggan = $penjualan_model->getPelanggan();
        $produk = $penjualan_model->getProduk();
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post' &&
            $this->validate([
                'id_pelanggan' => 'required',
                'id_produk' => 'required',
                'keterangan' => 'required',
                'jumlah' => 'required|greater_than[0]',
                'tanggal_jual' => 'required|exact_length[10]',
                ],
                [   //List Custom Pesan Error
                    'id_pelanggan' => [
                        'required' => 'Pelanggan tidak boleh kosong',
                    ],
                    'id_produk' => [
                        'required' => 'Produk tidak boleh kosong',
                    ],
                    'keterangan' => [
                        'required' => 'Ukuran tidak boleh kosong',
                    ],
                    'jumlah' => [
                        'required' => 'Jumlah tidak boleh kosong',
                        'greater_than' => 'Jumlah tidak boleh kosong',
                    ],
                    'tanggal_jual' => [
                        'required' => 'Tanggal penjualan tidak boleh kosong',
                        'exact_length' => 'Tanggal penjualan tidak sesuai',
                    ],
                ]
            )
            )
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            // $db = db_connect();
            // $query = $db->query("SELECT max(kode) as kodeTerbesar FROM peralatan_bahan");
            // // $data = $query->getResultArray();
            
            // foreach ($query->getResultArray() as $row) {
            //     $kodePeralatan = $row['kodeTerbesar'];
            // }
            
            // $urutan = (int) substr($kodePeralatan, 3, 6);
            // $urutan++;
            // $huruf = "PLT";
            // $kodePeralatan = $huruf . sprintf("%03s", $urutan);
            $penjualan_model->save([
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'id_produk' => $this->request->getPost('id_produk'),
                'keterangan'  => $this->request->getPost('keterangan'),
                'jumlah'  => $this->request->getPost('jumlah'),
                'tanggal_jual' =>  $this->request->getPost('tanggal_jual'),
                'harga_penjualan'  => $this->request->getPost('harga_penjualan'),
            ]);

            $session = session();
            $session->setFlashdata("pesan", "Berhasil Menambahkan");
            // redirect ke daftar kosan
            return redirect()->to('penjualan');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('penjualan/v_tambah_penjualan', [
                                    'title' => 'Input Penjualan',
                                    'validation' => $this->validator,
                                    'pelanggan' => $pelanggan,
                                    'produk' => $produk,
                                    // 'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');        
        }
    }

    // method untuk melihat data kos berdasarkan id kos
    public function lihatData($id){
        $penjualan_model = model(Penjualans::class);
        $penjualan = $penjualan_model->getPenjualanBasedOnId($id);

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('penjualan/v_edit_penjualan',
                    [
                        'title' => 'Ubah Penjualan',
                        'data_penjualan' => $penjualan,
                    ]
                 );
        echo view('struktur/footer');                
    }

    // method untuk mengupdate data kos 
    public function update(){
        $penjualan_model = model(Penjualans::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'jumlah' => 'required|greater_than[0]',
                'tanggal_jual' => 'required|exact_length[10]',
                ],
                [   //List Custom Pesan Error
                    'jumlah' => [
                        'required' => 'Jumlah tidak boleh kosong',
                        'greater_than' => 'Jumlah tidak boleh kosong',
                    ],
                    'tanggal_jual' => [
                        'required' => 'Tanggal penjualan tidak boleh kosong',
                        'exact_length' => 'Tanggal penjualan tidak sesuai',
                    ],

                ]
            )
            )   
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $penjualan_model->updatePenjualan();

            $session = session();
            $session->setFlashdata("pesan", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('penjualan');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $penjualan = $penjualan_model->getPenjualanBasedOnId($_POST['id']);
            echo view('penjualan/v_edit_penjualan', [
                                    'title' => 'Ubah Penjualan',
                                    'data_penjualan' => $penjualan,
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');               
        }
    }

    public function hapus($id){
        $db = db_connect();
        $builder = $db->table('peralatan_bahan');
        $builder->delete(['id' => $id]);
        $data = [
            'status' => 'Hapus sukses',
            'status_text' => 'Data berhasil dihapus',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }

    public function bayar($id){
        $penjualan_model = model(Penjualans::class);
        $penjualan = $penjualan_model->getPenjualanBasedOnId($id);
        $pembayaran2_model = new Pembayaran2Model();
        $data = $pembayaran2_model->getListBouquet();
    	echo view('Pembayaran2/list',[
            'bouquet' => $data,
            'data_penjualan' => $penjualan,
        ]);
    }
   
}
