<?php

namespace App\Controllers\Api;

use App\Models\Produks;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Penjualan extends ResourceController 
{
    use ResponseTrait;

    public function show($id = null) {
        $model = new Produks();
        $data = $model->find($id);

        return $this->respond($data);
    }
}

?>