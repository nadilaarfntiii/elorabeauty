<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KategoriModel;

class Product extends BaseController
{
    public function produk()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->getProductsByCategory();  

        if (empty($data['products'])) {
            log_message('debug', 'No products found.');
        }

        return view('produk/produk', $data);
    }

        public function makeup()
    {
        $productModel = new ProductModel();
        $data['makeup'] = $productModel->getProductsByCategory('Makeup', 'Aktif');
        
        if (empty($data['makeup'])) {
            log_message('debug', 'No makeup products found.');
        }

        return view('produk/makeup', $data);
    }

    public function skincare()
    {
        $productModel = new ProductModel();
        $data['skincare'] = $productModel->getProductsByCategory('Skincare', 'Aktif');
        
        // Debug: Check if skincare products are fetched
        if (empty($data['skincare'])) {
            log_message('debug', 'No skincare products found.');
        }

        return view('produk/skincare', $data);
    }

    public function hairnbody()
    {
        $productModel = new ProductModel();
        $data['hairnbody'] = $productModel->getProductsByCategory('Hairnbody', 'Aktif');
        
        // Debug: Check if hairnbody products are fetched
        if (empty($data['hairnbody'])) {
            log_message('debug', 'No hairnbody products found.');
        }

        return view('produk/hairnbody', $data);
    }


    public function create()
    {
        return view('produk/product_create');
    }

    public function store()
    {
        $productModel = new ProductModel();
        $kategoriModel = new KategoriModel();

        // Validation
        if (!$this->validate([
            /* 'id_product' => 'required|is_unique[product.id_product]', */
            'gambar_1' => 'uploaded[gambar_1]|max_size[gambar_1,10000]|is_image[gambar_1]|mime_in[gambar_1,image/jpg,image/jpeg,image/png]',
            'gambar_2' => 'uploaded[gambar_2]|max_size[gambar_2,10000]|is_image[gambar_2]|mime_in[gambar_2,image/jpg,image/jpeg,image/png]',
            'gambar_3' => 'uploaded[gambar_3]|max_size[gambar_3,10000]|is_image[gambar_3]|mime_in[gambar_3,image/jpg,image/jpeg,image/png]',
            'gambar_4' => 'uploaded[gambar_4]|max_size[gambar_4,10000]|is_image[gambar_4]|mime_in[gambar_4,image/jpg,image/jpeg,image/png]',
            'nama_product' => 'required|min_length[3]|max_length[100]',
            'product_detail' => 'required|min_length[10]',
            'harga' => 'required|numeric',
            'diskon' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'required|min_length[10]',
            'manfaat' => 'required|min_length[10]',
            'kandungan' => 'required|min_length[10]',
            'cara_penggunaan' => 'required|min_length[10]',
            'ukuran' => 'required|min_length[3]',
            'no_bpom' => 'required|min_length[5]',
            'id_kategori' => 'required|in_list[Makeup,Skincare,Hairnbody]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file uploads for images
        $gambar_1 = $this->request->getFile('gambar_1');
        $gambar_2 = $this->request->getFile('gambar_2');
        $gambar_3 = $this->request->getFile('gambar_3');
        $gambar_4 = $this->request->getFile('gambar_4');

        $gambar_1_name = '';
        $gambar_2_name = '';
        $gambar_3_name = '';
        $gambar_4_name = '';

        if ($gambar_1->isValid() && !$gambar_1->hasMoved()) {
            $gambar_1_name = $gambar_1->getRandomName();
            $gambar_1->move(FCPATH . '/uploads', $gambar_1_name);
        }

        if ($gambar_2->isValid() && !$gambar_2->hasMoved()) {
            $gambar_2_name = $gambar_2->getRandomName();
            $gambar_2->move(FCPATH . '/uploads', $gambar_2_name);
        }

        if ($gambar_3->isValid() && !$gambar_3->hasMoved()) {
            $gambar_3_name = $gambar_3->getRandomName();
            $gambar_3->move(FCPATH . '/uploads', $gambar_3_name);
        }

        if ($gambar_4->isValid() && !$gambar_4->hasMoved()) {
            $gambar_4_name = $gambar_4->getRandomName();
            $gambar_4->move(FCPATH . '/uploads', $gambar_4_name);
        }

        // Get the category name from the 'kategori' table
        $kategori = $this->request->getPost('id_kategori');
        $kategoriData = $kategoriModel->where('nm_kategori', $kategori)->first();
        
        // Ensure the category exists and get the id
        if ($kategoriData) {
            $id_kategori = $kategoriData['id_kategori'];
        } else {
            // If category doesn't exist, you can return an error or default category id
            return redirect()->back()->with('errors', 'Kategori tidak ditemukan.');
        }

        // Data to be saved in the database
        $data = [
            /* 'id_product' => $this->request->getPost('id_product'), */
            'nama_product' => $this->request->getPost('nama_product'),
            'product_detail' => $this->request->getPost('product_detail'),
            'harga' => $this->request->getPost('harga'),
            'diskon' => $this->request->getPost('diskon'),
            'stok' => $this->request->getPost('stok'),
            'id_kategori' => $id_kategori, 
            'gambar_1' => $gambar_1_name,
            'gambar_2' => $gambar_2_name,
            'gambar_3' => $gambar_3_name,
            'gambar_4' => $gambar_4_name,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'manfaat' => $this->request->getPost('manfaat'),
            'kandungan' => $this->request->getPost('kandungan'),
            'cara_penggunaan' => $this->request->getPost('cara_penggunaan'),
            'ukuran' => $this->request->getPost('ukuran'),
            'no_bpom' => $this->request->getPost('no_bpom'),
        ];

        // Insert data into the database
        $productModel->insert($data);

        // Set flash data for success message
        session()->setFlashdata('new_product', 'Produk berhasil ditambahkan!');

        // Redirect based on category selection
        $redirectUrl = '';
        switch ($kategori) {
            case 'Makeup':
                $redirectUrl = 'produk/makeup';
                break;
            case 'Skincare':
                $redirectUrl = 'produk/skincare';
                break;
            case 'Hairnbody':
                $redirectUrl = 'produk/hairnbody';
                break;
            default:
                $redirectUrl = 'produk/product';
        }

        return redirect()->to($redirectUrl);
    }

    
    private function isValidImage($file, $validExtensions)
    {
        if ($file->isValid() && in_array($file->getExtension(), $validExtensions)) {
            return true;
        }
        return false;
    }


    public function edit($id_product)
    {
        $model = new ProductModel();
        $data['product'] = $model->getProductById($id_product);  

        // Retrieve all categories
        $kategoriModel = new KategoriModel();
        $data['categories'] = $kategoriModel->findAll();  

        return view('produk/product_update', $data); 
    }

    // Fungsi untuk menyimpan perubahan produk
    public function update($id_product)
    {
        $model = new ProductModel();
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'nama_product' => 'required',
            'harga' => 'required|numeric',
            'diskon' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar_1' => 'is_image[gambar_1]|max_size[gambar_1,1024]|ext_in[gambar_1,jpg,jpeg,gif,png]',
            'gambar_2' => 'is_image[gambar_2]|max_size[gambar_2,1024]|ext_in[gambar_2,jpg,jpeg,gif,png]',
            'gambar_3' => 'is_image[gambar_3]|max_size[gambar_3,1024]|ext_in[gambar_3,jpg,jpeg,gif,png]',
            'gambar_4' => 'is_image[gambar_4]|max_size[gambar_4,1024]|ext_in[gambar_4,jpg,jpeg,gif,png]',
        ]);

        // Validasi input
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data produk yang ada berdasarkan ID
        $product = $model->find($id_product);

        // Dapatkan id_kategori berdasarkan nama kategori yang dipilih
        $kategoriModel = new KategoriModel();
        $kategoriName = $this->request->getPost('id_kategori'); // Nama kategori yang dipilih
        $kategoriData = $kategoriModel->where('nm_kategori', $kategoriName)->first();

        // Validasi kategori
        if (!$kategoriData) {
            return redirect()->back()->with('errors', 'Kategori tidak ditemukan.');
        }

        // Ambil id_kategori
        $id_kategori = $kategoriData['id_kategori'];

        // Persiapkan data untuk diupdate
        $updatedData = [
            'nama_product' => $this->request->getPost('nama_product'),
            'product_detail' => $this->request->getPost('product_detail'),
            'harga' => $this->request->getPost('harga'),
            'diskon' => $this->request->getPost('diskon'),
            'stok' => $this->request->getPost('stok'),
            'id_kategori' => $id_kategori,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'manfaat' => $this->request->getPost('manfaat'),
            'kandungan' => $this->request->getPost('kandungan'),
            'cara_penggunaan' => $this->request->getPost('cara_penggunaan'),
            'ukuran' => $this->request->getPost('ukuran'),
            'no_bpom' => $this->request->getPost('no_bpom'),
        ];

        // Proses upload gambar jika ada perubahan
        $this->uploadImage('gambar_1', $product, $updatedData);
        $this->uploadImage('gambar_2', $product, $updatedData);
        $this->uploadImage('gambar_3', $product, $updatedData);
        $this->uploadImage('gambar_4', $product, $updatedData);

        // Update data produk
        $model->update($id_product, $updatedData);

        if ($updatedData['stok'] == 0) {
            $model->update($id_product, ['status' => 'Nonaktif']);
        }

        // Redirect ke halaman sesuai kategori setelah update
        $category = strtolower($this->request->getPost('id_kategori'));
        $message = 'Produk berhasil diperbarui!';

        switch ($category) {
            case 'makeup':
                return redirect()->to('produk/makeup')->with('pesan', $message);
            case 'skincare':
                return redirect()->to('produk/skincare')->with('pesan', $message);
            case 'hairnbody':
                return redirect()->to('produk/hairnbody')->with('pesan', $message);
            default:
                return redirect()->to('produk/product')->with('pesan', $message);
        }
    }

    private function uploadImage($fieldName, $product, &$updatedData)
    {
        // Ambil file gambar
        $imgFile = $this->request->getFile($fieldName);
        
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            // Hapus gambar lama jika ada
            if (isset($product[$fieldName]) && file_exists(FCPATH . $product[$fieldName])) {
                unlink(FCPATH . $product[$fieldName]);
            }

            // Generate nama file baru dan simpan gambar
            $newFileName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . '/uploads', $newFileName);
            
            // Simpan path gambar baru
            $updatedData[$fieldName] = $newFileName;
        }
    }

    public function archive($category)
    {
        $productModel = new ProductModel();
        
        $product = $productModel->where('id_product', $category)->first();

        if ($product) {
            if ($product['stok'] == 0) {
                $productModel->update($product['id_product'], [
                    'status' => 'Nonaktif'
                ]);
                session()->setFlashdata('success', 'Produk berhasil diarsipkan karena stok 0.');
            } else {
                session()->setFlashdata('info', 'Produk tidak diarsipkan karena stok lebih dari 0.');
            }
        } else {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
        }

        return redirect()->to('produk/arsip');
    }

    public function archived()
    {
        $productModel = new ProductModel();
        
        $data['archived_products'] = $productModel
            ->select('product.*, kategori.nm_kategori')
            ->join('kategori', 'kategori.id_kategori = product.id_kategori', 'left') 
            ->where('product.status', 'Nonaktif')
            ->findAll();

        return view('produk/arsip', $data); 
    }

    public function activate($id_product, $category)
{
    $productModel = new ProductModel();

    // Find the product by ID
    $product = $productModel->find($id_product);

    if ($product) {
        // Update the product status to 'Aktif' (Active)
        $productModel->update($id_product, [
            'status' => 'Aktif',
        ]);

        // Redirect to the appropriate category page after activation
        session()->setFlashdata('success', 'Produk berhasil diaktifkan.');

        switch ($category) {
            case 'makeup':
                return redirect()->to('produk/makeup');
            case 'skincare':
                return redirect()->to('produk/skincare');
            case 'hairnbody':
                return redirect()->to('produk/hairnbody');
            default:
                return redirect()->to('produk/produk');
        }
    } else {
        session()->setFlashdata('error', 'Produk tidak ditemukan.');
        return redirect()->to('produk/produk'); // Redirect to the default product page if not found
    }
}



    public function delete($id_product)
    {
        $model = new ProductModel();
        $model->delete($id_product);
        return redirect()->back()->with('pesan', 'Data product berhasil dihapus');
    }        
}
