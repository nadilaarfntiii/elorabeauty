<?php

namespace App\Models;

use CodeIgniter\Model;

class EkspedisiModel extends Model
{
    protected $table = 'ekspedisi';  
    protected $primaryKey = 'id_ekspedisi';  
    protected $allowedFields = [
        'id_ekspedisi', 'nama_ekspedisi', 'estimasi_pengiriman',
        'tarif_pengiriman', 'no_hp', 'status'
    ];                     
    
    protected $validationRules = [
        'id_ekspedisi' => 'required|string|max_length[20]|is_unique[ekspedisi.id_ekspedisi]',
        'nama_ekspedisi' => 'required|string|max_length[100]',
        'estimasi_pengiriman' => 'permit_empty|string|max_length[50]',
        'tarif_pengiriman' => 'required|decimal',
        'no_hp' => 'permit_empty|string|max_length[50]',
        'status' => 'required|in_list[Aktif,Nonaktif]',
    ];

    protected $validationMessages = [
        'id_ekspedisi' => [
            'required' => 'ID ekspedisi harus diisi.',
            'string' => 'ID ekspedisi harus berupa string.',
            'is_unique' => 'ID ekspedisi ini sudah ada.',
        ],
        'nama_ekspedisi' => [
            'required' => 'Nama ekspedisi harus diisi.',
            'string' => 'Nama ekspedisi harus berupa string.',
        ],
        'tarif_pengiriman' => [
            'required' => 'Tarif pengiriman harus diisi.',
            'decimal' => 'Tarif pengiriman harus berupa angka desimal.',
        ],
        'status' => [
            'required' => 'Status ekspedisi harus diisi.',
            'in_list' => 'Status ekspedisi harus salah satu dari "Aktif" atau "Nonaktif".',
        ]
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
