<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Single extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index($id_product)
    {
        $productModel = new ProductModel();
        $product = $productModel->getProductById($id_product);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Product with id $id_product not found.");
        }

        return view('single', [
            'product' => $product,
            'session' => $this->session
        ]);
    }

    public function addToCart($productId = null, $quantity = null)
{
    $session = session();

    // Periksa apakah pengguna sudah login
    if (!$session->has('isLoggedIn') || !$session->get('isLoggedIn')) {
        $session->setFlashdata('error', 'Silakan login terlebih dahulu untuk menambah produk ke keranjang.');
        return redirect()->to('/login');
    }

    // Validasi parameter
    if (empty($productId) || empty($quantity) || !is_numeric($quantity) || $quantity <= 0) {
        $session->setFlashdata('error', 'Data produk atau kuantitas tidak valid.');
        return redirect()->to('/');
    }

    // Ambil id_user dari session
    $idUser = $session->get('id_user');
    if (!$idUser) {
        log_message('error', 'Session id_user tidak ditemukan atau null');
        $session->setFlashdata('error', 'Data pengguna tidak ditemukan. Silakan login ulang.');
        return redirect()->to('/login');
    }

    // Load model produk
    $productModel = new ProductModel();
    $product = $productModel->getProductById($productId);

    // Periksa apakah produk ditemukan
    if (!$product) {
        $session->setFlashdata('error', 'Produk tidak ditemukan.');
        return redirect()->to('/');
    }

    // Periksa apakah stok cukup
    if ($quantity > $product['stok']) {
        $session->setFlashdata('error', 'Stok produk tidak mencukupi. Stok tersedia: ' . $product['stok']);
        return redirect()->to('/');
    }

    // Hitung harga setelah diskon
    $hargaDiskon = $product['harga'];
    if (!empty($product['diskon'])) {
        $hargaDiskon = $product['harga'] - ($product['harga'] * $product['diskon'] / 100);
    }

    // Load CartModel
    $cartModel = new CartModel();

    // Periksa apakah produk sudah ada di tabel cart untuk user ini
    $existingCart = $cartModel->where('id_user', $idUser)
        ->where('id_product', $productId)
        ->first();

    if ($existingCart) {
        // Jika produk sudah ada, tambahkan kuantitas berdasarkan yang dipilih
        $newQty = $existingCart['qty'] + $quantity;

        // Periksa apakah kuantitas baru melebihi stok
        if ($newQty > $product['stok']) {
            $session->setFlashdata('error', 'Stok produk tidak mencukupi untuk jumlah yang diinginkan. Stok tersedia: ' . $product['stok']);
            return redirect()->to('/');
        }

        $total = $newQty * $hargaDiskon;

        // Update keranjang dengan kuantitas baru
        $cartModel->update($existingCart['id_cart'], [
            'qty' => $newQty,
            'total' => $total,
        ]);
    } else {
        // Jika produk belum ada, tambahkan sebagai item baru
        $cartModel->save([
            'id_user' => $idUser,
            'id_kategori' => $product['id_kategori'],
            'id_product' => $product['id_product'],
            'gambar_1' => $product['gambar_1'], // Tambahkan gambar_1
            'qty' => $quantity, // Gunakan kuantitas yang dipilih
            'total' => $hargaDiskon * $quantity, // Total bayar setelah diskon
        ]);
    }

    // Redirect ke halaman keranjang
    $session->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
    return redirect()->to('/cart'); // Redirect ke halaman keranjang
}

}
