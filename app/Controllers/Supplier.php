<?php

namespace App\Controllers;

use App\Models\Suppliers; //include produk model di dalam controller

class Supplier extends BaseController
{   
    public function index()
    {
        helper('text');
        $supplier_model = model(Suppliers::class);
        $datasupplier= $supplier_model->getSupplier();
        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('supplier/v_supplier',
                    [
                        'title' => 'Data Supplier',
                        'data_supplier' => $datasupplier,
                    ]
                 );
        echo view('struktur/footer');
    }

    public function tambah()
    {
        $supplier_model = model(Suppliers::class);
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[50]',
                'kode' => 'required|is_unique[supplier.kode]',
                'no_tlp'  => 'required|exact_length[14]',
                'alamat' => 'required',
                'keterangan'  => 'required',
                ],
                [   //List Custom Pesan Error
                    'nama' => [
                        'required' => 'Nama supplier tidak boleh kosong',
                        'min_length' => 'Panjang nama supplier tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama supplier tidak boleh lebih dari 50',
                    ],
                    'kode' => [
                        'required' => 'Kode supplier tidak boleh kosong',
                        'is_unique' => 'Kode sudah ada',
                    ],
                    'no_tlp' =>[
                        'required' => 'Nomor telepon tidak boleh kosong',
                        'exact_length' => 'Panjang nomor hp harus 12 digit',
                    ],
                    'keterangan' => [
                        'required' => 'Keterangan supplier tidak boleh kosong',
                    ],
                    'alamat' => [
                        'required' => 'Alamat supplier tidak boleh kosong',
                    ],
                ]
            )
            ) 
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung masukkan ke database
            // $db = db_connect();
            // $query = $db->query("SELECT max(kode) as kodeTerbesar FROM supplier");
            // // $data = $query->getResultArray();
            
            // foreach ($query->getResultArray() as $row) {
            //     $kodeSupplier = $row['kodeTerbesar'];
            // }
            
            // $urutan = (int) substr($kodeSupplier, 1, 3);
            // $urutan++;
            // $huruf = "S";
            // $kodeSupplier = $huruf . sprintf("%03s", $urutan);
            $supplier_model->save([
                'nama' => $this->request->getPost('nama'),
                'kode' => strtoupper($this->request->getPost('kode')),
                'no_tlp'  => $this->request->getPost('no_tlp'),
                'alamat'  => $this->request->getPost('alamat'),
                'keterangan'  => $this->request->getPost('keterangan'),
            ]);

            $session = session();
            $session->setFlashdata("pesan", "Berhasil Menambahkan");
            // redirect ke daftar kosan
            return redirect()->to('supplier');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            echo view('supplier/v_tambah_supplier', [
                                    'title' => 'Input Supplier',
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');        
        }
    }

    // method untuk melihat data kos berdasarkan id kos
    public function lihatData($id){
        $supplier_model = model(Suppliers::class);
        $supplier = $supplier_model->getSupplierBasedOnId($id);

        echo view('struktur/header');
        echo view('struktur/sidebar');
        echo view('supplier/v_edit_supplier',
                    [
                        'title' => 'Ubah Supplier',
                        'data_supplier' => $supplier,
                    ]
                 );
        echo view('struktur/footer');                
    }

    // method untuk mengupdate data kos 
    public function update(){
        $supplier_model = model(Suppliers::class);
        $validation =  \Config\Services::validation();
        if ($this->request->getMethod() === 'post' && 
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[50]',
                'no_tlp'  => 'required|exact_length[14]',
                'alamat' => 'required',
                'keterangan'  => 'required',
                ],
                [   //List Custom Pesan Error
                    'nama' => [
                        'required' => 'Nama supplier tidak boleh kosong',
                        'min_length' => 'Panjang nama supplier tidak boleh kurang dari 3',
                        'max_length' => 'Panjang nama supplier tidak boleh lebih dari 50',
                    ],
                    'no_tlp' =>[
                        'required' => 'Nomor telepon tidak boleh kosong',
                        'exact_length' => 'Panjang nomor hp harus 12 digit',
                    ],
                    'keterangan' => [
                        'required' => 'Keterangan supplier tidak boleh kosong',
                    ],
                    'alamat' => [
                        'required' => 'Alamat supplier tidak boleh kosong',
                    ],
                ]
            )
            )   
        {
            // kalau masuk ke sini berarti sudah sesuai dengan rule yang dikehendaki
            // maka langsung update ke database
            $supplier_model->updateSupplier();

            $session = session();
            $session->setFlashdata("pesan", "Sukses Update");
            // redirect ke daftar kosan
            return redirect()->to('supplier');

        } else {
            echo view('struktur/header');
            echo view('struktur/sidebar');
            // pada view Add , jangan lupa kirimkan data title dan hasil pesan validasi
            $supplier = $supplier_model->getSupplierBasedOnId($_POST['id']);
            echo view('supplier/v_edit_supplier', [
                                    'title' => 'Ubah Supplier',
                                    'data_supplier' => $supplier,
                                    'validation' => $this->validator,
                                ]
                    );
            echo view('struktur/footer');               
        }
    }

    public function hapus($id){
        $db = db_connect();
        $builder = $db->table('supplier');
        $builder->delete(['id' => $id]);
        $data = [
            'status' => 'Hapus sukses',
            'status_text' => 'Data berhasil dihapus',
            'status_icon' => 'success'
        ];

        return $this->response->setJSON($data);
    }
   
}
