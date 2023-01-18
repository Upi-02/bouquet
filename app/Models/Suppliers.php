<?php

namespace App\Models;

use CodeIgniter\Model;

class Suppliers extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode','nama', 'no_tlp','alamat','keterangan'];
    
    public function getSupplier(){
        return $this->findAll();

    }

    // method untuk menghapus data
    public function deleteSupplier($id){
        $db = db_connect();
        $builder = $db->table('supplier');
        $builder->delete(['id' => $id]);
    }
    // method untuk viewData berdasarkan id
    public function getSupplierBasedOnId($id){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM supplier WHERE id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }
    // method untuk updateData kosan
    public function updateSupplier(){
        $db = db_connect();

        $data = [
            'nama' => $_POST['nama'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'no_tlp' => $_POST['no_tlp'],
            'alamat' => $_POST['alamat'],
            'keterangan'  => $_POST['keterangan'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya           
        ];
        $builder = $db->table('supplier');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }
}