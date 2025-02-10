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

        if ($newQuantity < 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Quantity tidak bisa kurang dari 1.',
            ]);
        }

        $cartItem = $cartModel->where('id_user', $userId)
                              ->where('id_product', $productId)
                              ->first();

        if (!$cartItem) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product tidak ada di keranjang.',
            ]);
        }

        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if (!$product || $newQuantity > $product['stok']) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jumlah melebihi stok yang tersedia.',
            ]);
        }

        $hargaDiskon = $product['harga'];
        if (!empty($product['diskon'])) {
            $hargaDiskon = $product['harga'] - ($product['harga'] * $product['diskon'] / 100);
        }

        $newTotal = $hargaDiskon * $newQuantity;

        $cartModel->update($cartItem['id_cart'], [
            'qty' => $newQuantity,
            'total' => $newTotal,
        ]);

        // Hitung ulang total keranjang
        $cartItems = $cartModel->where('id_user', $userId)->findAll();
        $totalQty = array_sum(array_column($cartItems, 'qty'));
        $totalCartPrice = array_sum(array_column($cartItems, 'total'));

        // Potongan jika total qty > 2
        $potongan = ($totalQty > 2) ? 10000 : 0;

        // Hitung biaya pengiriman dari ekspedisi yang dipilih
        $ekspedisiModel = new \App\Models\EkspedisiModel();
        $ekspedisi = $ekspedisiModel->where('status', 'Aktif')->first();
        $shippingCost = $ekspedisi ? $ekspedisi['tarif_pengiriman'] : 0;

        // Total bayar akhir
        $totalBayar = ($totalCartPrice - $potongan) + $shippingCost;

        return $this->response->setJSON([
            'success' => true,
            'newTotal' => $totalCartPrice,
            'productTotal' => $newTotal,
            'totalQty' => $totalQty,
            'potongan' => $potongan,
            'shippingCost' => $shippingCost,
            'totalBayar' => $totalBayar,
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

    if (!$userId) {
        return redirect()->to('/login');
    }

    $cartItems = $cartModel->getCartDetails($userId);
    $data['products'] = $cartItems;

    $ekspedisi = $ekspedisiModel->where('status', 'Aktif')->findAll();
    $data['ekspedisi'] = $ekspedisi;

    $shippingCost = 0;
    $totalHargaProduk = 0;
    $totalQty = 0;
    $potongan = 0;

    if (!empty($cartItems)) {
        foreach ($cartItems as $item) {
            $totalHargaProduk += $item['total']; 
            $totalQty += $item['qty'];
        }

        if ($totalQty > 2) {
            $potongan = 10000;
        }

        if (!empty($ekspedisi)) {
            $shippingCost = $ekspedisi[0]['tarif_pengiriman'];
        }
    }

    $totalBayar = ($totalHargaProduk - $potongan) + $shippingCost;

    $data['shipping_cost'] = $shippingCost;
    $data['total_harga_produk'] = $totalHargaProduk;
    $data['total_bayar'] = $totalBayar;
    $data['potongan'] = $potongan;
    $data['total_qty'] = $totalQty;

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

    // Cek apakah stoknya 0, jika 0 maka produk tidak bisa ditambahkan ke keranjang
    if ($product['stok'] == 0) {
        $session->setFlashdata('error', 'Produk ini sudah habis dan tidak dapat ditambahkan ke keranjang.');
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

    // Kurangi stok produk
    $productModel->update($product['id_product'], [
        'stok' => $product['stok'] - 1,
    ]);

    // Redirect ke halaman keranjang
    $session->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
    return redirect()->to('/');
}



    /* public function addToCart($productId)
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
} */


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
