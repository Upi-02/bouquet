<?php

namespace App\Models;

use CodeIgniter\Model;

class Produks extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode','nama', 'harga', 'keterangan'];
    
    public function getProduk(){
        return $this->findAll();

    }

    // method untuk menghapus data
    public function deleteProduk($id){
        $db = db_connect();
        $builder = $db->table('produk');
        $builder->delete(['id' => $id]);
    }
    // method untuk viewData berdasarkan id
    public function getProdukBasedOnId($id){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM produk WHERE id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }
    // method untuk updateData kosan
    public function updateProduk(){
        $db = db_connect();

        $data = [
            'nama' => $_POST['nama'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'harga' => $_POST['harga'],
            'keterangan'  => $_POST['keterangan'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya           
        ];
        $builder = $db->table('produk');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }
}