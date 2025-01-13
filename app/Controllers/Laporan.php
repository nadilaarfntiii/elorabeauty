<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KategoriModel;
use App\Models\UserModel; 
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\EkspedisiModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Laporan extends BaseController
{
    protected $productModel;
    protected $userModel;
    protected $pesananModel; // Tambahkan properti untuk PesananModel

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel(); 
        $this->pesananModel = new PesananModel(); // Inisialisasi PesananModel
    }

    public function produk()
    {
        $productModel = new ProductModel();
        $kategoriModel = new KategoriModel();

        // Mengambil semua kategori
        $data['kategori'] = $kategoriModel->findAll();

        // Mendapatkan kategori yang dipilih dari query string
        $selectedKategori = $this->request->getGet('kategori');
        
        // Mengambil produk berdasarkan kategori yang dipilih atau semua produk
        if ($selectedKategori) {
            $data['products'] = $productModel
                ->join('kategori', 'kategori.id_kategori = product.id_kategori')
                ->select('product.*, kategori.nm_kategori')  // Pilih kolom dari tabel produk dan kategori
                ->where('product.id_kategori', $selectedKategori)
                ->findAll();
        } else {
            $data['products'] = $productModel
                ->join('kategori', 'kategori.id_kategori = product.id_kategori')
                ->select('product.*, kategori.nm_kategori')  // Pilih kolom dari tabel produk dan kategori
                ->findAll();
        }

        // Menyimpan kategori yang dipilih untuk keperluan tampilan
        $data['selectedKategori'] = $selectedKategori;

        return view('laporan/produk', $data);
    }

    public function cetak_produk()
    {
        // Ambil kategori filter dari URL
        $kategoriId = $this->request->getGet('kategori');
        
        // Ambil data produk dengan join kategori untuk mendapatkan 'nm_kategori'
        if ($kategoriId) {
            $products = $this->productModel
                ->join('kategori', 'kategori.id_kategori = product.id_kategori')
                ->select('product.*, kategori.nm_kategori')  // Pastikan memilih kolom 'nm_kategori'
                ->where('product.id_kategori', $kategoriId)
                ->findAll();
        } else {
            $products = $this->productModel
                ->join('kategori', 'kategori.id_kategori = product.id_kategori')
                ->select('product.*, kategori.nm_kategori')  // Pastikan memilih kolom 'nm_kategori'
                ->findAll();
        }

        // Ambil nama pengguna yang login dari session
        $username = session()->get('username');  // Ambil username dari session
        $user = $this->userModel->getUserByUsername($username);  // Dapatkan data user berdasarkan username
        $nama_lengkap = $user ? $user['nama_lengkap'] : 'Unknown';  // Jika ada, ambil nama lengkap

        // Konfigurasi DOMPDF
        $dompdfOptions = new Options();
        $dompdfOptions->set('isHtml5ParserEnabled', true);
        $dompdfOptions->set('isPhpEnabled', true);
        $dompdf = new Dompdf($dompdfOptions);

        // Menyiapkan tampilan HTML untuk PDF, kirimkan data produk dan nama pengguna
        $htmlContent = view('laporan/cetak_produk', [
            'products' => $products,
            'nama_lengkap' => $nama_lengkap  // Tambahkan nama lengkap pengguna
        ]);

        // Load HTML ke DOMPDF
        $dompdf->loadHtml($htmlContent);

        // Set ukuran halaman
        $dompdf->setPaper('F4', 'landscape');

        // Render PDF (first pass)
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream('produk_laporan.pdf', array('Attachment' => 0));  // 0 berarti menampilkan PDF di browser
    }

    public function pelanggan()
    {
        $model = new UserModel();

        // Get status filter from URL, default is empty
        $statusFilter = $this->request->getGet('status');
        
        // Build query based on status filter
        if ($statusFilter) {
            $pelanggan = $model->where('role', 'pelanggan')
                               ->where('status', $statusFilter)
                               ->findAll();
        } else {
            $pelanggan = $model->where('role', 'pelanggan')->findAll();
        }

        // Tambahkan jumlah pesanan untuk setiap pelanggan
        foreach ($pelanggan as &$item) {
            $item['jumlah_pesanan'] = $this->pesananModel
                ->where('id_user', $item['id_user'])
                ->countAllResults(); // Hitung jumlah pesanan
        }

        // Store the selected status for view to retain filter state
        $data['pelanggan'] = $pelanggan;
        $data['selectedStatus'] = $statusFilter;

        return view('laporan/pelanggan', $data);
    }

    public function cetak_pelanggan()
    {
        $statusFilter = $this->request->getGet('status');

        // Filter data pelanggan berdasarkan status
        if ($statusFilter) {
            $pelanggan = $this->userModel->where('role', 'pelanggan')
                                        ->where('status', $statusFilter)
                                        ->findAll();
        } else {
            $pelanggan = $this->userModel->where('role', 'pelanggan')->findAll();
        }

        // Tambahkan jumlah pesanan untuk setiap pelanggan
        foreach ($pelanggan as &$item) {
            $item['jumlah_pesanan'] = $this->pesananModel
                ->where('id_user', $item['id_user'])
                ->countAllResults(); // Hitung jumlah pesanan
        }

        // Ambil nama pengguna dari session
        $username = session()->get('username');
        $user = $this->userModel->getUserByUsername($username);
        $nama_lengkap = $user ? $user['nama_lengkap'] : 'Unknown';

        // Konfigurasi DOMPDF
        $dompdfOptions = new Options();
        $dompdfOptions->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($dompdfOptions);

        // View untuk PDF
        $htmlContent = view('laporan/cetak_pelanggan', [
            'pelanggan' => $pelanggan,
            'nama_lengkap' => $nama_lengkap
        ]);

        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('F4', 'landscape');
        $dompdf->render();
        $dompdf->stream('pelanggan_laporan.pdf', ['Attachment' => 0]);
    }

    public function ekspedisi()
    {
        $model = new EkspedisiModel();

        // Get status filter from the URL, default is empty
        $statusFilter = $this->request->getGet('status');
        
        // Query based on status filter
        if ($statusFilter) {
            // Filter ekspedisi by status
            $data['ekspedisi'] = $model->where('status', $statusFilter)->findAll();
        } else {
            // If no filter, show all ekspedisi
            $data['ekspedisi'] = $model->findAll();
        }

        // Store the selected status for view to retain filter state
        $data['selectedStatus'] = $statusFilter;

        return view('laporan/ekspedisi', $data);
    }

    public function cetak_ekspedisi()
{
    $model = new EkspedisiModel();

    // Get status filter from the URL
    $statusFilter = $this->request->getGet('status');

    // Query based on status filter
    if ($statusFilter) {
        $ekspedisi = $model->where('status', $statusFilter)->findAll();
    } else {
        $ekspedisi = $model->findAll();
    }

    // Ambil nama pengguna dari session
    $username = session()->get('username');
    $user = $this->userModel->getUserByUsername($username);
    $nama_lengkap = $user ? $user['nama_lengkap'] : 'Unknown'; // Get user's full name or default to 'Unknown'

    // Konfigurasi DOMPDF
    $dompdfOptions = new Options();
    $dompdfOptions->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($dompdfOptions);

    // Prepare the HTML view for PDF export
    $htmlContent = view('laporan/cetak_ekspedisi', [
        'ekspedisi' => $ekspedisi,
        'nama_lengkap' => $nama_lengkap // Pass nama_lengkap to the view
    ]);

    // Load HTML to DOMPDF
    $dompdf->loadHtml($htmlContent);

    // Set paper size and orientation
    $dompdf->setPaper('F4', 'landscape');

    // Render PDF (first pass)
    $dompdf->render();

    // Output PDF to browser
    $dompdf->stream('ekspedisi_laporan.pdf', ['Attachment' => 0]);
}

