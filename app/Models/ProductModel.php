<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product'; 
    protected $primaryKey = 'id_product';
    protected $allowedFields = [
        'id_product',
        'nama_product',
        'product_detail',
        'harga',
        'diskon',
        'stok',
        'id_kategori',
        'gambar_1',
        'gambar_2',
        'gambar_3',
        'gambar_4',
        'deskripsi',
        'manfaat',
        'kandungan',
        'cara_penggunaan',
        'ukuran',
        'no_bpom',
        'status'
    ];

    public function getProductsByCategory($category = null)
    {
        $query = $this->join('kategori', 'kategori.id_kategori = product.id_kategori')
                    ->select('product.*, kategori.nm_kategori')  // Pilih kolom dari tabel produk dan kategori
                    ->where('product.status', 'Aktif');  // Filter berdasarkan status "Aktif"

        if ($category) {
            $query = $query->where('kategori.nm_kategori', $category);  // Filter berdasarkan kategori jika ada
        }

        return $query->findAll();
    }



    public function getProductById($id)
    {
        return $this->where('id_product', $id)->first();
    }

    public function getArchivedProducts()
    {
        return $this->where('status', 'Nonaktif')->findAll();
    }
}
