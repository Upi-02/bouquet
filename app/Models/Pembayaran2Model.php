<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembayaran2Model extends Model
{
    // untuk query list dari tabel bouquet
    public function getListBouquet(){
        $db = db_connect();
        $builder = $db->table('tes_mitrans.bouquet');
        // Produces: SELECT * FROM tes_mitrans.bouquet
        return $builder->get()->getResult();
    }

    // untuk menginputkan ke database
    public function inputData($data){
        $db = db_connect();
        $hasil = $db->table('tes_mitrans.bouquet')->insert($data);
        return $hasil;
    }

    // untuk mendapatkan list bouquet yang statusnya belum terupdate
    public function getStatus(){
        $db = db_connect();
        $builder = $db->table('tes_mitrans.bouquet')->where('status_code', '201');
        // Produces: SELECT * FROM tes_mitrans.bouquet WHERE status_code = '201'
        return $builder->get()->getResult();
    }

    // update status pembayaran
    public function updateStatus($data, $order_id){
        $db = db_connect();
        $hasil = $db->table('tes_mitrans.bouquet')->where('order_id', $order_id)->update($data);
        return $hasil;
    }
}
