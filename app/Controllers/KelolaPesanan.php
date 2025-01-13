<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\EkspedisiModel;
use App\Models\DetailPesananModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class KelolaPesanan extends BaseController
{
    protected $pesananModel;
    protected $ekspedisiModel;
    protected $userModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->ekspedisiModel = new EkspedisiModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $pesananModel = $this->pesananModel;

        // Fetch all orders with related ekspedisi and user data
        $data['pesanan'] = $pesananModel->select('pesanan.*, ekspedisi.nama_ekspedisi, users.nama_lengkap')
                                         ->join('ekspedisi', 'ekspedisi.id_ekspedisi = pesanan.id_ekspedisi')
                                         ->join('users', 'users.id_user = pesanan.id_user') // Join with users table
                                         ->findAll();

        return view('pesanan/kelola_pesanan', $data);
    }

    public function detail($id_pesanan)
    {
        // Load models
        $pesananModel = $this->pesananModel;
        $detailPesananModel = new DetailPesananModel();
        $productModel = new ProductModel(); // Add ProductModel

        // Fetch order details along with ekspedisi and user data
        $order = $pesananModel->select('pesanan.*, ekspedisi.nama_ekspedisi, users.nama_lengkap')
                            ->join('ekspedisi', 'ekspedisi.id_ekspedisi = pesanan.id_ekspedisi')
                            ->join('users', 'users.id_user = pesanan.id_user') // Join with users table
                            ->find($id_pesanan);

        // Fetch order details (products)
        $orderDetails = $detailPesananModel->where('id_pesanan', $id_pesanan)->findAll();

        // Add product name (nama_product) to each order detail by joining with the product model
        foreach ($orderDetails as &$detail) {
            $product = $productModel->find($detail['id_product']);
            $detail['nama_product'] = $product['nama_product']; // Add product name to order detail
        }

        // Pass the data to the view
        return view('pesanan/detail_pesanan', [
            'order' => $order,
            'orderDetails' => $orderDetails
        ]);
    }

    public function updateStatus($id_pesanan, $status)
    {
        $validStatuses = ['dikemas', 'dikirim', 'selesai', 'dibatalkan'];
        
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $pesanan = $this->pesananModel->find($id_pesanan);
        
        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($pesanan['status_pesanan'] !== $status) {
            $this->pesananModel->update($id_pesanan, ['status_pesanan' => $status]);
        }

        return redirect()->to('pesanan/kelola_pesanan')->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
