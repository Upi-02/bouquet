<?php

namespace App\Controllers;

use App\Models\Akuns; //include akun model di dalam controller

class Akun extends BaseController
{
    public function index()
    {
        $akun = model(Akuns::class);
        $dataakun = $akun->getAkun();
        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('akun/v_akun',
                    [
                        'title' => 'Data Akun',
                        'data_akun' => $dataakun,
                    ]
                 );
        echo view('struktur/footer');
    }

    public function tambah()
    {
        $akun_model = model(Akuns::class);
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'kode' => 'required|numeric',
                'nama' => 'required',
                'header'  => 'required|numeric',
                ],
                [   //List Custom Pesan Error
                    'kode' => [
                        'required' => 'Kode akun tidak boleh kosong',
                        'numeric' => 'Kode akun harus angka',
                    ],
                    'nama' =>[
                        'required' => 'Nama akun tidak boleh kosong'
                    ],
                    'header' => [
                        'required' => 'Header akun tidak boleh kosong',
                        'numeric' => 'Header akun harus angka',
                    ],
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database}
            $akun_model->save([
                'kode' => $this->request->getPost('kode'),
                'nama' => $this->request->getPost('nama'),
                'header'  => $this->request->getPost('header'),
            ]);

            $session = session();
            $session->setFlashdata("pesan", "Berhasil Menambahkan");
            // redirect ke daftar kosan
            return redirect()->to('akun');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('akun/v_tambah_akun', [
                                    'title' => 'Input Akun',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');        
        }
    }
    public function lihatData($id){
        $akun_model = model(Akuns::class);
        $akun_model = $akun_model->getAkunBasedOnId($id);

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('akun/v_edit_akun',
                    [
                        'title' => 'Ubah Akun',
                        'data_akun' => $akun_model,
                    ]
                 );
        echo view('struktur/footer');                
    }

    // method untuk mengupdate data kos 
    public function update(){
        $akun_model = model(Akuns::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'kode' => 'required|numeric',
                'nama' => 'required',
                'header'  => 'required|numeric',
                ],
                [   //List Custom Pesan Error
                    'kode' => [
                        'required' => 'Kode akun tidak boleh kosong',
                        'numeric' => 'Kode akun harus angka',
                    ],
                    'nama' =>[
                        'required' => 'Nama akun tidak boleh kosong'
                    ],
                    'header' => [
                        'required' => 'Header akun tidak boleh kosong',
                        'numeric' => 'Header akun harus angka',
                    ],
                ]
            )
            )  
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $akun_model->updateAkun();

            $session = session();
            $session->setFlashdata("pesan", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('akun');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $dataakun = $akun_model->getAkunBasedOnId($_POST['id']);
            echo view('akun/v_edit_akun', [
                                    'title' => 'Ubah Akun',
                                    'data_akun' => $dataakun,
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');               
        }
    }
    
    public function hapus($id){
        $db = db_connect();
        $builder = $db->table('akun');
        $builder->delete(['id' => $id]);
        $data = [
            'status' => 'Hapus sukses',
            'status_text' => 'Data berhasil dihapus',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }
}