public function pesanan()
{
    $pesananModel = $this->pesananModel;
    $ekspedisiModel = new EkspedisiModel();
    $userModel = new UserModel();

    // Get filters from URL
    $bulan = $this->request->getGet('bulan');
    $tahun = $this->request->getGet('tahun');
    $ekspedisiFilter = $this->request->getGet('ekspedisi');
    $statusPesanan = $this->request->getGet('status_pesanan');

    // Build query based on filters
    $builder = $pesananModel->select('pesanan.*, ekspedisi.nama_ekspedisi, users.nama_lengkap')
                        ->join('ekspedisi', 'ekspedisi.id_ekspedisi = pesanan.id_ekspedisi')
                        ->join('users', 'users.id_user = pesanan.id_user');

    if ($bulan) {
        $builder->where('MONTH(pesanan.tanggal_pesanan)', $bulan);
    }

    if ($tahun) {
        $builder->where('YEAR(pesanan.tanggal_pesanan)', $tahun);
    }

    if ($ekspedisiFilter) {
        $builder->where('pesanan.id_ekspedisi', $ekspedisiFilter);
    }

    if ($statusPesanan) {
        $builder->where('pesanan.status_pesanan', $statusPesanan);
    }

    $data['pesanan'] = $builder->findAll();

    // Get ekspedisi options for the filter
    $data['ekspedisi'] = $ekspedisiModel->findAll();

    // Pass selected filter values
    $data['selectedBulan'] = $bulan;
    $data['selectedTahun'] = $tahun;
    $data['selectedEkspedisi'] = $ekspedisiFilter;
    $data['selectedStatusPesanan'] = $statusPesanan;

    return view('laporan/pesanan', $data);
}

