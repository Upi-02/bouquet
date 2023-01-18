<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    // atribut tabel diisi dengan nama tabel
    protected $table = 'user';

    // method untuk mengecek apakah username dan password dari $_POST sudah sesuai
    public function cekUsernamePassword(){
        $nama = $_POST['username'];
        $pwd = $_POST['password'];
        // query dengan bind parameter username dan pwd untuk mencegah sql injection
        $db = db_connect();
        $query   = $db->query('SELECT COUNT(*) as jumlah FROM user WHERE username = ? AND pass = ?' , array($nama,md5($pwd)));
        $results = $query->getResult();
        return $results;
    }
}