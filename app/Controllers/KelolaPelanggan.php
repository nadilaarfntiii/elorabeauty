<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PesananModel;

class KelolaPelanggan extends BaseController
{
    protected $pesananModel;
    protected $userModel; 

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->userModel = new UserModel(); 
    }

    public function index()
    {
        $pelanggan = $this->userModel->where('role', 'pelanggan')->findAll();

        foreach ($pelanggan as &$pelangganItem) { 
            $pelangganItem['jumlah_pesanan'] = $this->pesananModel
                ->where('id_user', $pelangganItem['id_user'])
                ->countAllResults();
        }
        $data['pelanggan'] = $pelanggan;

        return view('pelanggan/kelola_pelanggan', $data);
    }

    public function deactivate($id_user)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id_user);

        if ($user) {
            $userModel->update($id_user, ['status' => 'Nonaktif']);
            return redirect()->back()->with('pesan', 'Akun berhasil dinonaktifkan');
        } else {
            return redirect()->back()->with('pesan', 'User tidak ditemukan');
        }
    }

    public function activate($id_user)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id_user);

        if ($user) {
            $userModel->update($id_user, ['status' => 'Aktif']);
            return redirect()->back()->with('pesan', 'Akun berhasil diaktifkan kembali');
        } else {
            return redirect()->back()->with('pesan', 'User tidak ditemukan');
        }
    }
}
