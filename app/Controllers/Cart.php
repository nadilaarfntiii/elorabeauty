<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\EkspedisiModel;

class Cart extends Controller
{
    public function updateQuantity($productId)
{
    if ($this->request->isAJAX()) {
        $session = session();
        $cartModel = new CartModel();
        $userId = $session->get('id_user');
        $newQuantity = $this->request->getJSON()->quantity;

        // Log data yang diterima
        log_message('info', 'Received quantity: ' . $newQuantity); // Log data quantity

        if ($newQuantity < 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Quantity cannot be less than 1.',
            ]);
        }

        // Dapatkan produk di keranjang
        $cartItem = $cartModel->where('id_user', $userId)
                              ->where('id_product', $productId)
                              ->first();

        if (!$cartItem) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product not found in cart.',
            ]);
        }

        // Perbarui kuantitas dan total harga
        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if (!$product || $newQuantity > $product['stok']) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jumlah melebihi stok yang tersedia.',
            ]);
        }

        // Menghitung total setelah memperbarui kuantitas
        $hargaDiskon = $product['harga'];
        if (!empty($product['diskon'])) {
            $hargaDiskon = $product['harga'] - ($product['harga'] * $product['diskon'] / 100);
        }

        $newTotal = $hargaDiskon * $newQuantity;

        // Log total harga
        log_message('info', 'Total baru untuk produk: ' . $newTotal); // Log total harga baru

        // Update keranjang dengan kuantitas baru dan total harga
        $cartModel->update($cartItem['id_cart'], [
            'qty' => $newQuantity,
            'total' => $newTotal,
        ]);

        // Update total harga keranjang dan pengiriman
        $cartItems = $cartModel->where('id_user', $userId)->findAll();
        $totalCartPrice = array_sum(array_column($cartItems, 'total'));

        $total_harga_produk = 0;
        foreach ($cartItems as $item) {
            $total_harga_produk += $item['total']; // Gunakan total yang sudah dihitung di addToCart
        }

        $shipping_cost = 50000;

        $total_bayar = $total_harga_produk + $shipping_cost;

        return $this->response->setJSON([
            'success' => true,
            'newTotal' => $totalCartPrice,  
            'productTotal' => $newTotal,    // Mengirimkan total produk
            'totalHargaProduk' => $total_harga_produk, 
            'shippingCost' => $shipping_cost, 
            'totalBayar' => $total_bayar, 
        ]);
    }

    return redirect()->to('/cart');
}


    public function index()
    {
        $cartModel = new CartModel();
        $ekspedisiModel = new EkspedisiModel();
        $session = session();
        $userId = $session->get('id_user');
        
        // Redirect ke login jika user belum login
        if (!$userId) {
            return redirect()->to('/login');
        }

        // Ambil detail produk di keranjang
        $cartItems = $cartModel->getCartDetails($userId);
        $data['products'] = $cartItems;

        // Mendapatkan data ekspedisi dengan status Aktif
        $ekspedisi = $ekspedisiModel->where('status', 'Aktif')->findAll();
        $data['ekspedisi'] = $ekspedisi;

        // Inisialisasi nilai default
        $shippingCost = 0;
        $totalHargaProduk = 0;

        // Periksa jika ada produk di keranjang
        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                $totalHargaProduk += $item['total']; 
            }

            // Ambil tarif pengiriman dari ekspedisi yang dipilih
            if (!empty($ekspedisi)) {
                // Jika ada ekspedisi, ambil tarif pengiriman dari ekspedisi pertama
                $shippingCost = $ekspedisi[0]['tarif_pengiriman'];
            }
        }

        // Hitung total bayar (produk + tarif pengiriman)
        $totalBayar = $totalHargaProduk + $shippingCost;

        // Menyimpan data ke dalam view
        $data['shipping_cost'] = $shippingCost;
        $data['total_harga_produk'] = $totalHargaProduk;
        $data['total_bayar'] = $totalBayar;

        return view('cart', $data);
    }


    public function addToCart($productId)
{
    $session = session();

    // Periksa apakah pengguna sudah login
    if (!$session->has('isLoggedIn') || !$session->get('isLoggedIn')) {
        $session->setFlashdata('error', 'Silakan login terlebih dahulu untuk menambah produk ke keranjang.');
        return redirect()->to('/login');
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
        // Jika produk sudah ada, tambahkan kuantitas
        $newQty = $existingCart['qty'] + 1;
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
            'qty' => 1, // Kuantitas 1 untuk produk baru
            'total' => $hargaDiskon, // Total bayar setelah diskon
        ]);
    }

    // Redirect ke halaman keranjang
    $session->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
    return redirect()->to('/');
}


public function clearCart($cartId)
{
    $session = session();

    // Cek apakah ada data keranjang di session
    $cart = $session->get('cart');

    // Cek apakah keranjang ada dalam session
    if ($cart) {
        // Hapus produk dari session berdasarkan id_cart
        foreach ($cart as $key => $product) {
            if ($product['id_cart'] == $cartId) {
                unset($cart[$key]);  // Hapus produk dari session
                break;
            }
        }

        // Update session dengan keranjang yang telah diperbarui
        $session->set('cart', $cart);
    }

    // Hapus produk dari database berdasarkan id_cart
    $model = new CartModel();

    // Verifikasi apakah produk dengan id_cart ada di database
    $cartItem = $model->find($cartId);

    if (!$cartItem) {
        // Jika produk tidak ditemukan di database
        return $this->response->setJSON(['success' => false, 'message' => 'Product not found in the database.']);
    }

    // Ambil informasi produk yang dihapus
    $productModel = new ProductModel();
    $product = $productModel->find($cartItem['id_product']);

    if ($product) {
        // Mengembalikan kuantitas produk ke stok
        $updatedStock = $product['stok'] + $cartItem['qty'];

        // Update stok produk di tabel product
        $productModel->update($product['id_product'], [
            'stok' => $updatedStock
        ]);

        // Log perubahan stok
        log_message('info', 'Stock updated for product ' . $product['id_product'] . '. New stock: ' . $updatedStock);
    }

    // Hapus produk dari database (keranjang)
    $model->where('id_cart', $cartId)->delete();

    // Kembalikan respon JSON bahwa penghapusan berhasil
    return $this->response->setJSON(['success' => true, 'message' => 'Product successfully removed from the cart and stock updated.']);
}

}
