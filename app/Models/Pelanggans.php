<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelanggans extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'pelanggan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode','nama', 'email', 'no_tlp','alamat'];

    public function getPelanggan(){
        return $this->findAll();

    }

     // method untuk menghapus data
    public function deletePelanggan($id){
        $db = db_connect();
        $builder = $db->table('pelanggan');
        $builder->delete(['id' => $id]);
    }
    // method untuk viewData berdasarkan id
    public function getPelangganBasedOnId($id){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM pelanggan WHERE id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }
    // method untuk updateData kosan
    public function updatePelanggan(){
        $db = db_connect();

        $data = [
            'nama' => $_POST['nama'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'email' => $_POST['email'],
            'no_tlp'  => $_POST['no_tlp'],
            'alamat'  => $_POST['alamat'] //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya           
        ];
        $builder = $db->table('pelanggan');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }

}