<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        $error = session()->getFlashdata('error');
        return view('login', ['error' => $error]);
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username dan Password tidak boleh kosong.');
        }

        $userModel = new UserModel();

        // Ambil data pengguna dari database
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            // Periksa apakah status pengguna adalah 'Aktif'
            if ($user['status'] !== 'Aktif') {
                return redirect()->back()->with('error', 'Akun tidak ditemukan.');
            }

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                $session = session();
                $session->set([
                    'username' => $user['username'],
                    'id_user' => $user['id_user'],
                    'isLoggedIn' => true,
                    'role' => $user['role'],
                ]);

                // Arahkan berdasarkan peran pengguna
                if ($user['role'] === 'pelanggan') {
                    return redirect()->to(base_url('/'));
                } elseif ($user['role'] === 'admin') {
                    return redirect()->to(base_url('/dashboard'));
                } else {
                    return redirect()->back()->with('error', 'Peran pengguna tidak dikenali.');
                }
            } else {
                return redirect()->back()->with('error', 'Username atau Password salah.');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau Password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'))->with('success', 'Berhasil logout.');
    }
}
