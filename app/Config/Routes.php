<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/login', 'AuthController::login');
$routes->post('/login/authenticate', 'AuthController::authenticate');
$routes->get('/register', 'Home::register'); 
$routes->post('/register/store', 'Home::store');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'admin'], function ($routes) {
    $routes->get('/dashboard', 'Home::/dashboard'); // Dashboard admin
});

$routes->group('', ['filter' => 'pelanggan'], function ($routes) {
    $routes->get('/', 'Home::index'); // Halaman utama pelanggan
});

// Pelanggan
$routes->get('/categories', 'Home::categories');
$routes->get('categories/(:segment)', 'Home::categories/$1');
$routes->get('/index', 'Home::beranda');
$routes->get('/kontak', 'Home::kontak');

$routes->get('single/(:segment)', 'Single::index/$1');
$routes->get('orders', 'CO::orders');
$routes->get('/detail_orders/(:segment)', 'CO::detail_orders/$1');

$routes->get('cart', 'Cart::index'); 
$routes->get('cart/addToCart/(:segment)', 'Cart::addToCart/$1');
$routes->post('cart/updateQuantity/(:segment)', 'Cart::updateQuantity/$1');
$routes->post('/cart/clearCart/(:segment)', 'Cart::clearCart/$1');

$routes->post('/store_order', 'CO::store_order');
$routes->post('/checkout', 'CO::checkout');
$routes->get('/checkout_success', 'CO::success');
$routes->post('/upload', 'CO::uploadBuktiPembayaran');

$routes->get('/orders', 'CO::orders');

$routes->get('/ekspedisi', 'Ekspedisi::index');
$routes->get('/ekspedisi/pilih/(:any)', 'Ekspedisi::pilih/$1');

// Admin //

//Kelola Kategori
$routes->get('kategori/kategori', 'Kategori::index');
$routes->get('kategori/kategori_create', 'Kategori::create');
$routes->post('/kategori/save', 'Kategori::save');
$routes->get('kategori/kategori_update(:segment)', 'Kategori::edit/$1');
$routes->put('/kategori/update/(:segment)', 'Kategori::update/$1');
$routes->get('/kategori/delete/(:segment)', 'Kategori::delete/$1');

//Kelola Produk
$routes->get('produk/produk', 'Product::produk');
$routes->get('produk/makeup', 'Product::makeup');
$routes->get('produk/skincare', 'Product::skincare');
$routes->get('produk/hairnbody', 'Product::hairnbody');
$routes->get('produk/product_create', 'Product::create');
$routes->post('/product/store', 'Product::store');
$routes->get('produk/product_update(:segment)', 'Product::edit/$1');
$routes->get('/product_update', 'Product::update/$1');
$routes->post('/product/update/(:segment)', 'Product::update/$1'); 
$routes->get('/product/delete/(:segment)', 'Product::delete/$1'); 
$routes->get('product/arsip/(:any)', 'Product::archive/$1');
$routes->get('product/activate/(:segment)/(:any)', 'Product::activate/$1/$2');
$routes->get('produk/arsip', 'Product::archived');

//Kelola Ekspedisi
$routes->get('ekspedisi/kelola_ekspedisi', 'Ekspedisi::kelola_ekspedisi');
$routes->get('ekspedisi/ekspedisi_create', 'Ekspedisi::create');
$routes->post('/ekspedisi/save', 'Ekspedisi::save');
$routes->get('ekspedisi/ekspedisi_update(:segment)', 'Ekspedisi::edit/$1');
$routes->post('ekspedisi/update/(:segment)', 'Ekspedisi::update/$1');
$routes->get('ekspedisi/delete/(:segment)', 'Ekspedisi::delete/$1');

//Kelola Pelanggan
$routes->get('pelanggan/kelola_pelanggan', 'KelolaPelanggan::index');
$routes->get('kelola_pelanggan/deactivate/(:segment)', 'KelolaPelanggan::deactivate/$1');
$routes->get('kelola_pelanggan/activate/(:segment)', 'KelolaPelanggan::activate/$1');

//Kelola Pesanan
$routes->get('pesanan/kelola_pesanan', 'KelolaPesanan::index');
$routes->get('pesanan/detail_pesanan/(:segment)', 'KelolaPesanan::detail/$1');
$routes->get('/kelola_pesanan/update_status/(:any)/(:segment)', 'KelolaPesanan::updateStatus/$1/$2');

$routes->get('single/addToCart/(:segment)/(:num)', 'Single::addToCart/$1/$2');

//Laporan
$routes->get('laporan/produk', 'Laporan::produk');
$routes->get('laporan/cetak_produk', 'Laporan::cetak_produk');

$routes->get('laporan/pelanggan', 'Laporan::pelanggan');
$routes->get('laporan/cetak_pelanggan', 'Laporan::cetak_pelanggan');

$routes->get('laporan/ekspedisi', 'Laporan::ekspedisi');
$routes->get('laporan/cetak_ekspedisi', 'Laporan::cetak_ekspedisi');

$routes->get('laporan/pesanan', 'Laporan::pesanan');
$routes->get('laporan/cetak_pesanan', 'Laporan::cetak_pesanan');


$routes->get('laporan/pendapatan', 'Laporan::pendapatan');
$routes->get('laporan/cetak_pendapatan', 'Laporan::cetak_pendapatan');

//grafik
$routes->get('pendapatan-per-bulan', 'Home::getPendapatanPerBulan');


