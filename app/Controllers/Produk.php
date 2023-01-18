<?php

namespace App\Controllers;

use App\Models\Produks; //include produk model di dalam controller

class Produk extends BaseController
{   
    public function index()
    {
        helper('text');

        $produk = model(Produks::class);
        $dataproduk= $produk->getProduk();
        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('produk/v_produk',
                    [
                        'title' => 'Data Produk',
                        'data_produk' => $dataproduk,
                    ]
                 );
        echo view('struktur/footer');
    }

    public function tambah()
    {
        $produk_model = model(Produks::class);
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[50]',
                'kode' => 'required|is_unique[produk.kode]',
                'harga' => 'required',
                'keterangan'  => 'required',
                ],
                [   //List Custom Pesan Error
                    'nama' => [
                        'required' => 'Nama produk tidak boleh kosong',
                        'min_length' => 'Panjang nama produk tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama produk tidak boleh lebih dari 50',
                    ],
                    'kode' => [
                        'required' => 'Kode produk tidak boleh kosong',
                        'is_unique' => 'Kode sudah ada',
                    ],
                    'harga' =>[
                        'required' => 'Harga produk tidak boleh kosong'
                    ],
                    'keterangan' => [
                        'required' => 'Keterangan produk tidak boleh kosong',
                    ],
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            // $db = db_connect();
            // $query = $db->query("SELECT max(kode) as kodeTerbesar FROM produk");
            // // $data = $query->getResultArray();
            
            // foreach ($query->getResultArray() as $row) {
            //     $kodeProduk = $row['kodeTerbesar'];
            // }
            
            // $urutan = (int) substr($kodeProduk, 3, 6);
            // $urutan++;
            // $huruf = "BRG";
            // $kodeProduk = $huruf . sprintf("%03s", $urutan);
            $produk_model->save([
                'nama' => $this->request->getPost('nama'),
                'kode' =>  strtoupper($this->request->getPost('kode')),
                'harga'  => $this->request->getPost('harga'),
                'keterangan'  => $this->request->getPost('keterangan'),
            ]);

            $session = session();
            $session->setFlashdata("pesan", "Berhasil Menambahkan");
            // redirect ke daftar kosan
            return redirect()->to('produk');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('produk/v_tambah_produk', [
                                    'title' => 'Input Produk',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');        
        }
    }

    // method untuk melihat data kos berdasarkan id kos
    public function lihatData($id){
        $produk_model = model(Produks::class);
        $produk = $produk_model->getProdukBasedOnId($id);

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('produk/v_edit_produk',
                    [
                        'title' => 'Ubah Produk',
                        'data_produk' => $produk,
                    ]
                 );
        echo view('struktur/footer');                
    }

    // method untuk mengupdate data kos 
    public function update(){
        $produk_model = model(Produks::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[50]',
                'harga' => 'required',
                'keterangan'  => 'required',
                ],
                [   //List Custom Pesan Error
                    'nama' => [
                        'required' => 'Nama produk tidak boleh kosong',
                        'min_length' => 'Panjang nama produk tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama produk tidak boleh lebih dari 50',
                    ],
                    'harga' =>[
                        'required' => 'Harga produk tidak boleh kosong'
                    ],
                    'keterangan' => [
                        'required' => 'Keterangan produk tidak boleh kosong',
                    ],
                ]
            )
            )   
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $produk_model->updateProduk();

            $session = session();
            $session->setFlashdata("pesan", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('produk');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $produk = $produk_model->getProdukBasedOnId($_POST['id']);
            echo view('produk/v_edit_produk', [
                                    'title' => 'Ubah Produk',
                                    'data_produk' => $produk,
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');               
        }
    }

    public function hapus($id){
        $db = db_connect();
        $builder = $db->table('produk');
        $builder->delete(['id' => $id]);
        $data = [
            'status' => 'Hapus sukses',
            'status_text' => 'Data berhasil dihapus',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }
   
}
