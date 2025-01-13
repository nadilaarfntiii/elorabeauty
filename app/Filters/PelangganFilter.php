<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PelangganFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek apakah user sudah login dan memiliki peran pelanggan
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'pelanggan') {
            return redirect()->to('/login')->with('error', 'Anda harus login sebagai pelanggan.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah request untuk filter ini
    }
}
