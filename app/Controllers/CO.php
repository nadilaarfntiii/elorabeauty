<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\CartModel;
use App\Models\EkspedisiModel;
use App\Models\ProductModel;
use App\Models\DetailPesananModel;
use CodeIgniter\Controller;

class CO extends BaseController
{
    protected $cartModel;
    protected $pesananModel;
    protected $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->pesananModel = new PesananModel();
        $this->productModel = new ProductModel();
        $this->detailPesananModel = new DetailPesananModel();
    }

    public function store_order()
    {
        $userId = session()->get('id_user'); 
        $cartItems = $this->cartModel->getCartByUser($userId);
        
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang belanja Anda kosong!');
        }

        $total = 0;
        $totalQty = 0;  // Variabel untuk menyimpan total quantity

        foreach ($cartItems as $item) {
            $total += $item['total']; 
            $totalQty += $item['qty'];  // Menghitung total quantity
        }

        $idEkspedisi = $this->request->getPost('id_ekspedisi');
        
        $ekspedisiModel = new EkspedisiModel();
        $ekspedisi = $ekspedisiModel->find($idEkspedisi);

        if (!$ekspedisi) {
            return redirect()->back()->with('error', 'Ekspedisi tidak ditemukan.');
        }

        $shippingFee = $ekspedisi['tarif_pengiriman'];

        $totalBayar = $total + $shippingFee;

        $buktiPembayaran = $this->request->getFile('bukti_pembayaran');
        $buktiPembayaranName = '';
        if ($buktiPembayaran && $buktiPembayaran->isValid() && !$buktiPembayaran->hasMoved()) {
            $buktiPembayaranName = $buktiPembayaran->getRandomName();
            $buktiPembayaran->move(FCPATH . '/uploads', $buktiPembayaranName);
        }

        $pesananData = [
            'id_user' => $userId,
            'tanggal_pesanan' => date('Y-m-d H:i:s'),
            'total' => $total,
            'total_item' => $totalQty,  // Menyimpan total quantity ke kolom total_item
            'tarif_pengiriman' => $shippingFee,
            'total_bayar' => $totalBayar,
            'status_pesanan' => 'dikemas', 
            'alamat_pengiriman' => $this->request->getPost('alamat_pengiriman'), 
            'id_ekspedisi' => $this->request->getPost('id_ekspedisi'), 
            'bukti_pembayaran' => $buktiPembayaranName, 
        ];

        $this->pesananModel->insert($pesananData);

        $orderId = $this->pesananModel->getInsertID();

        $this->cartModel->clearCart($userId);

        session()->setFlashdata('success', 'Pesanan Anda berhasil diproses!');
        return redirect()->to('checkout_success');
    }

    public function success()
    {
        return view('checkout_success');
    }

    public function orders()
    {
        $userId = session()->get('id_user'); 

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu untuk melihat pesanan Anda.');
        }

        $orders = $this->pesananModel->where('id_user', $userId)
                                    ->orderBy('tanggal_pesanan', 'DESC')  
                                    ->findAll();

        return view('orders', ['orders' => $orders]);
    }

    public function detail_orders($id_pesanan)
    {
        $userId = session()->get('id_user'); // Ambil id_user dari session

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu untuk melihat detail pesanan.');
        }

        // Ambil data pesanan berdasarkan id_pesanan dan id_user
        $order = $this->pesananModel
            ->where('id_pesanan', $id_pesanan)
            ->where('id_user', $userId)
            ->first();

        if (!$order) {
            return redirect()->to('/orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Ambil detail pesanan berdasarkan id_pesanan
        $orderDetails = $this->detailPesananModel
            ->select('detail_pesanan.*, product.nama_product')  
            ->join('product', 'product.id_product = detail_pesanan.id_product')
            ->where('id_pesanan', $id_pesanan)
            ->findAll();

        // Kirim data pesanan dan detail pesanan ke view
        return view('detail_orders', [
            'order' => $order,
            'order_details' => $orderDetails // Perhatikan penamaan variabel di sini
        ]);
    }

}
