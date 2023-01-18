<?php

namespace App\Models;

use CodeIgniter\Model;

class Peralatans extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'peralatan_bahan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode','nama', 'harga','tanggal_beli','keterangan'];
    
    public function getPeralatan(){
        return $this->findAll();

    }

    // method untuk menghapus data
    public function deletePeralatan($id){
        $db = db_connect();
        $builder = $db->table('peralatan_bahan');
        $builder->delete(['id' => $id]);
    }
    // method untuk viewData berdasarkan id
    public function getPeralatanBasedOnId($id){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM peralatan_bahan WHERE id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }
    // method untuk updateData kosan
    public function updatePeralatan(){
        $db = db_connect();

        $data = [
            'nama' => $_POST['nama'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'harga' => $_POST['harga'],
            'tanggal_beli' => $_POST['tanggal_beli'],
            'keterangan'  => $_POST['keterangan'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya           
        ];
        $builder = $db->table('peralatan_bahan');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }
}