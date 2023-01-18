<?php

namespace App\Controllers;

use App\Models\Peralatans; //include produk model di dalam controller

class Peralatan extends BaseController
{   
    public function index()
    {
        helper('text');

        $peralatan_model = model(Peralatans::class);
        $dataperalatan= $peralatan_model->getPeralatan();
        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('peralatan/v_peralatan',
                    [
                        'title' => 'Data Peralatan',
                        'data_peralatan' => $dataperalatan,
                    ]
                 );
        echo view('struktur/footer');
    }

    public function tambah()
    {
        $peralatan_model = model(Peralatans::class);
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[50]',
                'kode' => 'required|is_unique[peralatan_bahan.kode]',
                'harga' => 'required',
                'tanggal_beli' => 'required|exact_length[10]',
                'keterangan'  => 'required',
                ],
                [   //List Custom Pesan Error
                    'nama' => [
                        'required' => 'Nama peralatan tidak boleh kosong',
                        'min_length' => 'Panjang nama peralatan tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama peralatan tidak boleh lebih dari 50',
                    ],
                    'kode' => [
                        'required' => 'Kode peralatan tidak boleh kosong',
                        'is_unique' => 'Kode sudah ada',
                    ],
                    'keterangan' => [
                        'required' => 'Keterangan peralatan tidak boleh kosong',
                    ],
                    'harga' => [
                        'required' => 'Harga peralatan tidak boleh kosong',
                    ],
                    'tanggal_beli' => [
                        'required' => 'Tanggal peralatan tidak boleh kosong',
                        'exact_length' => 'Tanggal peralatan tidak sesuai',
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
            $peralatan_model->save([
                'nama' => $this->request->getPost('nama'),
                'kode' => strtoupper($this->request->getPost('kode')),
                'harga'  => $this->request->getPost('harga'),
                'tanggal_beli'  => $this->request->getPost('tanggal_beli'),
                'keterangan'  => $this->request->getPost('keterangan'),
            ]);

            $session = session();
            $session->setFlashdata("pesan", "Berhasil Menambahkan");
            // redirect ke daftar kosan
            return redirect()->to('peralatan');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('peralatan/v_tambah_peralatan', [
                                    'title' => 'Input Peralatan',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');        
        }
    }

    // method untuk melihat data kos berdasarkan id kos
    public function lihatData($id){
        $peralatan_model = model(Peralatans::class);
        $peralatan = $peralatan_model->getPeralatanBasedOnId($id);

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('peralatan/v_edit_peralatan',
                    [
                        'title' => 'Ubah Peralatan',
                        'data_peralatan' => $peralatan,
                    ]
                 );
        echo view('struktur/footer');                
    }

    // method untuk mengupdate data kos 
    public function update(){
        $peralatan_model = model(Peralatans::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[50]',
                'harga' => 'required',
                'tanggal_beli' => 'required',
                'keterangan'  => 'required',
                ],
                [   //List Custom Pesan Error
                    'nama' => [
                        'required' => 'Nama peralatan tidak boleh kosong',
                        'min_length' => 'Panjang nama peralatan tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama peralatan tidak boleh lebih dari 50',
                    ],
                    'keterangan' => [
                        'required' => 'Keterangan peralatan tidak boleh kosong',
                    ],
                    'harga' => [
                        'required' => 'Harga peralatan tidak boleh kosong',
                    ],
                    'tanggal_beli' => [
                        'required' => 'Tanggal peralatan tidak boleh kosong',
                    ],
                ]
            )
            )   
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $peralatan_model->updatePeralatan();

            $session = session();
            $session->setFlashdata("pesan", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('peralatan');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $peralatan = $peralatan_model->getPeralatanBasedOnId($_POST['id']);
            echo view('peralatan/v_edit_peralatan', [
                                    'title' => 'Ubah Peralatan',
                                    'data_peralatan' => $peralatan,
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
