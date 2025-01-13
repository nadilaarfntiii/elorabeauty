<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPesananModel extends Model
{
    protected $table      = 'detail_pesanan';   
    protected $primaryKey = 'id_detail_pesanan'; 

    protected $useAutoIncrement = true;   
    protected $returnType     = 'array'; 

    protected $allowedFields = [
        'id_pesanan', 
        'id_product', 
        'gambar_1', 
        'harga', 
        'qty', 
        'total'
    ];

    protected $createdField  = 'created_at'; 
    protected $updatedField  = 'updated_at';

}
