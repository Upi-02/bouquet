<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembelians extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'pembelian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_supplier','id_produk', 'keterangan','jumlah','tanggal_beli','harga_pembelian'];
    
    public function getPembelian() {
        $db = db_connect();
        $query = $db->query('SELECT pembelian.id,supplier.nama as nama_supplier,
        produk.nama as nama_produk,
        produk.keterangan as keterangan,
        produk.harga as harga_bouquet,
        pembelian.jumlah,
        pembelian.tanggal_beli,
        pembelian.harga_pembelian
        FROM `pembelian` 
        JOIN `produk` ON produk.id = pembelian.id_produk 
        JOIN `supplier` ON supplier.id = pembelian.id_supplier');
        $result = $query->getResult(); 
        return $result;
    }

    public function getPembelianBasedOnId($id) {
        $db = db_connect();
        $query   = $db->query('SELECT pembelian.id,
        pembelian.id_supplier,
        pembelian.id_produk,
        supplier.kode as kode_supplier,
        produk.kode as kode_produk,
        supplier.nama as nama_supplier,
        produk.nama as nama_produk,
        produk.keterangan as keterangan,
        produk.harga as harga_bouquet,
        pembelian.jumlah,
        pembelian.tanggal_beli,
        pembelian.harga_pembelian
        FROM `pembelian`
        JOIN `produk` ON produk.id = pembelian.id_produk 
        JOIN `supplier` ON supplier.id = pembelian.id_supplier
        WHERE pembelian.id = ? ', array($id));
        $results = $query->getResult();
        return $results;
    }

    public function getSupplier() {
        $db = db_connect();
        $query = $db->query('SELECT id,kode,nama FROM `supplier`');
        $result = $query->getResult();
        return $result;
    }

    public function getProduk() {
        $db = db_connect();
        $query = $db->query('SELECT id,kode,nama,harga,keterangan FROM `produk`');
        $result = $query->getResult();
        return $result;
    }

    public function updatePembelian(){
        $db = db_connect();

        $data = [
            'jumlah'  => $_POST['jumlah'],
            'tanggal_beli'  => $_POST['tanggal_beli'],
            'harga_pembelian'  => $_POST['harga_pembelian'], //alamat adalah atribut di database, sedangkan alamat kos adalah input formnya           
        ];
        $builder = $db->table('pembelian');
        $builder->where('id', $_POST['id']);
        $builder->update($data);
    }
   
}