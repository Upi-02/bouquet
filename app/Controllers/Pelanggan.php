<?php

namespace App\Controllers;

use App\Models\Pelanggans; //include akun model di dalam controller

class Pelanggan extends BaseController
{
        public function index() 
        {
            $pelanggan = model(Pelanggans::class);
            $datapelanggan = $pelanggan->getPelanggan();
            echo view('struktur/header');
            echo view('struktur/sidebar');
            echo view('pelanggan/v_pelanggan',
                        [
                            'title' => 'Data Pelanggan',
                            'data_pelanggan' => $datapelanggan,
                        ]
                    );
            echo view('struktur/footer');
        }
    public function tambah()
    {
        $pelanggan_model = model(Pelanggans::class);
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[50]',
                'kode' => 'required|is_unique[pelanggan.kode]',
                'email' => 'required',
                'alamat'  => 'required',
                'no_tlp'  => 'required|exact_length[14]',
                ],
                [   //List Custom Pesan Error
                    'nama' => [
                        'required' => 'Nama pelanggan tidak boleh kosong',
                        'min_length' => 'Panjang nama pelanggan tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama pelanggan tidak boleh lebih dari 50',
                    ],
                    'kode' => [
                        'required' => 'Kode pelanggan tidak boleh kosong',
                        'is_unique' => 'Kode sudah ada',
                    ],
                    'email' =>[
                        'required' => 'Email pelanggan tidak boleh kosong'
                    ],
                    'alamat' => [
                        'required' => 'Alamat pelanggan tidak boleh kosong',
                    ],
                    'no_tlp' => [
                        'required' => 'Nomor telepon tidak boleh kosong',
                        'exact_length' => 'Panjang nomor hp harus 12 digit',
                    ],
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            // $db = db_connect();
            // $query = $db->query("SELECT max(kode) as kodeTerbesar FROM pelanggan");
            // // $data = $query->getResultArray();
            
            // foreach ($query->getResultArray() as $row) {
            //     $kodePelanggan = $row['kodeTerbesar'];
            // }
            
            // $urutan = (int) substr($kodePelanggan, 1, 3);
            // $urutan++;
            // $huruf = "P";
            // $kodePelanggan = $huruf . sprintf("%03s", $urutan);
            $pelanggan_model->save([
                'nama' => $this->request->getPost('nama'),
                'kode' =>  strtoupper($this->request->getPost('kode')),
                'email'  => $this->request->getPost('email'),
                'no_tlp'  => $this->request->getPost('no_tlp'),
                'alamat'  => $this->request->getPost('alamat'),
            ]);

            $session = session();
            $session->setFlashdata("pesan", "Berhasil Menambahkan");
            // redirect ke daftar kosan
            return redirect()->to('pelanggan');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('pelanggan/v_tambah_pelanggan', [
                                    'title' => 'Input Pelanggan',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');        
        }
    }

    // method untuk melihat data kos berdasarkan id kos
    public function lihatData($id){
        $pelanggan_model = model(Pelanggans::class);
        $pelanggan = $pelanggan_model->getPelangganBasedOnId($id);

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('pelanggan/v_edit_pelanggan',
                    [
                        'title' => 'Ubah Pelanggan',
                        'data_pelanggan' => $pelanggan,
                    ]
                 );
        echo view('struktur/footer');                
    }

    // method untuk mengupdate data kos 
    public function update(){
        $pelanggan_model = model(Pelanggans::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[50]',
                'email' => 'required',
                'alamat'  => 'required',
                'no_tlp'  => 'required|exact_length[14]',
                ],
                [   //List Custom Pesan Error
                    'nama' => [
                        'required' => 'Nama pelanggan tidak boleh kosong',
                        'min_length' => 'Panjang nama pelanggan tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama pelanggan tidak boleh lebih dari 50',
                    ],
                    'email' =>[
                        'required' => 'Email pelanggan tidak boleh kosong'
                    ],
                    'alamat' => [
                        'required' => 'Alamat pelanggan tidak boleh kosong',
                    ],
                    'no_tlp' => [
                        'required' => 'Nomor telepon tidak boleh kosong',
                        'exact_length' => 'Panjang nomor hp harus 12 digit',
                    ],
                ]
            )
            )  
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $pelanggan_model->updatePelanggan();

            $session = session();
            $session->setFlashdata("pesan", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('pelanggan');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $datapelanggan = $pelanggan_model->getPelangganBasedOnId($_POST['id']);
            echo view('pelanggan/v_edit_pelanggan', [
                                    'title' => 'Ubah Pelanggan',
                                    'data_pelanggan' => $datapelanggan,
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');               
        }
    }

    public function hapus($id){
        $db = db_connect();
        $builder = $db->table('pelanggan');
        $builder->delete(['id' => $id]);
        $data = [
            'status' => 'Hapus sukses',
            'status_text' => 'Data berhasil dihapus',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }
}
