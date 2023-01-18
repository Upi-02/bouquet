<?php

namespace App\Models;

use CodeIgniter\Model;

class Penjualans extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pelanggan','id_produk', 'keterangan','jumlah','tanggal_jual','harga_penjualan'];
    
    
    public function getPenjualan() {
        $db = db_connect();
        $query = $db->query('SELECT penjualan.id,pelanggan.nama as nama_pelanggan,
        produk.nama as nama_produk,
        penjualan.keterangan as ukuran_bouquet,
        produk.harga as harga_bouquet,
        penjualan.jumlah,
        penjualan.tanggal_jual,
        penjualan.harga_penjualan
        FROM `penjualan` 
        JOIN `produk` ON produk.id = penjualan.id_produk 
        JOIN `pelanggan` ON pelanggan.id = penjualan.id_pelanggan');
        $result = $query->getResult(); 
        return $result;
    }

    public function getPenjualanBasedOnId($id) {
        $db = db_connect();
        $query   = $db->query('SELECT penjualan.id,
        penjualan.id_pelanggan,
        penjualan.id_produk,
        pelanggan.kode as kode_pelanggan,
        produk.kode as kode_produk,
        pelanggan.nama as nama_pelanggan,
        produk.nama as nama_produk,
        penjualan.keterangan as ukuran_bouquet,
        produk.harga as harga_bouquet,
        penjualan.jumlah,
        penjualan.tanggal_jual,
        penjualan.harga_penjualan
        FROM `penjualan`
        JOIN `produk` ON produk.id = penjualan.id_produk 
        JOIN `pelanggan` ON pelanggan.id = penjualan.id_pelanggan
        WHERE penjualan.id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }

    public function getPelanggan() {
        $db = db_connect();
        $query = $db->query('SELECT id,kode,nama FROM `pelanggan`');
        $result = $query->getResult();
        return $result;
    }

    public function getProduk() {
        $db = db_connect();
        $query = $db->query('SELECT id,kode,nama,harga FROM `produk`');
        $result = $query->getResult();
        return $result;
    }

    public function updatePenjualan(){
        $db = db_connect();

        $data = [
            'jumlah'  => $_POST['jumlah'],
            'tanggal_jual'  => $_POST['tanggal_jual'],
            'harga_penjualan'  => $_POST['harga_penjualan'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya           
        ];
        $builder = $db->table('penjualan');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }
   
}