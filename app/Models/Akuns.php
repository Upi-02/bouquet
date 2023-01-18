<?php

namespace App\Models;

use CodeIgniter\Model;

class Akuns extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'akun';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode','nama', 'header'];

    public function getAkun(){
        return $this->findAll();

    }

    // method untuk viewData berdasarkan id
    public function getAkunBasedOnId($id){
        $db = db_connect();
        $query   = $db->query('SELECT * FROM akun WHERE id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }

    // method untuk updateData kosan
    public function updateAkun(){
        $db = db_connect();

        $data = [
            'kode' => $_POST['kode'], //nama adalah atribut database, sedangkan nama_kos adalah nama input formnya
            'nama' => $_POST['nama'],
            'header'  => $_POST['header'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya           
        ];
        $builder = $db->table('akun');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }
}