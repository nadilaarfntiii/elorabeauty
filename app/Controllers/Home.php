<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\PesananModel;
use App\Models\KategoriModel;
use App\Models\CartModel;

class Home extends BaseController
{
    protected $userModel;
    protected $productModel;
    protected $pesananModel;
    protected $cartModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->pesananModel = new PesananModel();
        $this->cartModel = new CartModel();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $productModel = new ProductModel();
        $cartModel = new CartModel();

        $data['products'] = $productModel->getProductsByCategory();

        $userId = session()->get('id_user'); 

        if ($userId) {
            $data['cart'] = $cartModel->getCartDetails($userId);

            $data['cart_count'] = $cartModel->countCartItems($userId);
        } else {
            $data['cart'] = [];
            $data['cart_count'] = 0;
        }

        log_message('debug', 'Jumlah produk unik di cart: ' . $data['cart_count']);

        return view('index', $data);
    }

    public function dashboard()
{
    // Cek apakah user sudah login
    if (!$this->session->get('isLoggedIn')) {
        return redirect()->to('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    // Cek apakah user memiliki role admin
    if ($this->session->get('role') !== 'admin') {
        return redirect()->to('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    // Hitung jumlah pesanan
    $jumlahPesanan = $this->pesananModel->countAll();

    // Hitung jumlah pelanggan
    $jumlahPelanggan = $this->userModel->where('role', 'pelanggan')->countAllResults();

    // Hitung jumlah produk
    $jumlahProduk = $this->productModel->countAll();

    // Total pendapatan
    $totalPendapatan = $this->pesananModel
        ->where('status_pesanan', 'selesai')
        ->selectSum('total_bayar')
        ->get()
        ->getRow()
        ->total_bayar;

    // Ambil pendapatan per bulan
    $pendapatanBulanan = $this->pesananModel
        ->select('MONTH(tanggal_pesanan) AS bulan, SUM(total_bayar) AS pendapatan')
        ->where('status_pesanan', 'selesai')
        ->groupBy('MONTH(tanggal_pesanan)')
        ->orderBy('MONTH(tanggal_pesanan)', 'ASC')
        ->get()
        ->getResultArray();

    // Ambil data produk per kategori
    $produkPerKategori = $this->pesananModel->getProdukPerKategori();

    // Kirim data ke view
    return view('/dashboard', [
        'jumlahPesanan' => $jumlahPesanan,
        'jumlahPelanggan' => $jumlahPelanggan,
        'jumlahProduk' => $jumlahProduk,
        'totalPendapatan' => $totalPendapatan,
        'pendapatanBulanan' => $pendapatanBulanan,
        'produkPerKategori' => $produkPerKategori,
    ]);
}



    public function register()
    {
        return view('register');
    }

    public function store()
    {
        $validationRules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'password' => 'required|min_length[8]',
            'fullname' => 'required|alpha_space',
            'email' => 'required|valid_email|regex_match[/@gmail\.com$/]|is_unique[users.email]',
            'no_hp' => 'required|numeric|min_length[10]|max_length[15]',
            'alamat_lengkap' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required|numeric',
            'negara' => 'required',
        ];

        $validationMessages = [
            'username' => [
                'required' => 'Username harus diisi.',
                'min_length' => 'Username minimal 3 karakter.',
                'max_length' => 'Username maksimal 50 karakter.',
                'is_unique' => 'Username sudah terdaftar.',
            ],
            'password' => [
                'required' => 'Password harus diisi.',
                'min_length' => 'Password minimal 8 karakter.',
            ],
            'fullname' => [
                'required' => 'Nama lengkap harus diisi.',
                'alpha_space' => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
            ],
            'email' => [
                'required' => 'Email harus diisi.',
                'valid_email' => 'Email tidak valid.',
                'regex_match' => 'Hanya email dengan domain @gmail.com yang diperbolehkan.',
                'is_unique' => 'Email sudah terdaftar.',
            ],
            'no_hp' => [
                'required' => 'Nomor HP harus diisi.',
                'numeric' => 'Nomor HP hanya boleh berisi angka.',
                'min_length' => 'Nomor HP minimal 10 digit.',
                'max_length' => 'Nomor HP maksimal 15 digit.',
            ],
            'alamat_lengkap' => [
                'required' => 'Alamat lengkap harus diisi.',
            ],
            'kota' => [
                'required' => 'Kota harus diisi.',
            ],
            'provinsi' => [
                'required' => 'Provinsi harus diisi.',
            ],
            'kode_pos' => [
                'required' => 'Kode pos harus diisi.',
                'numeric' => 'Kode pos hanya boleh berisi angka.',
            ],
            'negara' => [
                'required' => 'Negara harus diisi.',
            ]
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getPost('email'),
            'nama_lengkap' => $this->request->getPost('fullname'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'kota' => $this->request->getPost('kota'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'negara' => $this->request->getPost('negara'),
            'role' => 'pelanggan', 
        ];

        $this->userModel->save($data);

        return redirect()->to(base_url('login'))->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function categories($category = 'all'): string
    {
        $productModel = new ProductModel();

        // Ambil produk berdasarkan kategori jika kategori ada
        if ($category && $category != 'all') {
            $data['products'] = $productModel->getProductsByCategory($category);
        } else {
            // Ambil semua produk jika kategori tidak ada atau 'all'
            $data['products'] = $productModel->getProductsByCategory();
        }

        // Menambahkan kategori yang dipilih ke dalam data untuk breadcrumb
        $data['selected_category'] = $category;

        if (empty($data['products'])) {
            log_message('debug', 'No products found.');
        }

        return view('categories', $data); // Tetap menggunakan view yang sama
    }

    public function kontak(): string
    {
        $session = session();
        return view('kontak', ['session' => $session]);
    }

    public function beranda(): string
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->getProductsByCategory();  

        if (empty($data['products'])) {
            log_message('debug', 'No products found.');
        }

        return view('index', $data);
    }
    public function single(): string
    {
        $session = session(); 
        return view('single', ['session' => $session]);
    }
}
