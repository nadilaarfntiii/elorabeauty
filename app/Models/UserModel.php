<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'username',
        'email',
        'nama_lengkap',
        'no_hp',
        'alamat_lengkap',
        'kota',
        'provinsi',
        'kode_pos',
        'negara',
        'password',
        'role',
        'status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'dibuat_pada';
    protected $updatedField  = 'diperbarui_pada';

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
