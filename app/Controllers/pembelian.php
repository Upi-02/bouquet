<?php

namespace App\Controllers;

use App\Models\pembelians;
//include produk model di dalam controller

class Pembelian extends BaseController
{   
    public function index()
    {
        helper('text');

        $pembelian_model = model(Pembelians::class);
        $datapembelian= $pembelian_model->getPembelian();

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('pembelian/v_pembelian',
                    [
                        'title' => 'Data Pembelian',
                        'data_pembelian' => $datapembelian,
                    ]
                 );
        echo view('struktur/footer');
    }

    public function tambah()
    {
        $pembelian_model = model(Pembelians::class);
        $supplier = $pembelian_model->getSupplier();
        $produk = $pembelian_model->getProduk();
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post' &&
            $this->validate([
                'id_supplier' => 'required',
                'id_produk' => 'required',
                'jumlah' => 'required',
                'tanggal_beli' => 'required',
                ],
                [   //List Custom Pesan Error
                    'id_supplier' => [
                        'required' => 'Supplier tidak boleh kosong',
                    ],
                    'id_produk' => [
                        'required' => 'Produk tidak boleh kosong',
                    ],
                    'keterangan' => [
                        'required' => 'Ukuran tidak boleh kosong',
                    ],
                    'jumlah' => [
                        'required' => 'Jumlah tidak boleh kosong',
                    ],
                    'tanggal_beli' => [
                        'required' => 'Tanggal pembelian tidak boleh kosong',
                        'exact_length' => 'Tanggal pembelian tidak sesuai',
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
            $pembelian_model->save([
                'id_supplier' => $this->request->getPost('id_supplier'),
                'id_produk' => $this->request->getPost('id_produk'),
                'jumlah'  => $this->request->getPost('jumlah'),
                'tanggal_beli' =>  $this->request->getPost('tanggal_beli'),
                'harga_pembelian'  => $this->request->getPost('harga_pembelian'),
            ]);

            $session = session();
            $session->setFlashdata("pesan", "Berhasil Menambahkan");
            // redirect ke daftar kosan
            return redirect()->to('pembelian');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('pembelian/v_tambah_pembelian', [
                                    'title' => 'Input Pembelian',
                                    'validation' => $this->validator,
                                    'supplier' => $supplier,
                                    'produk' => $produk,
                                    // 'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');        
        }
    }

    // method untuk melihat data kos berdasarkan id kos
    public function lihatData($id){
        $pembelian_model = model(pembelians::class);
        $pembelian = $pembelian_model->getPembelianBasedOnId($id);

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('pembelian/v_edit_pembelian',
                    [
                        'title' => 'Ubah pembelian',
                        'data_pembelian' => $pembelian,
                    ]
                 );
        echo view('struktur/footer');                
    }

    // method untuk mengupdate data kos 
    public function update(){
        $pembelian_model = model(pembelians::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'jumlah' => 'required',
                'tanggal_beli' => 'required|exact_length[10]',
                ],
                [   //List Custom Pesan Error
                    'jumlah' => [
                        'required' => 'Jumlah tidak boleh kosong',
                    ],
                    'tanggal_beli' => [
                        'required' => 'Tanggal pembelian tidak boleh kosong',
                        'exact_length' => 'Tanggal pembelian tidak sesuai',
                    ],
                ]
            )
            )   
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $pembelian_model->updatePembelian();

            $session = session();
            $session->setFlashdata("pesan", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('pembelian');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $pembelian = $pembelian_model->getPembeliannBasedOnId($_POST['id']);
            echo view('pembelian/v_edit_pembelian', [
                                    'title' => 'Ubah pembelian',
                                    'data_pembelian' => $pembelian,
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
   
}