public function cetak_pesanan()
    {
        // Get the filters from the URL
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $ekspedisi = $this->request->getGet('ekspedisi');
        $statusPesanan = $this->request->getGet('status_pesanan');

        // Load the model
        $pesananModel = new PesananModel();

        // Apply filters if provided
        $pesanan = $pesananModel->getPesanan($bulan, $tahun, $ekspedisi, $statusPesanan);

        // Ambil nama pengguna dari session
        $username = session()->get('username');
        $user = $this->userModel->getUserByUsername($username);
        $nama_lengkap = $user ? $user['nama_lengkap'] : 'Unknown';

        // Prepare the data for the view
        $data = [
            'pesanan' => $pesanan,
            'selectedBulan' => $bulan,
            'selectedTahun' => $tahun,
            'selectedEkspedisi' => $ekspedisi,
            'selectedStatusPesanan' => $statusPesanan,
            'nama_lengkap' => $nama_lengkap // Pass nama_lengkap to the view
        ];

        // Load the view with the data
        $html = view('laporan/cetak_pesanan', $data);

        // Initialize DOMPDF
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size
        $dompdf->setPaper('F4', 'landscape');

        // Render the PDF
        $dompdf->render();

        // Stream the PDF to the browser
        $dompdf->stream("Laporan_Pesanan_{$bulan}_{$tahun}.pdf", array("Attachment" => false));
    }

    public function pendapatan()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        // Query to get the completed orders based on selected filters
        $builder = $this->pesananModel->select('pesanan.*, users.nama_lengkap')
                                      ->join('users', 'users.id_user = pesanan.id_user')
                                      ->where('pesanan.status_pesanan', 'Selesai');

        if ($bulan) {
            $builder->where('MONTH(pesanan.tanggal_pesanan)', $bulan);
        }

        if ($tahun) {
            $builder->where('YEAR(pesanan.tanggal_pesanan)', $tahun);
        }

        $pesanan = $builder->findAll();

        // Calculate total revenue
        $totalPendapatan = 0;
        foreach ($pesanan as $order) {
            $totalPendapatan += $order['total_bayar'];
        }

        // Pass the data to the view
        $data = [
            'pesanan' => $pesanan,
            'totalPendapatan' => $totalPendapatan,
            'selectedBulan' => $bulan,
            'selectedTahun' => $tahun,
        ];

        return view('laporan/pendapatan', $data);
    }

    // Function for printing the revenue report
    public function cetak_pendapatan()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        // Query to get the completed orders based on selected filters
        $builder = $this->pesananModel->select('pesanan.*, users.nama_lengkap')
                                      ->join('users', 'users.id_user = pesanan.id_user')
                                      ->where('pesanan.status_pesanan', 'Selesai');

        if ($bulan) {
            $builder->where('MONTH(pesanan.tanggal_pesanan)', $bulan);
        }

        if ($tahun) {
            $builder->where('YEAR(pesanan.tanggal_pesanan)', $tahun);
        }

        $pesanan = $builder->findAll();

        // Calculate total revenue
        $totalPendapatan = 0;
        foreach ($pesanan as $order) {
            $totalPendapatan += $order['total_bayar'];
        }

        // Ambil nama pengguna dari session
        $username = session()->get('username');
        $user = $this->userModel->getUserByUsername($username);
        $nama_lengkap = $user ? $user['nama_lengkap'] : 'Unknown';

        // Konfigurasi DOMPDF
        $dompdfOptions = new Options();
        $dompdfOptions->set('isHtml5ParserEnabled', true);
        $dompdfOptions->set('isPhpEnabled', true);
        $dompdf = new Dompdf($dompdfOptions);

        // Prepare the HTML view for PDF export
        $htmlContent = view('laporan/cetak_pendapatan', [
            'pesanan' => $pesanan,
            'totalPendapatan' => $totalPendapatan,
            'selectedBulan' => $bulan,
            'selectedTahun' => $tahun,
            'nama_lengkap' => $nama_lengkap
        ]);

        // Load HTML to DOMPDF
        $dompdf->loadHtml($htmlContent);

        // Set paper size and orientation
        $dompdf->setPaper('F4', 'landscape');

        // Render PDF (first pass)
        $dompdf->render();

        // Output PDF to browser
        $dompdf->stream("Laporan_Pendapatan_{$bulan}_{$tahun}.pdf", array("Attachment" => false));
    }

}
